<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\CommonMainType;
use App\Models\CommonType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TypeConfigurationController extends Controller
{
    /**
     * Display main types index page.
     */
    public function index(Request $request)
    {
        $query = CommonMainType::withCount(['types'])
            ->orderBy('position')
            ->orderBy('name');

        // Apply search filter
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Apply status filter
        if ($request->has('status') && in_array($request->status, ['active', 'inactive'])) {
            $query->where('status', $request->status === 'active');
        }

        $mainTypes = $query->paginate(12)->withQueryString();

        return Inertia::render('Settings/Types/Index', [
            'mainTypes' => $mainTypes
        ]);
    }

    /**
     * Display types for a specific main type.
     */
    public function show($id, Request $request)
    {
        $mainType = CommonMainType::findOrFail($id);
        
        $query = CommonType::where('type_id', $id)
            ->orderBy('position')
            ->orderBy('name');

        // Apply search filter
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('slug', 'like', '%' . $request->search . '%');
            });
        }

        // Apply status filter
        if ($request->has('status') && in_array($request->status, ['active', 'inactive'])) {
            $query->where('status', $request->status === 'active');
        }

        // Apply sorting
        if ($request->has('sort_by')) {
            $sortBy = $request->sort_by;
            $sortOrder = $request->get('sort_order', 'asc');
            
            if (in_array($sortBy, ['name', 'position', 'created_at', 'updated_at'])) {
                $query->orderBy($sortBy, $sortOrder);
            }
        }

        $types = $query->paginate(15)->withQueryString();

        return Inertia::render('Settings/Types/Show', [
            'mainType' => $mainType,
            'types' => $types
        ]);
    }

    /**
     * Store a newly created main type.
     */
    public function storeMainType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150|unique:common_maintype_info,name',
            'slug' => 'required|string|max:150|unique:common_maintype_info,slug',
            'position' => 'nullable|integer',
            'description' => 'nullable|string',
            'status' => 'boolean'
        ]);

        $mainType = CommonMainType::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'position' => $request->position ?? 0,
            'description' => $request->description,
            'status' => $request->boolean('status'),
            'created_by' => auth()->id(),
            'last_modified_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Main type created successfully.');
    }

    /**
     * Store a newly created type.
     */
    public function storeType(Request $request)
    {
        $request->validate([
            'type_id' => 'required|exists:common_maintype_info,id',
            'name' => 'required|string|max:150',
            'slug' => 'nullable|string|max:150',
            'position' => 'nullable|numeric',
            'status' => 'boolean',
            'metadata' => 'nullable|array'
        ]);

        // Check if slug is unique for this main type
        $slug = $request->slug ?: \Str::slug($request->name);
        $exists = CommonType::where('type_id', $request->type_id)
            ->where('slug', $slug)
            ->exists();

        if ($exists) {
            return back()->withErrors(['slug' => 'This slug already exists for this main type.']);
        }

        $type = CommonType::create([
            'type_id' => $request->type_id,
            'name' => $request->name,
            'slug' => $slug,
            'position' => $request->position ?? CommonType::getNextPosition($request->type_id),
            'status' => $request->boolean('status'),
            'metadata' => $request->metadata,
            'created_by' => auth()->id(),
            'last_modified_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Type created successfully.');
    }

    /**
     * Update the specified main type.
     */
    public function updateMainType(Request $request, $id)
    {
        $mainType = CommonMainType::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:150|unique:common_maintype_info,name,' . $id,
            'slug' => 'required|string|max:150|unique:common_maintype_info,slug,' . $id,
            'position' => 'nullable|integer',
            'description' => 'nullable|string',
            'status' => 'boolean'
        ]);

        $mainType->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'position' => $request->position ?? $mainType->position,
            'description' => $request->description,
            'status' => $request->boolean('status'),
            'last_modified_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Main type updated successfully.');
    }

    /**
     * Update the specified type.
     */
    public function updateType(Request $request, $id)
    {
        $type = CommonType::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:150',
            'slug' => 'nullable|string|max:150',
            'position' => 'nullable|numeric',
            'status' => 'boolean',
            'metadata' => 'nullable|array'
        ]);

        // Check if slug is unique for this main type
        $slug = $request->slug ?: \Str::slug($request->name);
        if ($slug !== $type->slug) {
            $exists = CommonType::where('type_id', $type->type_id)
                ->where('slug', $slug)
                ->where('id', '!=', $id)
                ->exists();

            if ($exists) {
                return back()->withErrors(['slug' => 'This slug already exists for this main type.']);
            }
        }

        $type->update([
            'name' => $request->name,
            'slug' => $slug,
            'position' => $request->position ?? $type->position,
            'status' => $request->boolean('status'),
            'metadata' => $request->metadata,
            'last_modified_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Type updated successfully.');
    }

    /**
     * Toggle main type status.
     */
    public function toggleMainTypeStatus(Request $request, $id)
    {
        $mainType = CommonMainType::findOrFail($id);
        
        $request->validate([
            'status' => 'required|boolean'
        ]);

        $mainType->update([
            'status' => $request->boolean('status'),
            'last_modified_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Main type status updated successfully.');
    }

    /**
     * Toggle type status.
     */
    public function toggleTypeStatus(Request $request, $id)
    {
        $type = CommonType::findOrFail($id);
        
        $request->validate([
            'status' => 'required|boolean'
        ]);

        $type->update([
            'status' => $request->boolean('status'),
            'last_modified_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Type status updated successfully.');
    }

    /**
     * Remove the specified main type.
     */
    public function destroyMainType($id)
    {
        try {
            $mainType = CommonMainType::findOrFail($id);
            
            if ($mainType->types()->exists()) {
                return redirect()->back()->with('error', 'Cannot delete main type that has associated types.');
            }

            // Force delete without events
            $deleted = CommonMainType::withoutEvents(function () use ($mainType) {
                return $mainType->forceDelete(); // or delete() if not using soft deletes
            });
            
            return redirect()->back()->with('success', 'Main type deleted successfully.');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting main type: ' . $e->getMessage());
        }
    }

    public function destroyType($id)
    {
        try {
            $type = CommonType::findOrFail($id);
            
            // Force delete without events
            $deleted = CommonType::withoutEvents(function () use ($type) {
                return $type->forceDelete(); // or delete() if not using soft deletes
            });
            
            return redirect()->back()->with('success', 'Type deleted successfully.');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting type: ' . $e->getMessage());
        }
    }

    /**
     * Get types by main type ID (API endpoint).
     */
    public function getTypesByMainType($id)
    {
        $types = CommonType::where('type_id', $id)
            ->where('status', true)
            ->orderBy('position')
            ->orderBy('name')
            ->get(['id', 'name', 'slug', 'position', 'metadata']);

        return response()->json($types);
    }

    /**
     * Reorder types.
     */
    public function reorderTypes(Request $request)
    {
        $request->validate([
            'type_id' => 'required|exists:common_maintype_info,id',
            'order' => 'required|array',
            'order.*.id' => 'required|exists:common_type_info,id',
            'order.*.position' => 'required|numeric'
        ]);

        foreach ($request->order as $item) {
            CommonType::where('id', $item['id'])
                ->where('type_id', $request->type_id)
                ->update(['position' => $item['position']]);
        }

        return response()->json(['success' => true]);
    }
}
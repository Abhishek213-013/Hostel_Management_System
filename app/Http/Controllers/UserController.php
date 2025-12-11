<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
class UserController extends Controller
{
    // Display branch managers
    public function branchManagers()
    {
        $branchManagers = User::whereHas('role', function($query) {
            $query->where('name', 'Branch Manager');
        })->with(['role', 'branch'])->latest()->get();

        $branches = Branch::all();

        return Inertia::render('Users/BranchManagers', [
            'branchManagers' => $branchManagers,
            'branches' => $branches,
            'stats' => [
                'activeBranches' => Branch::count(),
                'thisMonth' => User::whereHas('role', fn($q) => $q->where('name', 'Branch Manager'))
                    ->where('created_at', '>=', now()->subMonth())->count(),
                'assignedBranches' => User::whereHas('role', fn($q) => $q->where('name', 'Branch Manager'))
                    ->whereNotNull('branch_id')->count()
            ]
        ]);
    }

    // Store new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'address' => 'nullable|string|max:500',
            'branch_id' => 'nullable|exists:branches,id',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'profile_picture_data' => 'nullable|string', // For cropped image data
        ]);

        // Prepare user data
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'address' => $request->address,
            'branch_id' => $request->branch_id,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'created_id' => auth()->id(),
        ];

        // Handle profile picture upload
        if ($request->has('profile_picture_data')) {
            // Handle base64 image data from cropper
            $profilePicturePath = $this->saveBase64Image($request->profile_picture_data, $request->name);
            if ($profilePicturePath) {
                $userData['profile_picture'] = $profilePicturePath;
            }
        }

        $user = User::create($userData);

        return redirect()->back()->with('success', 'User created successfully.');
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'address' => 'nullable|string|max:500',
            'branch_id' => 'nullable|exists:branches,id',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_picture_data' => 'nullable|string',
            'remove_profile_picture' => 'nullable|boolean',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'address' => $request->address,
            'branch_id' => $request->branch_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Handle profile picture
        if ($request->has('remove_profile_picture') && $request->remove_profile_picture) {
            // Remove existing profile picture
            if ($user->profile_picture) {
                Storage::disk('public')->delete('profile-pictures/' . $user->profile_picture);
            }
            $data['profile_picture'] = null;
        } elseif ($request->has('profile_picture_data')) {
            // Handle base64 image data from cropper
            $profilePicturePath = $this->saveBase64Image($request->profile_picture_data, $request->name);
            if ($profilePicturePath) {
                // Delete old profile picture if exists
                if ($user->profile_picture) {
                    Storage::disk('public')->delete('profile-pictures/' . $user->profile_picture);
                }
                $data['profile_picture'] = $profilePicturePath;
            }
        }

        $user->update($data);

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    // Delete user
    public function destroy(User $user)
    {
        // Delete profile picture if exists
        if ($user->profile_picture) {
            Storage::disk('public')->delete('profile-pictures/' . $user->profile_picture);
        }
        
        $user->delete();
        
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    /**
     * Save base64 image to storage (SIMPLIFIED - NO GD LIBRARY)
     */
    private function saveBase64Image($base64Image, $userName)
    {
        try {
            // Extract image data from base64 string
            if (strpos($base64Image, 'data:image') === 0) {
                $image_parts = explode(";base64,", $base64Image);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                
                // Validate image type
                if (!in_array($image_type, ['jpeg', 'jpg', 'png', 'gif'])) {
                    throw new \Exception('Invalid image type. Only JPEG, PNG, and GIF are allowed.');
                }
                
                // Validate image size (max 5MB)
                $image_size = strlen($image_base64);
                if ($image_size > 5 * 1024 * 1024) {
                    throw new \Exception('Image size should be less than 5MB.');
                }
                
                // Generate filename
                $filename = 'profile_' . time() . '_' . str_replace(' ', '_', strtolower($userName)) . '.' . $image_type;
                
                // Ensure directory exists
                Storage::disk('public')->makeDirectory('profile-pictures');
                
                // Save the image
                $path = 'profile-pictures/' . $filename;
                Storage::disk('public')->put($path, $image_base64);
                
                return $filename;
            }
            
            return null;
        } catch (\Exception $e) {
            Log::error('Failed to save base64 image: ' . $e->getMessage());
            return null;
        }
    }
}
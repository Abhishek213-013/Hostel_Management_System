<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Settings\TypeConfigurationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Models\MainType; // Add this import
use App\Models\CommonMainType; // Add this import
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => false,
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    
    if ($user->role) {
        switch ($user->role->name) {
            case 'Admin':
                return Inertia::render('Dashboard/Admin', [
                    'dashboardStats' => [
                        'totalStudents' => 284,
                        'totalComplaints' => 158,
                        'receivedComplaints' => 96,
                        'openComplaints' => 62,
                        'stockItems' => 156,
                        'activeUsers' => 42,
                        'mealsServed' => 1248,
                        'hostel1Occupancy' => 50,
                        'hostel2Occupancy' => 75,
                        'hostel3Occupancy' => 95,
                        'expectedFees' => 5200000,
                        'remainingFees' => 1560000,
                        'collectedFees' => 2600000,
                        'overdueFees' => 1040000,
                        'resolutionRate' => 61
                    ]
                ]);
            case 'Branch Manager':
                return Inertia::render('Dashboard/Manager', [
                    'dashboardStats' => [
                        'branchName' => 'Main Branch',
                        'totalStudents' => 120,
                        'availableRooms' => 25,
                        'occupiedRooms' => 75,
                        'pendingPayments' => 12,
                        'todayAttendance' => 95,
                        'monthlyRevenue' => 850000
                    ]
                ]);
            case 'Accountant':
                return Inertia::render('Dashboard/Accountant', [
                    'dashboardStats' => [
                        'totalRevenue' => 4500000,
                        'pendingPayments' => 1560000,
                        'collectedThisMonth' => 850000,
                        'overduePayments' => 1040000,
                        'expensesThisMonth' => 320000,
                        'netProfit' => 530000
                    ]
                ]);
            case 'Warden':
                return Inertia::render('Dashboard/Warden', [
                    'dashboardStats' => [
                        'totalResidents' => 120,
                        'todayAttendance' => 95,
                        'pendingComplaints' => 8,
                        'maintenanceRequests' => 5,
                        'mealAttendance' => 110,
                        'lateEntries' => 3
                    ]
                ]);
            case 'Resident':
                return Inertia::render('Dashboard/Resident', [
                    'dashboardStats' => [
                        'roomNumber' => '101',
                        'hostelName' => 'Hostel A',
                        'dueAmount' => 12500,
                        'paymentStatus' => 'Pending',
                        'attendanceToday' => true,
                        'mealStatus' => 'Served',
                        'complaintStatus' => 'No complaints'
                    ]
                ]);
            default:
                return Inertia::render('Dashboard', [
                    'dashboardStats' => [
                        'welcomeMessage' => 'Welcome to Hostel Management System'
                    ]
                ]);
        }
    }
    
    return Inertia::render('Dashboard', [
        'dashboardStats' => [
            'welcomeMessage' => 'Welcome to Hostel Management System'
        ]
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Create named routes for each dashboard type
Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return Inertia::render('Dashboard/Admin', [
            'dashboardStats' => [
                'totalStudents' => 284,
                'totalComplaints' => 158,
                'receivedComplaints' => 96,
                'openComplaints' => 62,
                'stockItems' => 156,
                'activeUsers' => 42,
                'mealsServed' => 1248,
                'hostel1Occupancy' => 50,
                'hostel2Occupancy' => 75,
                'hostel3Occupancy' => 95,
                'expectedFees' => 5200000,
                'remainingFees' => 1560000,
                'collectedFees' => 2600000,
                'overdueFees' => 1040000,
                'resolutionRate' => 61
            ]
        ]);
    })->name('dashboard.admin');
    
    Route::get('/manager', function () {
        return Inertia::render('Dashboard/Manager', [
            'dashboardStats' => [
                'branchName' => 'Main Branch',
                'totalStudents' => 120,
                'availableRooms' => 25,
                'occupiedRooms' => 75,
                'pendingPayments' => 12,
                'todayAttendance' => 95,
                'monthlyRevenue' => 850000
            ]
        ]);
    })->name('dashboard.manager');
    
    Route::get('/accountant', function () {
        return Inertia::render('Dashboard/Accountant', [
            'dashboardStats' => [
                'totalRevenue' => 4500000,
                'pendingPayments' => 1560000,
                'collectedThisMonth' => 850000,
                'overduePayments' => 1040000,
                'expensesThisMonth' => 320000,
                'netProfit' => 530000
            ]
        ]);
    })->name('dashboard.accountant');
    
    Route::get('/warden', function () {
        return Inertia::render('Dashboard/Warden', [
            'dashboardStats' => [
                'totalResidents' => 120,
                'todayAttendance' => 95,
                'pendingComplaints' => 8,
                'maintenanceRequests' => 5,
                'mealAttendance' => 110,
                'lateEntries' => 3
            ]
        ]);
    })->name('dashboard.warden');
    
    Route::get('/resident', function () {
        return Inertia::render('Dashboard/Resident', [
            'dashboardStats' => [
                'roomNumber' => '101',
                'hostelName' => 'Hostel A',
                'dueAmount' => 12500,
                'paymentStatus' => 'Pending',
                'attendanceToday' => true,
                'mealStatus' => 'Served',
                'complaintStatus' => 'No complaints'
            ]
        ]);
    })->name('dashboard.resident');
});

// ============================================
// USERS MANAGEMENT ROUTES
// ============================================
Route::prefix('users')->middleware(['auth'])->group(function () {
    // Main users page
    Route::get('/', function () {
        return Inertia::render('Users/Index', [
            'users' => \App\Models\User::with(['role'])->latest()->limit(10)->get(),
            'roleStats' => [
                'total' => \App\Models\User::count(),
                'superAdmins' => \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'Admin'))->count(),
                'branchManagers' => \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'Branch Manager'))->count(),
                'accountants' => \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'Accountant'))->count(),
                'wardens' => \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'Warden'))->count(),
                'residents' => \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'Resident'))->count(),
                'activeToday' => 0,
                'newThisWeek' => \App\Models\User::where('created_at', '>=', now()->subWeek())->count(),
                'inactive' => 0
            ]
        ]);
    })->name('users.index');

    // Role-specific pages
    Route::get('/super-admins', function () {
        return Inertia::render('Users/SuperAdmins', [
            'superAdmins' => \App\Models\User::whereHas('role', function($query) {
                $query->where('name', 'Admin');
            })->with(['role'])->latest()->get(),
            'stats' => [
                'activeToday' => 0,
                'last7Days' => \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'Admin'))
                    ->where('created_at', '>=', now()->subWeek())->count()
            ]
        ]);
    })->name('users.super-admins');

    Route::get('/branch-managers', [UserController::class, 'branchManagers'])->name('users.branch-managers');

    Route::get('/accountants', function () {
        return Inertia::render('Users/Accountants', [
            'users' => \App\Models\User::whereHas('role', function($query) {
                $query->where('name', 'Accountant');
            })->with(['role'])->latest()->get()
        ]);
    })->name('users.accountants');

    Route::get('/wardens', function () {
        return Inertia::render('Users/Wardens', [
            'users' => \App\Models\User::whereHas('role', function($query) {
                $query->where('name', 'Warden');
            })->with(['role'])->latest()->get()
        ]);
    })->name('users.wardens');

    Route::get('/residents', function () {
        return Inertia::render('Users/Residents', [
            'users' => \App\Models\User::whereHas('role', function($query) {
                $query->where('name', 'Resident');
            })->with(['role'])->latest()->get()
        ]);
    })->name('users.residents');

    Route::get('/all', function () {
        return Inertia::render('Users/AllUsers', [
            'users' => \App\Models\User::with(['role'])->latest()->get()
        ]);
    })->name('users.all');

    // Create user page
    Route::get('/create', function () {
        return Inertia::render('Users/Create', [
            'roles' => \App\Models\Role::all(),
            'branches' => \App\Models\Branch::all()
        ]);
    })->name('users.create');

    // Individual user pages
    Route::get('/{user}', function (\App\Models\User $user) {
        return Inertia::render('Users/Show', [
            'user' => $user->load(['role', 'branch'])
        ]);
    })->name('users.show');

    Route::get('/{user}/edit', function (\App\Models\User $user) {
        return Inertia::render('Users/Edit', [
            'user' => $user->load(['role', 'branch']),
            'roles' => \App\Models\Role::all(),
            'branches' => \App\Models\Branch::all()
        ]);
    })->name('users.edit');
    
    // CRUD routes - ADD THESE ROUTES
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// ============================================
// BRANCHES MANAGEMENT ROUTES
// ============================================
Route::prefix('branches')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Branches/Index', [
            'branches' => \App\Models\Branch::with(['createdBy'])->latest()->get()
        ]);
    })->name('branches.index');
    
    Route::get('/create', function () {
        return Inertia::render('Branches/Create');
    })->name('branches.create');
    
    Route::get('/{branch}/edit', function (\App\Models\Branch $branch) {
        return Inertia::render('Branches/Edit', [
            'branch' => $branch
        ]);
    })->name('branches.edit');
});

// ============================================
// ROOMS MANAGEMENT ROUTES
// ============================================
Route::prefix('rooms')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Rooms/Index', [
            'rooms' => \App\Models\Room::with(['branch', 'floor', 'beds'])->latest()->get(),
            'branches' => \App\Models\Branch::all(),
            'floors' => \App\Models\Floor::all()
        ]);
    })->name('rooms.index');
    
    Route::get('/create', function () {
        return Inertia::render('Rooms/Create', [
            'branches' => \App\Models\Branch::all(),
            'floors' => \App\Models\Floor::all()
        ]);
    })->name('rooms.create');
    
    Route::get('/{room}/edit', function (\App\Models\Room $room) {
        return Inertia::render('Rooms/Edit', [
            'room' => $room->load(['branch', 'floor']),
            'branches' => \App\Models\Branch::all(),
            'floors' => \App\Models\Floor::all()
        ]);
    })->name('rooms.edit');
});

// ============================================
// STUDENTS/RESIDENTS MANAGEMENT ROUTES
// ============================================
Route::prefix('students')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Students/Index', [
            'students' => \App\Models\User::whereHas('role', function($query) {
                $query->where('name', 'Resident');
            })->with(['role', 'admission.bed.room.branch'])->latest()->get(),
            'branches' => \App\Models\Branch::all(),
            'rooms' => \App\Models\Room::with(['branch'])->get()
        ]);
    })->name('students.index');
    
    Route::get('/create', function () {
        return Inertia::render('Students/Create', [
            'branches' => \App\Models\Branch::all(),
            'rooms' => \App\Models\Room::with(['branch', 'availableBeds'])->get(),
            'beds' => \App\Models\Bed::whereNull('invoice_id')->where('is_usable', true)->with(['room.branch'])->get()
        ]);
    })->name('students.create');
    
    Route::get('/{student}/edit', function (\App\Models\User $student) {
        return Inertia::render('Students/Edit', [
            'student' => $student->load(['role', 'admission.bed.room.branch']),
            'branches' => \App\Models\Branch::all(),
            'rooms' => \App\Models\Room::with(['branch', 'availableBeds'])->get(),
            'beds' => \App\Models\Bed::whereNull('invoice_id')->where('is_usable', true)->with(['room.branch'])->get()
        ]);
    })->name('students.edit');
});

// ============================================
// ADMISSIONS MANAGEMENT ROUTES
// ============================================
Route::prefix('admissions')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Admissions/Index', [
            'admissions' => \App\Models\Admission::with(['invoice.boarder', 'bed.room.branch', 'approvedBy', 'createdBy'])->latest()->get()
        ]);
    })->name('admissions.index');
    
    Route::get('/create', function () {
        return Inertia::render('Admissions/Create', [
            'branches' => \App\Models\Branch::all(),
            'rooms' => \App\Models\Room::with(['branch'])->get(),
            'beds' => \App\Models\Bed::whereNull('invoice_id')->where('is_usable', true)->with(['room.branch'])->get()
        ]);
    })->name('admissions.create');
});

// ============================================
// PAYMENTS MANAGEMENT ROUTES
// ============================================
Route::prefix('payments')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Payments/Index', [
            'payments' => \App\Models\Payment::with(['invoice.boarder', 'createdBy'])->latest()->get(),
            'invoices' => \App\Models\Invoice::with(['boarder'])->where('status', 'pending')->get()
        ]);
    })->name('payments.index');
    
    Route::get('/create', function () {
        return Inertia::render('Payments/Create', [
            'invoices' => \App\Models\Invoice::with(['boarder'])->where('status', 'pending')->get()
        ]);
    })->name('payments.create');
});

// ============================================
// COMPLAINTS MANAGEMENT ROUTES
// ============================================
Route::prefix('complaints')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Complaints/Index', [
            'complaints' => []
        ]);
    })->name('complaints.index');
    
    Route::get('/create', function () {
        return Inertia::render('Complaints/Create');
    })->name('complaints.create');
});

// ============================================
// ATTENDANCE MANAGEMENT ROUTES
// ============================================
Route::prefix('attendance')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Attendance/Index', [
            'attendanceLogs' => \App\Models\AttendanceLog::with(['boarder', 'invoice', 'createdBy'])->latest()->get(),
            'boarders' => \App\Models\Boarder::with(['invoice', 'admission.bed.room'])->get()
        ]);
    })->name('attendance.index');
    
    Route::get('/take', function () {
        return Inertia::render('Attendance/Take', [
            'boarders' => \App\Models\Boarder::with(['invoice', 'admission.bed.room'])->get()
        ]);
    })->name('attendance.take');
});

// ============================================
// INVENTORY MANAGEMENT ROUTES
// ============================================
Route::prefix('inventory')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Inventory/Index', [
            'inventoryItems' => \App\Models\InventoryItem::with(['invoiceItem', 'usedBy', 'inventoryFloors'])->latest()->get()
        ]);
    })->name('inventory.index');
    
    Route::get('/create', function () {
        return Inertia::render('Inventory/Create');
    })->name('inventory.create');
    
    Route::get('/{item}/edit', function (\App\Models\InventoryItem $item) {
        return Inertia::render('Inventory/Edit', [
            'item' => $item->load(['invoiceItem', 'usedBy', 'inventoryFloors'])
        ]);
    })->name('inventory.edit');
});

// ============================================
// MEALS MANAGEMENT ROUTES
// ============================================
Route::prefix('meals')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Meals/Index', [
            'meals' => []
        ]);
    })->name('meals.index');
    
    Route::get('/create', function () {
        return Inertia::render('Meals/Create');
    })->name('meals.create');
});

// ============================================
// MAINTENANCE MANAGEMENT ROUTES
// ============================================
Route::prefix('maintenance')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Maintenance/Index', [
            'maintenanceRequests' => []
        ]);
    })->name('maintenance.index');
    
    Route::get('/create', function () {
        return Inertia::render('Maintenance/Create');
    })->name('maintenance.create');
});

// ============================================
// REPORTS ROUTES
// ============================================
Route::prefix('reports')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Reports/Index', [
            'reportTypes' => [
                ['name' => 'Financial Reports', 'icon' => 'currency', 'description' => 'Income, expenses, and profit reports'],
                ['name' => 'Occupancy Reports', 'icon' => 'home', 'description' => 'Room and bed occupancy statistics'],
                ['name' => 'Attendance Reports', 'icon' => 'check-circle', 'description' => 'Student attendance records'],
                ['name' => 'Payment Reports', 'icon' => 'cash', 'description' => 'Payment collection and dues reports'],
                ['name' => 'Inventory Reports', 'icon' => 'archive', 'description' => 'Stock and asset management reports'],
                ['name' => 'Complaint Reports', 'icon' => 'exclamation', 'description' => 'Complaint resolution statistics'],
            ]
        ]);
    })->name('reports.index');
    
    Route::get('/financial', function () {
        return Inertia::render('Reports/Financial');
    })->name('reports.financial');
    
    Route::get('/occupancy', function () {
        return Inertia::render('Reports/Occupancy');
    })->name('reports.occupancy');
});

// ============================================
// SETTINGS ROUTES
// ============================================
Route::prefix('settings')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Settings/Index', [
            'settings' => [
                'system' => ['name' => 'System Settings', 'description' => 'General system configuration'],
                'notifications' => ['name' => 'Notifications', 'description' => 'Email and SMS notification settings'],
                'payment' => ['name' => 'Payment Settings', 'description' => 'Payment gateway configuration'],
                'roles' => ['name' => 'Role Permissions', 'description' => 'User role and permission management'],
                'backup' => ['name' => 'Backup & Restore', 'description' => 'System backup and restore options'],
                'types' => ['name' => 'Type Configuration', 'description' => 'Manage system types and configurations'],
            ]
        ]);
    })->name('settings.index');
    
    Route::get('/system', function () {
        return Inertia::render('Settings/System');
    })->name('settings.system');
    
    Route::get('/roles', function () {
        return Inertia::render('Settings/Roles', [
            'roles' => \App\Models\Role::all()
        ]);
    })->name('settings.roles');
    
    Route::get('/general', function () {
        return Inertia::render('Settings/General');
    })->name('settings.general');
    
    // Type Configuration Routes - REORGANIZED
    Route::prefix('types')->group(function () {
        // Main types index
        Route::get('/', [TypeConfigurationController::class, 'index'])->name('settings.types.index');
        
        // Types for specific main type
        Route::get('/main-type/{id}', [TypeConfigurationController::class, 'show'])->name('settings.types.show');
        
        // Main type operations
        Route::post('/main', [TypeConfigurationController::class, 'storeMainType'])->name('settings.types.main.store');
        Route::patch('/main/{id}', [TypeConfigurationController::class, 'updateMainType'])->name('settings.types.main.update');
        Route::patch('/main/{id}/toggle-status', [TypeConfigurationController::class, 'toggleMainTypeStatus'])->name('settings.types.main.toggle-status');
        Route::delete('/main/{id}', [TypeConfigurationController::class, 'destroyMainType'])->name('settings.types.main.destroy');
        
        // Type operations
        Route::post('/', [TypeConfigurationController::class, 'storeType'])->name('settings.types.store');
        Route::patch('/type/{id}', [TypeConfigurationController::class, 'updateType'])->name('settings.types.update');
        Route::patch('/type/{id}/toggle-status', [TypeConfigurationController::class, 'toggleTypeStatus'])->name('settings.types.toggle-status');
        Route::delete('/type/{id}', [TypeConfigurationController::class, 'destroyType'])->name('settings.types.destroy');
    });
});

// ============================================
// OTHER PAGES ROUTES
// ============================================
Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Contact page
    Route::get('/contact', function () {
        return Inertia::render('Contact/Index');
    })->name('contact.index');
    
    // Terms page
    Route::get('/terms', function () {
        return Inertia::render('Legal/Terms');
    })->name('legal.terms');
    
    // Privacy page
    Route::get('/privacy', function () {
        return Inertia::render('Legal/Privacy');
    })->name('legal.privacy');
    
    // Emergency page
    Route::get('/emergency', function () {
        return Inertia::render('Emergency/Index');
    })->name('emergency.index');
    
    // Help & Support
    Route::get('/help', function () {
        return Inertia::render('Help/Index');
    })->name('help.index');
});

// ============================================
// API ROUTES (For AJAX operations)
// ============================================
Route::prefix('api')->middleware(['auth'])->group(function () {
    // Get available beds for a room
    Route::get('/rooms/{room}/available-beds', function (\App\Models\Room $room) {
        return response()->json([
            'beds' => $room->availableBeds()->get()
        ]);
    });
    
    // Get rooms for a branch
    Route::get('/branches/{branch}/rooms', function (\App\Models\Branch $branch) {
        return response()->json([
            'rooms' => $branch->rooms()->with(['floor'])->get()
        ]);
    });
    
    // Get user statistics
    Route::get('/users/statistics', function () {
        $user = auth()->user();
        return response()->json([
            'totalUsers' => \App\Models\User::count(),
            'activeToday' => \App\Models\User::whereDate('last_login_at', today())->count(),
            'newThisWeek' => \App\Models\User::where('created_at', '>=', now()->subWeek())->count(),
            'roleBreakdown' => \App\Models\Role::withCount('users')->get()->map(function($role) {
                return [
                    'name' => $role->name,
                    'count' => $role->users_count
                ];
            })
        ]);
    });
    
    // Emergency alert
    Route::post('/emergency/alert', function () {
        // In a real application, this would trigger notifications
        return response()->json([
            'success' => true,
            'message' => 'Emergency alert has been sent to all staff members.'
        ]);
    })->name('api.emergency.alert');
    
    // Get common types by main type
    Route::get('/common-types/{mainTypeId}', function ($mainTypeId) {
        $types = \App\Models\CommonType::where('type_id', $mainTypeId)
            ->where('status', true)
            ->orderBy('position')
            ->get(['id', 'name', 'slug', 'position', 'metadata']);
        
        return response()->json($types);
    });
    
    // Get all main types with their types - NEW ROUTE
    Route::get('/common-main-types', function () {
        $mainTypes = \App\Models\CommonMainType::with(['activeTypes'])
            ->where('status', true)
            ->orderBy('position')
            ->get(['id', 'name', 'slug', 'position', 'description']);
        
        return response()->json($mainTypes);
    });
    
    // Get active main types for sidebar - NEW ROUTE
    Route::get('/main-types/active', function () {
        $mainTypes = \App\Models\CommonMainType::where('status', true)
            ->orderBy('position')
            ->get(['id', 'name', 'slug', 'position']);
        
        return response()->json($mainTypes);
    });
    
    // API endpoints for TypeConfigurationController
    Route::get('/types/{id}', [TypeConfigurationController::class, 'getTypesByMainType']);
    Route::post('/types/reorder', [TypeConfigurationController::class, 'reorderTypes']);
});

// ============================================
// AUTHENTICATION ROUTES (Breeze)
// ============================================
require __DIR__.'/auth.php';
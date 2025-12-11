<template>
    <Head title="All Users Management" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    All Users Management
                </h2>
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    {{ currentDate }}
                </div>
            </div>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Welcome Section -->
                <div class="mb-8">
                    <div class="flex items-center space-x-2 mb-2">
                        <Link href="/users" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm">
                            Users
                        </Link>
                        <span class="text-gray-400 dark:text-gray-500">/</span>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">All Users</h1>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">View and manage all system users across all roles</p>
                </div>

                <!-- Flash Messages -->
                <div v-if="flash?.success" class="mb-6 p-3 lg:p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 lg:w-5 lg:h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-green-700 dark:text-green-300 text-sm lg:text-base">{{ flash.success }}</span>
                    </div>
                </div>

                <div v-if="flash?.error" class="mb-6 p-3 lg:p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 lg:w-5 lg:h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-red-700 dark:text-red-300 text-sm lg:text-base">{{ flash.error }}</span>
                    </div>
                </div>

                <!-- Header with Action Buttons -->
                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4 mb-6">
                    <div></div> <!-- Spacer -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <Link 
                            href="/users/create"
                            class="bg-blue-600 dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-600 text-white px-6 py-3 rounded-full flex items-center justify-center space-x-2 transition-all duration-200 text-sm lg:text-base shadow-md hover:shadow-lg active:scale-95"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span class="font-medium">Add User</span>
                        </Link>
                        
                        <!-- Export Button -->
                        <button 
                            @click="exportUsers"
                            class="bg-green-600 dark:bg-green-700 hover:bg-green-700 dark:hover:bg-green-600 text-white px-6 py-3 rounded-full flex items-center justify-center space-x-2 transition-all duration-200 text-sm lg:text-base shadow-md hover:shadow-lg active:scale-95"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            <span class="font-medium">Export</span>
                        </button>
                    </div>
                </div>

                <!-- Role Distribution -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-6 mb-8">
                    <h3 class="text-base lg:text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">User Distribution by Role</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                        <div 
                            v-for="role in roleDistribution" 
                            :key="role.name"
                            class="text-center p-4 rounded-lg hover:shadow-md dark:hover:shadow-lg transition-shadow cursor-pointer transform hover:-translate-y-1 transition-all duration-200"
                            :class="getRoleBgClass(role.name)"
                            @click="filterByRole(role.name)"
                        >
                            <div class="text-2xl lg:text-3xl font-bold text-white mb-2">{{ role.count }}</div>
                            <div class="text-sm text-white opacity-90">{{ role.name }}</div>
                            <div class="text-xs text-white opacity-75 mt-1">{{ role.percentage }}%</div>
                        </div>
                    </div>
                </div>

                <!-- Filter & Search Bar -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-4 mb-6">
                    <div class="flex flex-col lg:flex-row lg:items-center gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <input 
                                    type="text" 
                                    v-model="searchQuery"
                                    placeholder="Search users by name, email, phone, or role..." 
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent text-sm lg:text-base placeholder-gray-500 dark:placeholder-gray-400"
                                >
                                <svg class="w-4 h-4 lg:w-5 lg:h-5 text-gray-400 dark:text-gray-500 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <select 
                                v-model="selectedRole"
                                class="px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent text-sm lg:text-base"
                            >
                                <option value="">All Roles</option>
                                <option value="Admin">Super Admin</option>
                                <option value="Branch Manager">Branch Manager</option>
                                <option value="Accountant">Accountant</option>
                                <option value="Warden">Warden</option>
                                <option value="Resident">Resident</option>
                            </select>
                            <select 
                                v-model="selectedStatus"
                                class="px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent text-sm lg:text-base"
                            >
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="suspended">Suspended</option>
                            </select>
                            <select 
                                v-model="sortBy"
                                class="px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent text-sm lg:text-base"
                            >
                                <option value="newest">Newest First</option>
                                <option value="oldest">Oldest First</option>
                                <option value="name_asc">Name (A-Z)</option>
                                <option value="name_desc">Name (Z-A)</option>
                            </select>
                            <button 
                                @click="resetFilters"
                                class="px-4 py-2 text-gray-600 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 text-sm lg:text-base transition-colors"
                            >
                                Reset
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Users Table Section -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden mb-8">
                    <div class="px-4 lg:px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
                            <h3 class="text-base lg:text-lg font-semibold text-gray-800 dark:text-gray-200">All Users</h3>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                Showing {{ filteredAndSortedUsers.length }} of {{ users.meta?.total || users.data.length }} users
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="lg:hidden divide-y divide-gray-200 dark:divide-gray-700">
                        <div v-for="user in filteredAndSortedUsers" :key="user.id" class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <div class="flex items-start space-x-3 mb-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0" :class="getRoleBgClass(user.role?.name)">
                                    <span class="text-white text-sm font-semibold">
                                        {{ getUserInitials(user.name) }}
                                    </span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">{{ user.name }}</div>
                                        <span class="text-xs px-2 py-1 rounded-full" :class="getRoleBadgeClass(user.role?.name)">
                                            {{ user.role?.name || 'N/A' }}
                                        </span>
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ user.email }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ user.phone || 'N/A' }}</div>
                                </div>
                            </div>
                            
                            <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300 mb-3">
                                <div><strong>Joined:</strong> {{ formatDate(user.created_at) }}</div>
                                <div><strong>Last Login:</strong> {{ user.last_login_at ? formatDate(user.last_login_at) : 'Never' }}</div>
                                <div><strong>Status:</strong> {{ user.status || 'Active' }}</div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span :class="getStatusClasses(user.status)" class="px-2 py-1 text-xs font-semibold rounded-full">
                                    {{ user.status || 'Active' }}
                                </span>
                                <div class="flex space-x-2">
                                    <button 
                                        @click="viewUser(user)"
                                        class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20"
                                        title="View User"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <button 
                                        @click="editUser(user)"
                                        class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300 p-2 rounded-lg hover:bg-green-50 dark:hover:bg-green-900/20"
                                        title="Edit User"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button 
                                        @click="deleteUser(user)"
                                        class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20"
                                        title="Delete User"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Desktop Table View -->
                    <div class="hidden lg:block overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Contact</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Role</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Last Activity</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <tr v-for="user in filteredAndSortedUsers" :key="user.id" class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full flex items-center justify-center" :class="getRoleBgClass(user.role?.name)">
                                                <span class="text-white text-sm font-semibold">
                                                    {{ getUserInitials(user.name) }}
                                                </span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ user.name }}</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">Joined: {{ formatDate(user.created_at) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ user.email }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ user.phone || 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" :class="getRoleBadgeClass(user.role?.name)">
                                            {{ user.role?.name || 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span :class="getStatusClasses(user.status)" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                                            {{ user.status || 'Active' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ user.last_login_at ? formatDate(user.last_login_at) : 'Never' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <button 
                                                @click="viewUser(user)"
                                                class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors"
                                                title="View User"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </button>
                                            <button 
                                                @click="editUser(user)"
                                                class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300 p-2 rounded-lg hover:bg-green-50 dark:hover:bg-green-900/20 transition-colors"
                                                title="Edit User"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>
                                            <button 
                                                @click="deleteUser(user)"
                                                class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors"
                                                title="Delete User"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Empty State -->
                    <div v-if="filteredAndSortedUsers.length === 0" class="text-center py-8 lg:py-12">
                        <svg class="w-12 h-12 lg:w-16 lg:h-16 text-gray-400 dark:text-gray-500 mx-auto mb-3 lg:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        <h3 class="text-base lg:text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No users found</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm lg:text-base mb-4">Get started by creating your first user.</p>
                        <Link 
                            href="/users/create"
                            class="bg-blue-600 dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-600 text-white px-6 py-3 rounded-full transition-colors text-sm lg:text-base shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200"
                        >
                            Add User
                        </Link>
                    </div>
                </div>

                <!-- Pagination -->
                <div v-if="users.meta && users.meta.total > users.meta.per_page" class="mt-6">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-4">
                        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                Showing {{ users.meta.from }} to {{ users.meta.to }} of {{ users.meta.total }} users
                            </div>
                            <div class="flex items-center space-x-2">
                                <button 
                                    @click="prevPage"
                                    :disabled="!users.links.prev"
                                    class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors text-gray-700 dark:text-gray-300"
                                >
                                    Previous
                                </button>
                                <span class="text-sm text-gray-600 dark:text-gray-400">
                                    Page {{ users.meta.current_page }} of {{ users.meta.last_page }}
                                </span>
                                <button 
                                    @click="nextPage"
                                    :disabled="!users.links.next"
                                    class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors text-gray-700 dark:text-gray-300"
                                >
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md dark:hover:shadow-lg transition-shadow">
                        <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3">User Activity</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Active Today</span>
                                <span class="text-sm font-medium text-green-600 dark:text-green-400">{{ stats.activeToday || 0 }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600 dark:text-gray-400">New This Week</span>
                                <span class="text-sm font-medium text-blue-600 dark:text-blue-400">{{ stats.newThisWeek || 0 }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Inactive Users</span>
                                <span class="text-sm font-medium text-red-600 dark:text-red-400">{{ stats.inactiveUsers || 0 }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md dark:hover:shadow-lg transition-shadow">
                        <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3">Growth Rate</h4>
                        <div class="flex items-center justify-center h-full">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600 dark:text-green-400">+{{ stats.growthRate || 0 }}%</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 mt-2">Monthly Growth</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md dark:hover:shadow-lg transition-shadow">
                        <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3">User Status</h4>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400 flex-1">Verified</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ stats.verifiedUsers || 0 }}</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400 flex-1">Pending</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ stats.pendingUsers || 0 }}</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full bg-red-500 mr-2"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400 flex-1">Blocked</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ stats.blockedUsers || 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'
import { Head, Link } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

// Props from Laravel backend
const props = defineProps({
    users: {
        type: Object,
        default: () => ({ data: [], meta: {}, links: {} })
    },
    stats: {
        type: Object,
        default: () => ({})
    },
    flash: {
        type: Object,
        default: () => ({})
    }
})

// Current date
const currentDate = computed(() => {
    return new Date().toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
});

// Reactive data
const searchQuery = ref('')
const selectedRole = ref('')
const selectedStatus = ref('')
const sortBy = ref('newest')

// Computed properties
const roleDistribution = computed(() => {
    const roles = {
        'Admin': 0,
        'Branch Manager': 0,
        'Accountant': 0,
        'Warden': 0,
        'Resident': 0
    };
    
    props.users.data.forEach(user => {
        if (user.role && user.role.name in roles) {
            roles[user.role.name]++
        }
    });
    
    const total = props.users.data.length
    
    return Object.entries(roles).map(([name, count]) => ({
        name,
        count,
        percentage: total > 0 ? Math.round((count / total) * 100) : 0
    }))
})

const filteredAndSortedUsers = computed(() => {
    let filtered = [...props.users.data]
    
    // Filter by search query
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase()
        filtered = filtered.filter(user => 
            user.name?.toLowerCase().includes(query) ||
            user.email?.toLowerCase().includes(query) ||
            user.phone?.toLowerCase().includes(query) ||
            user.role?.name?.toLowerCase().includes(query)
        )
    }
    
    // Filter by role
    if (selectedRole.value) {
        filtered = filtered.filter(user => user.role?.name === selectedRole.value)
    }
    
    // Filter by status
    if (selectedStatus.value) {
        filtered = filtered.filter(user => user.status === selectedStatus.value)
    }
    
    // Sort users
    filtered.sort((a, b) => {
        switch (sortBy.value) {
            case 'newest':
                return new Date(b.created_at) - new Date(a.created_at)
            case 'oldest':
                return new Date(a.created_at) - new Date(b.created_at)
            case 'name_asc':
                return (a.name || '').localeCompare(b.name || '')
            case 'name_desc':
                return (b.name || '').localeCompare(a.name || '')
            default:
                return 0
        }
    })
    
    return filtered
})

// Methods
const getRoleBgClass = (roleName) => {
    switch (roleName) {
        case 'Admin':
            return 'bg-blue-600'
        case 'Branch Manager':
            return 'bg-green-600'
        case 'Accountant':
            return 'bg-purple-600'
        case 'Warden':
            return 'bg-yellow-600'
        case 'Resident':
            return 'bg-red-600'
        default:
            return 'bg-gray-600'
    }
}

const getRoleBadgeClass = (roleName) => {
    switch (roleName) {
        case 'Admin':
            return 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300'
        case 'Branch Manager':
            return 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300'
        case 'Accountant':
            return 'bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300'
        case 'Warden':
            return 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300'
        case 'Resident':
            return 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300'
        default:
            return 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300'
    }
}

const filterByRole = (roleName) => {
    selectedRole.value = roleName === selectedRole.value ? '' : roleName
}

const resetFilters = () => {
    searchQuery.value = ''
    selectedRole.value = ''
    selectedStatus.value = ''
    sortBy.value = 'newest'
}

const exportUsers = () => {
    // In a real application, this would trigger a CSV/Excel export
    alert('Export feature would download all user data in CSV format.')
    // Example: window.location.href = '/export/users'
}

const editUser = (user) => {
    router.visit(`/users/${user.id}/edit`)
}

const deleteUser = (user) => {
    if (confirm(`Are you sure you want to delete ${user.name}? This action cannot be undone.`)) {
        router.delete(`/users/${user.id}`, {
            preserveScroll: true,
            onSuccess: () => {
                // Success message will be shown via flash
            }
        })
    }
}

const viewUser = (user) => {
    router.visit(`/users/${user.id}`)
}

const prevPage = () => {
    if (props.users.links.prev) {
        router.visit(props.users.links.prev)
    }
}

const nextPage = () => {
    if (props.users.links.next) {
        router.visit(props.users.links.next)
    }
}

// Helper functions
const getUserInitials = (name) => {
    if (!name) return 'US'
    return name.split(' ').map(word => word[0]).join('').toUpperCase().slice(0, 2)
}

const formatDate = (dateString) => {
    if (!dateString) return 'N/A'
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    })
}

const getStatusClasses = (status) => {
    switch(status) {
        case 'active': return 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300'
        case 'inactive': return 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300'
        case 'suspended': return 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300'
        default: return 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300'
    }
}
</script>

<style scoped>
/* Custom styles */
.emergency-btn {
    transition: all 0.3s ease;
}

.emergency-btn:hover {
    box-shadow: 0 10px 25px rgba(220, 38, 38, 0.4);
}

.dark .emergency-btn:hover {
    box-shadow: 0 10px 25px rgba(248, 113, 113, 0.4);
}

/* Custom scrollbar for modals */
.modal-content::-webkit-scrollbar {
    width: 6px;
}

.modal-content::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.modal-content::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

.modal-content::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Dark mode scrollbar for modals */
.dark .modal-content::-webkit-scrollbar-track {
    background: #374151;
}

.dark .modal-content::-webkit-scrollbar-thumb {
    background: #6b7280;
}

.dark .modal-content::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}

/* Mobile optimizations */
@media (max-width: 768px) {
  .mobile-stack {
    flex-direction: column;
  }
  
  .mobile-full {
    width: 100%;
  }
  
  .mobile-text-center {
    text-align: center;
  }
}

/* Improve touch targets on mobile */
@media (max-width: 640px) {
  button {
    min-height: 44px;
  }
}

/* Modal responsiveness */
@media (max-width: 480px) {
  .modal-content {
    margin: 0.5rem;
    width: calc(100% - 1rem);
  }
}

/* Table row hover effect */
tr {
    transition: background-color 0.2s ease;
}

/* Modal backdrop */
.fixed {
    backdrop-filter: blur(4px);
}

/* Card hover effects */
.hover\\:shadow-md:hover {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.dark .hover\\:shadow-md:hover {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2), 0 2px 4px -1px rgba(0, 0, 0, 0.1);
}

/* Button hover effects */
button:active {
    transform: scale(0.98);
}

/* Smooth transitions */
.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}

/* Focus styles for better accessibility */
:focus-visible {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}

.dark :focus-visible {
    outline-color: #60a5fa;
}

/* Selection colors */
::selection {
    background-color: #3b82f6;
    color: white;
}

.dark ::selection {
    background-color: #60a5fa;
    color: #1f2937;
}

/* Table scrollbar */
.overflow-x-auto::-webkit-scrollbar {
    height: 6px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Dark mode table scrollbar */
.dark .overflow-x-auto::-webkit-scrollbar-track {
    background: #374151;
}

.dark .overflow-x-auto::-webkit-scrollbar-thumb {
    background: #6b7280;
}

.dark .overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}

/* Responsive improvements */
@media (max-width: 1024px) {
    table {
        font-size: 0.875rem;
    }
    
    .px-6 {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .py-4 {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }
}

/* Loading states */
.disabled\:bg-gray-400 {
    opacity: 0.6;
    cursor: not-allowed;
}

.dark .disabled\:bg-gray-400 {
    opacity: 0.4;
}

/* Role distribution cards hover */
.bg-blue-600:hover, .bg-green-600:hover, .bg-purple-600:hover, .bg-yellow-600:hover, .bg-red-600:hover {
    opacity: 0.9;
}

/* Mobile table improvements */
@media (max-width: 640px) {
    .divide-y > div {
        padding: 0.75rem;
    }
    
    .flex.items-start {
        align-items: center;
    }
}

/* Animation for role filter */
@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

.bg-blue-600:active, .bg-green-600:active, .bg-purple-600:active, .bg-yellow-600:active, .bg-red-600:active {
    animation: pulse 0.2s ease-in-out;
}
</style>
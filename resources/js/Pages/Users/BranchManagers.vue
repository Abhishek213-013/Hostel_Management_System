<template>
    <Head title="Branch Managers Management" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Branch Managers Management
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
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Branch Managers</h1>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Manage branch manager accounts for hostel operations</p>
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

                <!-- Header with Add Button -->
                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4 mb-6">
                    <div></div> <!-- Spacer -->
                    <button 
                        @click="showCreateModal = true"
                        class="bg-green-600 dark:bg-green-700 hover:bg-green-700 dark:hover:bg-green-600 text-white px-6 py-3 rounded-full flex items-center justify-center space-x-2 transition-all duration-200 w-full lg:w-auto text-sm lg:text-base shadow-md hover:shadow-lg active:scale-95"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="font-medium">Add Branch Manager</span>
                    </button>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Managers</h3>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ branchManagers.length }}</p>
                            </div>
                            <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Active Branches</h3>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ stats?.activeBranches || 0 }}</p>
                            </div>
                            <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">This Month</h3>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ stats?.thisMonth || 0 }}</p>
                            </div>
                            <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Assigned Branches</h3>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ stats?.assignedBranches || 0 }}</p>
                            </div>
                            <div class="p-2 bg-orange-100 dark:bg-orange-900/30 rounded-lg">
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Users Table Section -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden mb-8">
                    <div class="px-4 lg:px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
                            <h3 class="text-base lg:text-lg font-semibold text-gray-800 dark:text-gray-200">Branch Managers</h3>
                            <div class="relative w-full lg:w-auto">
                                <input 
                                    type="text" 
                                    v-model="searchQuery"
                                    placeholder="Search branch managers..." 
                                    class="w-full lg:w-64 pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent text-sm lg:text-base placeholder-gray-500 dark:placeholder-gray-400"
                                >
                                <svg class="w-4 h-4 lg:w-5 lg:h-5 text-gray-400 dark:text-gray-500 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="lg:hidden divide-y divide-gray-200 dark:divide-gray-700">
                        <div v-for="user in filteredBranchManagers" :key="user.id" class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <div class="flex items-start space-x-3 mb-3">
                                <div class="relative">
                                    <div v-if="user.profile_picture_url" class="w-10 h-10 rounded-full overflow-hidden flex items-center justify-center flex-shrink-0 border-2 border-green-600 dark:border-green-500">
                                        <img 
                                            :src="user.profile_picture_url" 
                                            :alt="user.name"
                                            class="w-full h-full object-cover"
                                            @error="handleImageError"
                                        />
                                    </div>
                                    <div v-else class="w-10 h-10 bg-green-600 dark:bg-green-700 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-white text-sm font-semibold">
                                            {{ getUserInitials(user.name) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">{{ user.name }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ user.email }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ user.phone || 'N/A' }}</div>
                                </div>
                            </div>
                            
                            <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300 mb-3">
                                <div v-if="user.branch"><strong>Branch:</strong> {{ user.branch.name }}</div>
                                <div><strong>Joined:</strong> {{ formatDate(user.created_at) }}</div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                    Active
                                </span>
                                <div class="flex space-x-2">
                                    <button 
                                        @click="editBranchManager(user)"
                                        class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20"
                                        title="Edit Branch Manager"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button 
                                        @click="deleteBranchManager(user)"
                                        class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20"
                                        title="Delete Branch Manager"
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Profile</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Manager</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Contact</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Branch</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <tr v-for="user in filteredBranchManagers" :key="user.id" class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-center">
                                            <div class="relative">
                                                <div v-if="user.profile_picture_url" class="w-16 h-16 rounded-full overflow-hidden border-2 border-green-600 dark:border-green-500">
                                                    <img 
                                                        :src="user.profile_picture_url" 
                                                        :alt="user.name"
                                                        class="w-full h-full object-cover"
                                                        @error="handleImageError"
                                                    />
                                                </div>
                                                <div v-else class="w-16 h-16 bg-green-600 dark:bg-green-700 rounded-full flex items-center justify-center">
                                                    <span class="text-white text-xl font-semibold">
                                                        {{ getUserInitials(user.name) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ user.name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ user.email }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ user.email }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ user.phone || 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ user.branch?.name || 'Unassigned' }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Joined: {{ formatDate(user.created_at) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <button 
                                                @click="editBranchManager(user)"
                                                class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors"
                                                title="Edit Branch Manager"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>
                                            <button 
                                                @click="deleteBranchManager(user)"
                                                class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors"
                                                title="Delete Branch Manager"
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
                    <div v-if="filteredBranchManagers.length === 0" class="text-center py-8 lg:py-12">
                        <svg class="w-12 h-12 lg:w-16 lg:h-16 text-gray-400 dark:text-gray-500 mx-auto mb-3 lg:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <h3 class="text-base lg:text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No branch managers found</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm lg:text-base mb-4">Get started by creating your first branch manager.</p>
                        <button 
                            @click="showCreateModal = true"
                            class="bg-green-600 dark:bg-green-700 hover:bg-green-700 dark:hover:bg-green-600 text-white px-6 py-3 rounded-full transition-colors text-sm lg:text-base shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200"
                        >
                            Add Branch Manager
                        </button>
                    </div>
                </div>

                <!-- Create Branch Manager Modal -->
                <div v-if="showCreateModal" class="fixed inset-0 bg-black bg-opacity-50 dark:bg-opacity-70 flex items-center justify-center p-4 z-50">
                    <div class="bg-white dark:bg-gray-800 rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto mx-2">
                        <div class="px-4 lg:px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Create New Branch Manager</h3>
                        </div>

                        <form @submit.prevent="createBranchManager" class="p-4 lg:p-6 space-y-4">
                            <!-- Profile Picture Section -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Profile Picture</label>
                                
                                <!-- Preview and Upload Area -->
                                <div class="flex flex-col items-center space-y-4">
                                    <!-- Preview -->
                                    <div class="relative">
                                        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-green-100 dark:border-green-900/30">
                                            <img 
                                                ref="profilePreview"
                                                :src="profilePreviewUrl || '/default-avatar.png'" 
                                                alt="Profile Preview" 
                                                class="w-full h-full object-cover"
                                                @error="handlePreviewError"
                                            />
                                        </div>
                                        <button 
                                            v-if="profilePreviewUrl && profilePreviewUrl !== '/default-avatar.png'" 
                                            @click="removeProfilePicture"
                                            type="button"
                                            class="absolute -top-2 -right-2 bg-red-500 dark:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600 dark:hover:bg-red-700"
                                        >
                                            ×
                                        </button>
                                    </div>

                                    <!-- Upload Button -->
                                    <div class="flex space-x-2">
                                        <input 
                                            type="file" 
                                            ref="fileInput"
                                            @change="handleFileSelect"
                                            accept="image/*"
                                            class="hidden"
                                        >
                                        <button 
                                            type="button"
                                            @click="$refs.fileInput.click()"
                                            class="bg-green-600 dark:bg-green-700 hover:bg-green-700 dark:hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm flex items-center"
                                        >
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                            </svg>
                                            Choose Image
                                        </button>
                                        
                                        <button 
                                            v-if="selectedFile && !showCropper"
                                            type="button"
                                            @click="initCropper"
                                            class="bg-blue-600 dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm flex items-center"
                                        >
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5"></path>
                                            </svg>
                                            Crop Image
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Personal Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name *</label>
                                    <input 
                                        v-model="form.name"
                                        type="text" 
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Enter full name"
                                        :class="{ 'border-red-300 dark:border-red-500': form.errors.name }"
                                    >
                                    <div v-if="form.errors.name" class="text-red-500 dark:text-red-400 text-sm mt-1">{{ form.errors.name }}</div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address *</label>
                                    <input 
                                        v-model="form.email"
                                        type="email" 
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Enter email address"
                                        :class="{ 'border-red-300 dark:border-red-500': form.errors.email }"
                                    >
                                    <div v-if="form.errors.email" class="text-red-500 dark:text-red-400 text-sm mt-1">{{ form.errors.email }}</div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number</label>
                                    <input 
                                        v-model="form.phone"
                                        type="tel" 
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Enter phone number"
                                        :class="{ 'border-red-300 dark:border-red-500': form.errors.phone }"
                                    >
                                    <div v-if="form.errors.phone" class="text-red-500 dark:text-red-400 text-sm mt-1">{{ form.errors.phone }}</div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Branch Assignment</label>
                                    <select 
                                        v-model="form.branch_id"
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent text-sm lg:text-base"
                                        :class="{ 'border-red-300 dark:border-red-500': form.errors.branch_id }"
                                    >
                                        <option value="">Select Branch</option>
                                        <option v-for="branch in branches" :key="branch.id" :value="branch.id">
                                            {{ branch.name }} ({{ branch.code }})
                                        </option>
                                    </select>
                                    <div v-if="form.errors.branch_id" class="text-red-500 dark:text-red-400 text-sm mt-1">{{ form.errors.branch_id }}</div>
                                </div>
                            </div>

                            <!-- Address Information -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address</label>
                                <textarea 
                                    v-model="form.address"
                                    rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent text-sm lg:text-base"
                                    placeholder="Enter full address"
                                    :class="{ 'border-red-300 dark:border-red-500': form.errors.address }"
                                ></textarea>
                                <div v-if="form.errors.address" class="text-red-500 dark:text-red-400 text-sm mt-1">{{ form.errors.address }}</div>
                            </div>

                            <!-- Password -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password *</label>
                                    <input 
                                        v-model="form.password"
                                        type="password" 
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Enter password"
                                        :class="{ 'border-red-300 dark:border-red-500': form.errors.password }"
                                    >
                                    <div v-if="form.errors.password" class="text-red-500 dark:text-red-400 text-sm mt-1">{{ form.errors.password }}</div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirm Password *</label>
                                    <input 
                                        v-model="form.password_confirmation"
                                        type="password" 
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Confirm password"
                                    >
                                </div>
                            </div>

                            <!-- Role Information -->
                            <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 dark:text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm text-green-700 dark:text-green-300">This user will be created as a <strong>Branch Manager</strong> with branch operation management access.</span>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <button 
                                    type="button"
                                    @click="closeModal"
                                    class="px-6 py-3 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-full hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors text-sm lg:text-base order-2 sm:order-1"
                                >
                                    Cancel
                                </button>
                                <button 
                                    type="submit"
                                    :disabled="form.processing"
                                    class="px-6 py-3 bg-green-600 dark:bg-green-700 text-white rounded-full hover:bg-green-700 dark:hover:bg-green-600 transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed text-sm lg:text-base order-1 sm:order-2 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200"
                                >
                                    {{ form.processing ? 'Creating...' : 'Create Branch Manager' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Branch Manager Modal -->
                <div v-if="showEditModal" class="fixed inset-0 bg-black bg-opacity-50 dark:bg-opacity-70 flex items-center justify-center p-4 z-50">
                    <div class="bg-white dark:bg-gray-800 rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto mx-2">
                        <div class="px-4 lg:px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Edit Branch Manager</h3>
                        </div>

                        <form @submit.prevent="updateBranchManager" class="p-4 lg:p-6 space-y-4">
                            <!-- Profile Picture Section -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Profile Picture</label>
                                
                                <!-- Preview and Upload Area -->
                                <div class="flex flex-col items-center space-y-4">
                                    <!-- Preview -->
                                    <div class="relative">
                                        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-green-100 dark:border-green-900/30">
                                            <img 
                                                ref="editProfilePreview"
                                                :src="editProfilePreviewUrl || '/default-avatar.png'" 
                                                alt="Profile Preview" 
                                                class="w-full h-full object-cover"
                                                @error="handleEditPreviewError"
                                            />
                                        </div>
                                        <button 
                                            v-if="editProfilePreviewUrl && editProfilePreviewUrl !== '/default-avatar.png'" 
                                            @click="removeEditProfilePicture"
                                            type="button"
                                            class="absolute -top-2 -right-2 bg-red-500 dark:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600 dark:hover:bg-red-700"
                                        >
                                            ×
                                        </button>
                                    </div>

                                    <!-- Upload Button -->
                                    <div class="flex space-x-2">
                                        <input 
                                            type="file" 
                                            ref="editFileInput"
                                            @change="handleEditFileSelect"
                                            accept="image/*"
                                            class="hidden"
                                        >
                                        <button 
                                            type="button"
                                            @click="$refs.editFileInput.click()"
                                            class="bg-green-600 dark:bg-green-700 hover:bg-green-700 dark:hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm flex items-center"
                                        >
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                            </svg>
                                            Choose Image
                                        </button>
                                        
                                        <button 
                                            v-if="selectedEditFile && !showCropper"
                                            type="button"
                                            @click="initEditCropper"
                                            class="bg-blue-600 dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm flex items-center"
                                        >
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5"></path>
                                            </svg>
                                            Crop Image
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Personal Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name *</label>
                                    <input 
                                        v-model="editForm.name"
                                        type="text" 
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Enter full name"
                                        :class="{ 'border-red-300 dark:border-red-500': editForm.errors.name }"
                                    >
                                    <div v-if="editForm.errors.name" class="text-red-500 dark:text-red-400 text-sm mt-1">{{ editForm.errors.name }}</div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address *</label>
                                    <input 
                                        v-model="editForm.email"
                                        type="email" 
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Enter email address"
                                        :class="{ 'border-red-300 dark:border-red-500': editForm.errors.email }"
                                    >
                                    <div v-if="editForm.errors.email" class="text-red-500 dark:text-red-400 text-sm mt-1">{{ editForm.errors.email }}</div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number</label>
                                    <input 
                                        v-model="editForm.phone"
                                        type="tel" 
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Enter phone number"
                                        :class="{ 'border-red-300 dark:border-red-500': editForm.errors.phone }"
                                    >
                                    <div v-if="editForm.errors.phone" class="text-red-500 dark:text-red-400 text-sm mt-1">{{ editForm.errors.phone }}</div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Branch Assignment</label>
                                    <select 
                                        v-model="editForm.branch_id"
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent text-sm lg:text-base"
                                        :class="{ 'border-red-300 dark:border-red-500': editForm.errors.branch_id }"
                                    >
                                        <option value="">Select Branch</option>
                                        <option v-for="branch in branches" :key="branch.id" :value="branch.id">
                                            {{ branch.name }} ({{ branch.code }})
                                        </option>
                                    </select>
                                    <div v-if="editForm.errors.branch_id" class="text-red-500 dark:text-red-400 text-sm mt-1">{{ editForm.errors.branch_id }}</div>
                                </div>
                            </div>

                            <!-- Address Information -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address</label>
                                <textarea 
                                    v-model="editForm.address"
                                    rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent text-sm lg:text-base"
                                    placeholder="Enter full address"
                                    :class="{ 'border-red-300 dark:border-red-500': editForm.errors.address }"
                                ></textarea>
                                <div v-if="editForm.errors.address" class="text-red-500 dark:text-red-400 text-sm mt-1">{{ editForm.errors.address }}</div>
                            </div>

                            <!-- Password (Optional for edit) -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">New Password (Leave blank to keep current)</label>
                                    <input 
                                        v-model="editForm.password"
                                        type="password" 
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Enter new password"
                                        :class="{ 'border-red-300 dark:border-red-500': editForm.errors.password }"
                                    >
                                    <div v-if="editForm.errors.password" class="text-red-500 dark:text-red-400 text-sm mt-1">{{ editForm.errors.password }}</div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirm New Password</label>
                                    <input 
                                        v-model="editForm.password_confirmation"
                                        type="password" 
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Confirm new password"
                                    >
                                </div>
                            </div>

                            <!-- Remove profile picture checkbox -->
                            <div v-if="editingUser && editingUser.profile_picture_url" class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    v-model="editForm.remove_profile_picture"
                                    id="remove-profile-picture"
                                    class="h-4 w-4 text-green-600 dark:text-green-500 focus:ring-green-500 border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700"
                                >
                                <label for="remove-profile-picture" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    Remove current profile picture
                                </label>
                            </div>

                            <!-- Role Information -->
                            <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 dark:text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    <span class="text-sm text-green-700 dark:text-green-300">This user is a <strong>Branch Manager</strong> with branch operation management access.</span>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <button 
                                    type="button"
                                    @click="closeEditModal"
                                    class="px-6 py-3 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-full hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors text-sm lg:text-base order-2 sm:order-1"
                                >
                                    Cancel
                                </button>
                                <button 
                                    type="submit"
                                    :disabled="editForm.processing"
                                    class="px-6 py-3 bg-green-600 dark:bg-green-700 text-white rounded-full hover:bg-green-700 dark:hover:bg-green-600 transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed text-sm lg:text-base order-1 sm:order-2 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200"
                                >
                                    {{ editForm.processing ? 'Updating...' : 'Update Branch Manager' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Image Cropper Modal -->
                <div v-if="showCropper" class="fixed inset-0 bg-black bg-opacity-70 dark:bg-opacity-80 flex items-center justify-center p-4 z-[60]">
                    <div class="bg-white dark:bg-gray-800 rounded-lg w-full max-w-4xl max-h-[90vh] overflow-y-auto">
                        <div class="px-4 lg:px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Crop Image</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Drag to select area, then apply crop</p>
                        </div>

                        <div class="p-4 lg:p-6">
                            <!-- Cropper Container -->
                            <div class="mb-4 flex justify-center bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="relative inline-block">
                                    <img 
                                        ref="imageElement" 
                                        :src="imageSrc" 
                                        class="max-w-full max-h-96 cursor-crosshair"
                                        alt="Image to crop"
                                        @mousedown="startCrop"
                                        @touchstart="startCropTouch"
                                    />
                                    <div 
                                        v-if="cropArea.width > 0"
                                        ref="cropBox"
                                        class="absolute border-2 border-white shadow-lg bg-blue-500 dark:bg-blue-600 bg-opacity-20"
                                        :style="{
                                            left: cropArea.x + 'px',
                                            top: cropArea.y + 'px',
                                            width: cropArea.width + 'px',
                                            height: cropArea.height + 'px',
                                            cursor: isMoving ? 'grabbing' : 'grab'
                                        }"
                                        @mousedown="startMove"
                                        @touchstart="startMoveTouch"
                                    >
                                        <div class="absolute -top-1 -left-1 w-3 h-3 bg-white border-2 border-blue-500 dark:border-blue-400 cursor-nw-resize"
                                            @mousedown="startResize($event, 'nw')" @touchstart="startResizeTouch($event, 'nw')"></div>
                                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-white border-2 border-blue-500 dark:border-blue-400 cursor-ne-resize"
                                            @mousedown="startResize($event, 'ne')" @touchstart="startResizeTouch($event, 'ne')"></div>
                                        <div class="absolute -bottom-1 -left-1 w-3 h-3 bg-white border-2 border-blue-500 dark:border-blue-400 cursor-sw-resize"
                                            @mousedown="startResize($event, 'sw')" @touchstart="startResizeTouch($event, 'sw')"></div>
                                        <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-white border-2 border-blue-500 dark:border-blue-400 cursor-se-resize"
                                            @mousedown="startResize($event, 'se')" @touchstart="startResizeTouch($event, 'se')"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cropper Controls -->
                            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
                                <div class="flex space-x-2">
                                    <button @click="resetCrop" class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-lg text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                        Reset
                                    </button>
                                    <button @click="setSquareCrop" class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-lg text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                        Square
                                    </button>
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 text-center">
                                    Drag to select • Drag corners to resize • Drag box to move
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex justify-end space-x-2">
                                <button 
                                    @click="cancelCropper" 
                                    class="px-6 py-3 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-full hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors text-sm lg:text-base"
                                >
                                    Cancel
                                </button>
                                <button 
                                    @click="applyCrop" 
                                    class="px-6 py-3 bg-green-600 dark:bg-green-700 text-white rounded-full hover:bg-green-700 dark:hover:bg-green-600 transition-colors text-sm lg:text-base"
                                    :disabled="!cropArea.width"
                                >
                                    Apply Crop
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, nextTick } from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import { Head, Link } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

// Props from Laravel backend
const props = defineProps({
    branchManagers: {
        type: Array,
        default: () => []
    },
    branches: {
        type: Array,
        default: () => []
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
const showCreateModal = ref(false)
const showEditModal = ref(false)
const showCropper = ref(false)
const searchQuery = ref('')
const editingUser = ref(null)

// Profile picture state
const profilePreviewUrl = ref('')
const editProfilePreviewUrl = ref('')
const selectedFile = ref(null)
const selectedEditFile = ref(null)
const imageSrc = ref('')
const croppingMode = ref('create') // 'create' or 'edit'

// Cropping state
const imageElement = ref(null)
const cropBox = ref(null)
const cropping = ref(false)
const cropArea = ref({
    x: 0,
    y: 0,
    width: 0,
    height: 0
})
let isResizing = false
let resizeDirection = ''
let isMoving = false
let startX = 0
let startY = 0
let startCropX = 0
let startCropY = 0

// Forms
const form = useForm({
    name: '',
    email: '',
    phone: '',
    address: '',
    branch_id: '',
    password: '',
    password_confirmation: '',
    role_id: null, // This should be set to Branch Manager role ID
    profile_picture_data: null
})

const editForm = useForm({
    id: null,
    name: '',
    email: '',
    phone: '',
    address: '',
    branch_id: '',
    password: '',
    password_confirmation: '',
    profile_picture_data: null,
    remove_profile_picture: false
})

// Computed properties
const filteredBranchManagers = computed(() => {
    if (!searchQuery.value) return props.branchManagers
  
    const query = searchQuery.value.toLowerCase()
    return props.branchManagers.filter(user => 
        user.name?.toLowerCase().includes(query) ||
        user.email?.toLowerCase().includes(query) ||
        user.phone?.toLowerCase().includes(query) ||
        user.branch?.name?.toLowerCase().includes(query)
    )
})

// Methods
const createBranchManager = () => {
    // Set role_id to Branch Manager role (you need to get this from props or API)
    form.role_id = 2; // Assuming Branch Manager role has ID 2
    
    form.post('/users', {
        preserveScroll: true,
        onSuccess: () => {
            closeModal()
            form.reset()
            profilePreviewUrl.value = ''
        },
    })
}

const editBranchManager = (user) => {
    editingUser.value = user
    editForm.id = user.id
    editForm.name = user.name
    editForm.email = user.email
    editForm.phone = user.phone || ''
    editForm.address = user.address || ''
    editForm.branch_id = user.branch_id || ''
    editForm.password = ''
    editForm.password_confirmation = ''
    editForm.remove_profile_picture = false
    
    // Set profile preview
    if (user.profile_picture_url) {
        editProfilePreviewUrl.value = user.profile_picture_url
    } else {
        editProfilePreviewUrl.value = ''
    }
    
    showEditModal.value = true
}

const updateBranchManager = () => {
    if (!editingUser.value) return
  
    // Only include password if it's provided
    const data = { ...editForm.data() }
    if (!data.password) {
        delete data.password
        delete data.password_confirmation
    }
    
    editForm.put(`/users/${editingUser.value.id}`, {
        preserveScroll: true,
        onSuccess: () => {
            closeEditModal()
            editForm.reset()
            editProfilePreviewUrl.value = ''
        },
    })
}

const deleteBranchManager = (user) => {
    if (confirm(`Are you sure you want to delete ${user.name}? This action cannot be undone.`)) {
        router.delete(`/users/${user.id}`, {
            preserveScroll: true,
        })
    }
}

const closeModal = () => {
    showCreateModal.value = false
    form.reset()
    form.clearErrors()
    profilePreviewUrl.value = ''
    selectedFile.value = null
}

const closeEditModal = () => {
    showEditModal.value = false
    editingUser.value = null
    editForm.reset()
    editForm.clearErrors()
    editProfilePreviewUrl.value = ''
    selectedEditFile.value = null
}

// Profile picture methods
const handleFileSelect = (event) => {
    const file = event.target.files[0]
    if (!file) return

    // Validate file type
    if (!file.type.startsWith('image/')) {
        alert('Please select a valid image file (JPEG, PNG, GIF)')
        return
    }

    // Validate file size (max 2MB)
    if (file.size > 2 * 1024 * 1024) {
        alert('Image size should be less than 2MB')
        return
    }

    selectedFile.value = file
    
    // Create preview
    const reader = new FileReader()
    reader.onload = (e) => {
        profilePreviewUrl.value = e.target.result
        imageSrc.value = e.target.result
    }
    reader.readAsDataURL(file)
}

const handleEditFileSelect = (event) => {
    const file = event.target.files[0]
    if (!file) return

    // Validate file type
    if (!file.type.startsWith('image/')) {
        alert('Please select a valid image file (JPEG, PNG, GIF)')
        return
    }

    // Validate file size (max 2MB)
    if (file.size > 2 * 1024 * 1024) {
        alert('Image size should be less than 2MB')
        return
    }

    selectedEditFile.value = file
    
    // Create preview
    const reader = new FileReader()
    reader.onload = (e) => {
        editProfilePreviewUrl.value = e.target.result
        imageSrc.value = e.target.result
    }
    reader.readAsDataURL(file)
}

const removeProfilePicture = () => {
    selectedFile.value = null
    profilePreviewUrl.value = '/default-avatar.png'
    form.profile_picture_data = null
}

const removeEditProfilePicture = () => {
    selectedEditFile.value = null
    editProfilePreviewUrl.value = editingUser.value?.profile_picture_url || '/default-avatar.png'
    editForm.profile_picture_data = null
}

// Cropper methods
const initCropper = async () => {
    croppingMode.value = 'create'
    showCropper.value = true
    await nextTick()
    resetCrop()
    
    // Add event listeners
    document.addEventListener('mousemove', handleMouseMove)
    document.addEventListener('mouseup', handleMouseUp)
    document.addEventListener('touchmove', handleTouchMove, { passive: false })
    document.addEventListener('touchend', handleTouchEnd)
}

const initEditCropper = async () => {
    croppingMode.value = 'edit'
    showCropper.value = true
    await nextTick()
    resetCrop()
    
    // Add event listeners
    document.addEventListener('mousemove', handleMouseMove)
    document.addEventListener('mouseup', handleMouseUp)
    document.addEventListener('touchmove', handleTouchMove, { passive: false })
    document.addEventListener('touchend', handleTouchEnd)
}

const resetCrop = () => {
    cropArea.value = { x: 0, y: 0, width: 0, height: 0 }
    cropping.value = false
    isResizing = false
    isMoving = false
}

const setSquareCrop = () => {
    if (!imageElement.value) return
    
    const img = imageElement.value
    const size = Math.min(img.offsetWidth, img.offsetHeight) * 0.6
    cropArea.value = {
        x: (img.offsetWidth - size) / 2,
        y: (img.offsetHeight - size) / 2,
        width: size,
        height: size
    }
}

const startCrop = (e) => {
    if (isResizing || isMoving) return
    
    const rect = imageElement.value.getBoundingClientRect()
    const x = e.clientX - rect.left
    const y = e.clientY - rect.top
    
    cropArea.value = { x, y, width: 0, height: 0 }
    cropping.value = true
    startCropX = x
    startCropY = y
}

const startCropTouch = (e) => {
    if (isResizing || isMoving) return
    
    const rect = imageElement.value.getBoundingClientRect()
    const x = e.touches[0].clientX - rect.left
    const y = e.touches[0].clientY - rect.top
    
    cropArea.value = { x, y, width: 0, height: 0 }
    cropping.value = true
    startCropX = x
    startCropY = y
}

const startMove = (e) => {
    e.preventDefault()
    e.stopPropagation()
    isMoving = true
    startX = e.clientX - cropArea.value.x
    startY = e.clientY - cropArea.value.y
}

const startMoveTouch = (e) => {
    e.preventDefault()
    e.stopPropagation()
    isMoving = true
    startX = e.touches[0].clientX - cropArea.value.x
    startY = e.touches[0].clientY - cropArea.value.y
}

const startResize = (e, direction) => {
    e.preventDefault()
    e.stopPropagation()
    isResizing = true
    resizeDirection = direction
    startX = cropArea.value.x
    startY = cropArea.value.y
}

const startResizeTouch = (e, direction) => {
    e.preventDefault()
    e.stopPropagation()
    isResizing = true
    resizeDirection = direction
    startX = cropArea.value.x
    startY = cropArea.value.y
}

const handleMouseMove = (e) => {
    handleMove(e.clientX, e.clientY)
}

const handleTouchMove = (e) => {
    if (e.touches.length > 0) {
        handleMove(e.touches[0].clientX, e.touches[0].clientY)
        e.preventDefault()
    }
}

const handleMove = (clientX, clientY) => {
    if (!imageElement.value) return
    
    const rect = imageElement.value.getBoundingClientRect()
    const x = clientX - rect.left
    const y = clientY - rect.top
    
    if (cropping.value && !isResizing && !isMoving) {
        // Creating new crop area
        const newX = Math.min(startCropX, x)
        const newY = Math.min(startCropY, y)
        const newWidth = Math.abs(x - startCropX)
        const newHeight = Math.abs(y - startCropY)
        
        // Ensure within bounds
        cropArea.value = {
            x: Math.max(0, newX),
            y: Math.max(0, newY),
            width: Math.min(rect.width - newX, newWidth),
            height: Math.min(rect.height - newY, newHeight)
        }
    } else if (isMoving) {
        // Moving existing crop area
        const newX = x - startX
        const newY = y - startY
        
        // Keep within image bounds
        cropArea.value.x = Math.max(0, Math.min(rect.width - cropArea.value.width, newX))
        cropArea.value.y = Math.max(0, Math.min(rect.height - cropArea.value.height, newY))
    } else if (isResizing) {
        // Resizing crop area
        let newX = cropArea.value.x
        let newY = cropArea.value.y
        let newWidth = cropArea.value.width
        let newHeight = cropArea.value.height
        
        switch (resizeDirection) {
            case 'se':
                newWidth = x - newX
                newHeight = y - newY
                break
            case 'sw':
                newWidth = cropArea.value.x + cropArea.value.width - x
                newX = x
                newHeight = y - newY
                break
            case 'ne':
                newWidth = x - newX
                newHeight = cropArea.value.y + cropArea.value.height - y
                newY = y
                break
            case 'nw':
                newWidth = cropArea.value.x + cropArea.value.width - x
                newHeight = cropArea.value.y + cropArea.value.height - y
                newX = x
                newY = y
                break
        }
        
        // Ensure minimum size and keep within bounds
        const minSize = 50
        cropArea.value = {
            x: Math.max(0, newX),
            y: Math.max(0, newY),
            width: Math.max(minSize, Math.min(rect.width - newX, newWidth)),
            height: Math.max(minSize, Math.min(rect.height - newY, newHeight))
        }
    }
}

const handleMouseUp = () => {
    cropping.value = false
    isResizing = false
    isMoving = false
}

const handleTouchEnd = () => {
    cropping.value = false
    isResizing = false
    isMoving = false
}

const applyCrop = () => {
    if (!imageElement.value || !cropArea.value.width) {
        alert('Please select an area to crop')
        return
    }

    const canvas = document.createElement('canvas')
    const ctx = canvas.getContext('2d')
    
    // Set canvas size for the cropped area (300x300 for profile picture)
    const outputSize = 300
    canvas.width = outputSize
    canvas.height = outputSize

    const img = imageElement.value
    
    // Calculate scale factors between displayed image and original image
    const scaleX = img.naturalWidth / img.offsetWidth
    const scaleY = img.naturalHeight / img.offsetHeight

    // Calculate the actual pixel coordinates in the original image
    const sourceX = cropArea.value.x * scaleX
    const sourceY = cropArea.value.y * scaleY
    const sourceWidth = cropArea.value.width * scaleX
    const sourceHeight = cropArea.value.height * scaleY

    // Clear canvas
    ctx.clearRect(0, 0, outputSize, outputSize)
    
    // Draw the cropped area onto the canvas, scaled to output size
    ctx.drawImage(
        img,
        sourceX, sourceY, sourceWidth, sourceHeight, // Source rectangle (from original image)
        0, 0, outputSize, outputSize // Destination rectangle (to canvas)
    )

    // Convert canvas to base64
    const croppedImageData = canvas.toDataURL('image/jpeg', 0.9)
    
    // Update the appropriate form and preview
    if (croppingMode.value === 'create') {
        form.profile_picture_data = croppedImageData
        profilePreviewUrl.value = croppedImageData
    } else {
        editForm.profile_picture_data = croppedImageData
        editProfilePreviewUrl.value = croppedImageData
    }
    
    showCropper.value = false
    
    // Clean up event listeners
    removeEventListeners()
}

const removeEventListeners = () => {
    document.removeEventListener('mousemove', handleMouseMove)
    document.removeEventListener('mouseup', handleMouseUp)
    document.removeEventListener('touchmove', handleTouchMove)
    document.removeEventListener('touchend', handleTouchEnd)
}

const cancelCropper = () => {
    showCropper.value = false
    resetCrop()
    removeEventListeners()
}

// Clean up event listeners when component unmounts
onUnmounted(() => {
    removeEventListeners()
})

// Image error handling
const handleImageError = (event) => {
    event.target.src = '/default-avatar.png'
}

const handlePreviewError = (event) => {
    event.target.src = '/default-avatar.png'
}

const handleEditPreviewError = (event) => {
    event.target.src = '/default-avatar.png'
}

// Helper functions
const getUserInitials = (name) => {
    if (!name) return 'BM'
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
</script>

<style scoped>
/* Custom styles */
.resize-handle {
    position: absolute;
    background: white;
    border: 2px solid #3b82f6;
    width: 12px;
    height: 12px;
}

.resize-nw { top: -6px; left: -6px; cursor: nw-resize; }
.resize-ne { top: -6px; right: -6px; cursor: ne-resize; }
.resize-sw { bottom: -6px; left: -6px; cursor: sw-resize; }
.resize-se { bottom: -6px; right: -6px; cursor: se-resize; }

/* Image upload styles */
.profile-picture-upload {
    border: 2px dashed #d1d5db;
    border-radius: 0.5rem;
    padding: 2rem;
    text-align: center;
    background-color: #f9fafb;
    cursor: pointer;
    transition: all 0.3s ease;
}

.profile-picture-upload:hover {
    border-color: #10b981;
    background-color: #f0fdf4;
}

.dark .profile-picture-upload {
    border-color: #4b5563;
    background-color: #1f2937;
}

.dark .profile-picture-upload:hover {
    border-color: #10b981;
    background-color: #064e3b20;
}

/* Cropper styles */
.cropper-container {
    position: relative;
    user-select: none;
}

.crop-box {
    position: absolute;
    border: 2px solid white;
    box-shadow: 0 0 0 9999px rgba(0, 0, 0, 0.5);
    cursor: move;
}

.dark .crop-box {
    box-shadow: 0 0 0 9999px rgba(0, 0, 0, 0.7);
}

.crop-handle {
    position: absolute;
    width: 12px;
    height: 12px;
    background: white;
    border: 2px solid #3b82f6;
}

/* Modal styles */
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

/* Dark mode scrollbar */
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
}

/* Improve touch targets on mobile */
@media (max-width: 640px) {
    button {
        min-height: 44px;
    }
}

/* Smooth transitions */
.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
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

/* Focus styles for better accessibility */
:focus-visible {
    outline: 2px solid #10b981;
    outline-offset: 2px;
}

.dark :focus-visible {
    outline-color: #34d399;
}

/* Selection colors */
::selection {
    background-color: #10b981;
    color: white;
}

.dark ::selection {
    background-color: #34d399;
    color: #1f2937;
}

/* Responsive table */
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
.disabled:bg-gray-400 {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Image preview border for dark mode */
.dark .border-4.border-green-100 {
    border-color: rgba(6, 78, 59, 0.3);
}
</style>
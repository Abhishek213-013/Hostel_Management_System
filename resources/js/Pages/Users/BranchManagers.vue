<template>
    <Head title="Branch Managers Management" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Branch Managers Management
                </h2>
                <div class="text-sm text-gray-500">
                    {{ currentDate }}
                </div>
            </div>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Welcome Section -->
                <div class="mb-8">
                    <div class="flex items-center space-x-2 mb-2">
                        <Link href="/users" class="text-blue-600 hover:text-blue-800 text-sm">
                            Users
                        </Link>
                        <span class="text-gray-400">/</span>
                        <h1 class="text-2xl font-bold text-gray-900">Branch Managers</h1>
                    </div>
                    <p class="text-gray-600 mt-2">Manage branch manager accounts for hostel operations</p>
                </div>

                <!-- Flash Messages -->
                <div v-if="flash?.success" class="mb-6 p-3 lg:p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 lg:w-5 lg:h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-green-700 text-sm lg:text-base">{{ flash.success }}</span>
                    </div>
                </div>

                <div v-if="flash?.error" class="mb-6 p-3 lg:p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 lg:w-5 lg:h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-red-700 text-sm lg:text-base">{{ flash.error }}</span>
                    </div>
                </div>

                <!-- Header with Add Button -->
                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4 mb-6">
                    <div></div> <!-- Spacer -->
                    <button 
                        @click="showCreateModal = true"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-full flex items-center justify-center space-x-2 transition-all duration-200 w-full lg:w-auto text-sm lg:text-base shadow-md hover:shadow-lg active:scale-95"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="font-medium">Add Branch Manager</span>
                    </button>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div class="bg-white rounded-lg shadow border border-gray-200 p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600">Total Managers</h3>
                                <p class="text-2xl font-bold text-gray-900 mt-1">{{ branchManagers.length }}</p>
                            </div>
                            <div class="p-2 bg-green-100 rounded-lg">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow border border-gray-200 p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600">Active Branches</h3>
                                <p class="text-2xl font-bold text-gray-900 mt-1">{{ stats?.activeBranches || 0 }}</p>
                            </div>
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow border border-gray-200 p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600">This Month</h3>
                                <p class="text-2xl font-bold text-gray-900 mt-1">{{ stats?.thisMonth || 0 }}</p>
                            </div>
                            <div class="p-2 bg-purple-100 rounded-lg">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow border border-gray-200 p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600">Assigned Branches</h3>
                                <p class="text-2xl font-bold text-gray-900 mt-1">{{ stats?.assignedBranches || 0 }}</p>
                            </div>
                            <div class="p-2 bg-orange-100 rounded-lg">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Users Table Section -->
                <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden mb-8">
                    <div class="px-4 lg:px-6 py-4 border-b border-gray-200">
                        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
                            <h3 class="text-base lg:text-lg font-semibold text-gray-800">Branch Managers</h3>
                            <div class="relative w-full lg:w-auto">
                                <input 
                                    type="text" 
                                    v-model="searchQuery"
                                    placeholder="Search branch managers..." 
                                    class="w-full lg:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm lg:text-base"
                                >
                                <svg class="w-4 h-4 lg:w-5 lg:h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="lg:hidden divide-y divide-gray-200">
                        <div v-for="user in filteredBranchManagers" :key="user.id" class="p-4 hover:bg-gray-50">
                            <div class="flex items-start space-x-3 mb-3">
                                <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-sm font-semibold">
                                        {{ getUserInitials(user.name) }}
                                    </span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-medium text-gray-900 truncate">{{ user.name }}</div>
                                    <div class="text-sm text-gray-500 truncate">{{ user.email }}</div>
                                    <div class="text-sm text-gray-500 truncate">{{ user.phone || 'N/A' }}</div>
                                </div>
                            </div>
                            
                            <div class="space-y-2 text-sm text-gray-600 mb-3">
                                <div v-if="user.branch"><strong>Branch:</strong> {{ user.branch.name }}</div>
                                <div><strong>Joined:</strong> {{ formatDate(user.created_at) }}</div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Active
                                </span>
                                <div class="flex space-x-2">
                                    <button 
                                        @click="editBranchManager(user)"
                                        class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50"
                                        title="Edit Branch Manager"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button 
                                        @click="deleteBranchManager(user)"
                                        class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50"
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
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Manager</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Branch</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="user in filteredBranchManagers" :key="user.id" class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center">
                                                <span class="text-white text-sm font-semibold">
                                                    {{ getUserInitials(user.name) }}
                                                </span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ user.name }}</div>
                                                <div class="text-sm text-gray-500">{{ user.email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ user.email }}</div>
                                        <div class="text-sm text-gray-500">{{ user.phone || 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ user.branch?.name || 'Unassigned' }}</div>
                                        <div class="text-sm text-gray-500">Joined: {{ formatDate(user.created_at) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <button 
                                                @click="editBranchManager(user)"
                                                class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50 transition-colors"
                                                title="Edit Branch Manager"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>
                                            <button 
                                                @click="deleteBranchManager(user)"
                                                class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50 transition-colors"
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
                        <svg class="w-12 h-12 lg:w-16 lg:h-16 text-gray-400 mx-auto mb-3 lg:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <h3 class="text-base lg:text-lg font-medium text-gray-900 mb-2">No branch managers found</h3>
                        <p class="text-gray-500 text-sm lg:text-base mb-4">Get started by creating your first branch manager.</p>
                        <button 
                            @click="showCreateModal = true"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-full transition-colors text-sm lg:text-base shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200"
                        >
                            Add Branch Manager
                        </button>
                    </div>
                </div>

                <!-- Create Branch Manager Modal -->
                <div v-if="showCreateModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
                    <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto mx-2">
                        <div class="px-4 lg:px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800">Create New Branch Manager</h3>
                        </div>

                        <form @submit.prevent="createBranchManager" class="p-4 lg:p-6 space-y-4">
                            <!-- Personal Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                    <input 
                                        v-model="form.name"
                                        type="text" 
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Enter full name"
                                        :class="{ 'border-red-300': form.errors.name }"
                                    >
                                    <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                    <input 
                                        v-model="form.email"
                                        type="email" 
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Enter email address"
                                        :class="{ 'border-red-300': form.errors.email }"
                                    >
                                    <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                    <input 
                                        v-model="form.phone"
                                        type="tel" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Enter phone number"
                                        :class="{ 'border-red-300': form.errors.phone }"
                                    >
                                    <div v-if="form.errors.phone" class="text-red-500 text-sm mt-1">{{ form.errors.phone }}</div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Branch Assignment</label>
                                    <select 
                                        v-model="form.branch_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm lg:text-base"
                                        :class="{ 'border-red-300': form.errors.branch_id }"
                                    >
                                        <option value="">Select Branch</option>
                                        <option v-for="branch in branches" :key="branch.id" :value="branch.id">
                                            {{ branch.name }} ({{ branch.code }})
                                        </option>
                                    </select>
                                    <div v-if="form.errors.branch_id" class="text-red-500 text-sm mt-1">{{ form.errors.branch_id }}</div>
                                </div>
                            </div>

                            <!-- Address Information -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                <textarea 
                                    v-model="form.address"
                                    rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm lg:text-base"
                                    placeholder="Enter full address"
                                    :class="{ 'border-red-300': form.errors.address }"
                                ></textarea>
                                <div v-if="form.errors.address" class="text-red-500 text-sm mt-1">{{ form.errors.address }}</div>
                            </div>

                            <!-- Password -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                                    <input 
                                        v-model="form.password"
                                        type="password" 
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Enter password"
                                        :class="{ 'border-red-300': form.errors.password }"
                                    >
                                    <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password *</label>
                                    <input 
                                        v-model="form.password_confirmation"
                                        type="password" 
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Confirm password"
                                    >
                                </div>
                            </div>

                            <!-- Role Information -->
                            <div class="p-4 bg-green-50 rounded-lg">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm text-green-700">This user will be created as a <strong>Branch Manager</strong> with branch operation management access.</span>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-4 border-t border-gray-200">
                                <button 
                                    type="button"
                                    @click="closeModal"
                                    class="px-6 py-3 text-gray-700 border border-gray-300 rounded-full hover:bg-gray-50 transition-colors text-sm lg:text-base order-2 sm:order-1"
                                >
                                    Cancel
                                </button>
                                <button 
                                    type="submit"
                                    :disabled="form.processing"
                                    class="px-6 py-3 bg-green-600 text-white rounded-full hover:bg-green-700 transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed text-sm lg:text-base order-1 sm:order-2 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200"
                                >
                                    {{ form.processing ? 'Creating...' : 'Create Branch Manager' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Branch Manager Modal -->
                <div v-if="showEditModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
                    <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto mx-2">
                        <div class="px-4 lg:px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800">Edit Branch Manager</h3>
                        </div>

                        <form @submit.prevent="updateBranchManager" class="p-4 lg:p-6 space-y-4">
                            <!-- Personal Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                    <input 
                                        v-model="editForm.name"
                                        type="text" 
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Enter full name"
                                        :class="{ 'border-red-300': editForm.errors.name }"
                                    >
                                    <div v-if="editForm.errors.name" class="text-red-500 text-sm mt-1">{{ editForm.errors.name }}</div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                    <input 
                                        v-model="editForm.email"
                                        type="email" 
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Enter email address"
                                        :class="{ 'border-red-300': editForm.errors.email }"
                                    >
                                    <div v-if="editForm.errors.email" class="text-red-500 text-sm mt-1">{{ editForm.errors.email }}</div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                    <input 
                                        v-model="editForm.phone"
                                        type="tel" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Enter phone number"
                                        :class="{ 'border-red-300': editForm.errors.phone }"
                                    >
                                    <div v-if="editForm.errors.phone" class="text-red-500 text-sm mt-1">{{ editForm.errors.phone }}</div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Branch Assignment</label>
                                    <select 
                                        v-model="editForm.branch_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm lg:text-base"
                                        :class="{ 'border-red-300': editForm.errors.branch_id }"
                                    >
                                        <option value="">Select Branch</option>
                                        <option v-for="branch in branches" :key="branch.id" :value="branch.id">
                                            {{ branch.name }} ({{ branch.code }})
                                        </option>
                                    </select>
                                    <div v-if="editForm.errors.branch_id" class="text-red-500 text-sm mt-1">{{ editForm.errors.branch_id }}</div>
                                </div>
                            </div>

                            <!-- Address Information -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                <textarea 
                                    v-model="editForm.address"
                                    rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm lg:text-base"
                                    placeholder="Enter full address"
                                    :class="{ 'border-red-300': editForm.errors.address }"
                                ></textarea>
                                <div v-if="editForm.errors.address" class="text-red-500 text-sm mt-1">{{ editForm.errors.address }}</div>
                            </div>

                            <!-- Password (Optional for edit) -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">New Password (Leave blank to keep current)</label>
                                    <input 
                                        v-model="editForm.password"
                                        type="password" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Enter new password"
                                        :class="{ 'border-red-300': editForm.errors.password }"
                                    >
                                    <div v-if="editForm.errors.password" class="text-red-500 text-sm mt-1">{{ editForm.errors.password }}</div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                                    <input 
                                        v-model="editForm.password_confirmation"
                                        type="password" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm lg:text-base"
                                        placeholder="Confirm new password"
                                    >
                                </div>
                            </div>

                            <!-- Role Information -->
                            <div class="p-4 bg-green-50 rounded-lg">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    <span class="text-sm text-green-700">This user is a <strong>Branch Manager</strong> with branch operation management access.</span>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-4 border-t border-gray-200">
                                <button 
                                    type="button"
                                    @click="closeEditModal"
                                    class="px-6 py-3 text-gray-700 border border-gray-300 rounded-full hover:bg-gray-50 transition-colors text-sm lg:text-base order-2 sm:order-1"
                                >
                                    Cancel
                                </button>
                                <button 
                                    type="submit"
                                    :disabled="editForm.processing"
                                    class="px-6 py-3 bg-green-600 text-white rounded-full hover:bg-green-700 transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed text-sm lg:text-base order-1 sm:order-2 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200"
                                >
                                    {{ editForm.processing ? 'Updating...' : 'Update Branch Manager' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed } from 'vue'
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
const searchQuery = ref('')
const editingUser = ref(null)

// Forms
const form = useForm({
    name: '',
    email: '',
    phone: '',
    address: '',
    branch_id: '',
    password: '',
    password_confirmation: '',
    role_id: null // This should be set to Branch Manager role ID
})

const editForm = useForm({
    id: null,
    name: '',
    email: '',
    phone: '',
    address: '',
    branch_id: '',
    password: '',
    password_confirmation: ''
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
}

const closeEditModal = () => {
    showEditModal.value = false
    editingUser.value = null
    editForm.reset()
    editForm.clearErrors()
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
.emergency-btn {
    transition: all 0.3s ease;
}

.emergency-btn:hover {
    box-shadow: 0 10px 25px rgba(220, 38, 38, 0.4);
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
</style>
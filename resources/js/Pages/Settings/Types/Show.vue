<template>
    <Head :title="`${mainType.name} - Type Configuration`" />
    
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ mainType.name }} - Type Configuration
                </h2>
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Manage types for {{ mainType.name }}
                </div>
            </div>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4 mb-6">
                    <div>
                        <div class="flex items-center space-x-2 mb-2">
                            <Link href="/settings" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm">
                                Settings
                            </Link>
                            <span class="text-gray-400 dark:text-gray-500">/</span>
                            <Link href="/settings/types" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm">
                                Type Configuration
                            </Link>
                            <span class="text-gray-400 dark:text-gray-500">/</span>
                            <h1 class="text-xl lg:text-2xl font-bold text-gray-900 dark:text-white">{{ mainType.name }}</h1>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 text-sm lg:text-base">{{ mainType.description || 'Manage types for ' + mainType.name }}</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button 
                            @click="showCreateTypeModal = true"
                            class="bg-blue-600 dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-600 text-white px-6 py-3 rounded-lg flex items-center justify-center space-x-2 transition-all duration-200 text-sm lg:text-base shadow-md hover:shadow-lg active:scale-95"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span class="font-medium">Add {{ mainType.name }}</span>
                        </button>
                        
                        <Link 
                            href="/settings/types"
                            class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 px-6 py-3 rounded-lg flex items-center justify-center space-x-2 transition-all duration-200 text-sm lg:text-base"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <span>Back to All Types</span>
                        </Link>
                    </div>
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

                <!-- Main Type Info Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 mb-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center space-x-4 mb-3">
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ mainType.name }}</h2>
                                <span 
                                    :class="['px-3 py-1 text-xs font-semibold rounded-full', 
                                        mainType.status 
                                            ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300' 
                                            : 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300'
                                    ]"
                                >
                                    {{ mainType.status ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">{{ mainType.description || 'No description available' }}</p>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                <div>
                                    <div class="text-gray-500 dark:text-gray-400">Position</div>
                                    <div class="font-medium text-gray-900 dark:text-white">{{ mainType.position }}</div>
                                </div>
                                <div>
                                    <div class="text-gray-500 dark:text-gray-400">Total Types</div>
                                    <div class="font-medium text-gray-900 dark:text-white">{{ types.total || 0 }}</div>
                                </div>
                                <div>
                                    <div class="text-gray-500 dark:text-gray-400">Created</div>
                                    <div class="font-medium text-gray-900 dark:text-white">{{ formatDate(mainType.created_at) }}</div>
                                </div>
                                <div>
                                    <div class="text-gray-500 dark:text-gray-400">Last Modified</div>
                                    <div class="font-medium text-gray-900 dark:text-white">{{ formatDate(mainType.updated_at) }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            <button 
                                @click="editMainTypeInfo"
                                class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20"
                                title="Edit Main Type"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button 
                                @click="toggleMainTypeStatus"
                                :class="['p-2 rounded-lg', 
                                    mainType.status 
                                        ? 'text-yellow-600 dark:text-yellow-500 hover:text-yellow-800 dark:hover:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-yellow-900/20' 
                                        : 'text-green-600 dark:text-green-500 hover:text-green-800 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20'
                                ]"
                                :title="mainType.status ? 'Deactivate' : 'Activate'"
                            >
                                <svg v-if="mainType.status" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                </svg>
                                <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Search and Filters -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4 mb-6">
                    <div class="flex flex-col lg:flex-row lg:items-center gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <input 
                                    type="text" 
                                    v-model="searchQuery"
                                    placeholder="Search types..." 
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent text-sm lg:text-base placeholder-gray-500 dark:placeholder-gray-400"
                                >
                                <svg class="w-4 h-4 lg:w-5 lg:h-5 text-gray-400 dark:text-gray-500 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <label class="text-sm text-gray-600 dark:text-gray-400">Status:</label>
                                <select 
                                    v-model="statusFilter"
                                    class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400"
                                >
                                    <option value="all">All</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="flex items-center space-x-2">
                                <label class="text-sm text-gray-600 dark:text-gray-400">Sort by:</label>
                                <select 
                                    v-model="sortBy"
                                    class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400"
                                >
                                    <option value="position">Position</option>
                                    <option value="name">Name</option>
                                    <option value="created_at">Created Date</option>
                                    <option value="updated_at">Updated Date</option>
                                </select>
                                <select 
                                    v-model="sortOrder"
                                    class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400"
                                >
                                    <option value="asc">Asc</option>
                                    <option value="desc">Desc</option>
                                </select>
                            </div>
                            <button 
                                @click="resetFilters"
                                class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-300 text-sm"
                            >
                                Reset
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Types Table -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden mb-8">
                    <div class="px-4 lg:px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
                            <h3 class="text-base lg:text-lg font-semibold text-gray-800 dark:text-gray-200">{{ mainType.name }} List</h3>
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                Showing {{ types.from || 0 }} to {{ types.to || 0 }} of {{ types.total || 0 }} types
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="lg:hidden divide-y divide-gray-200 dark:divide-gray-700">
                        <div v-for="type in filteredTypes" :key="type.id" class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-1">{{ type.name }}</div>
                                    <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                        <span>Position: {{ type.position }}</span>
                                        <span 
                                            :class="['px-2 py-0.5 text-xs font-semibold rounded-full', 
                                                type.status 
                                                    ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300' 
                                                    : 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300'
                                            ]"
                                        >
                                            {{ type.status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <button 
                                        @click="editType(type)"
                                        class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 p-1.5 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20"
                                        title="Edit Type"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button 
                                        @click="toggleTypeStatus(type)"
                                        :class="['p-1.5 rounded', 
                                            type.status 
                                                ? 'text-yellow-600 dark:text-yellow-500 hover:text-yellow-800 dark:hover:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-yellow-900/20' 
                                                : 'text-green-600 dark:text-green-500 hover:text-green-800 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20'
                                        ]"
                                        :title="type.status ? 'Deactivate' : 'Activate'"
                                    >
                                        <svg v-if="type.status" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                        </svg>
                                        <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <button 
                                        @click="deleteType(type)"
                                        class="text-red-600 dark:text-red-500 hover:text-red-800 dark:hover:text-red-400 p-1.5 rounded hover:bg-red-50 dark:hover:bg-red-900/20"
                                        title="Delete Type"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="space-y-1 text-sm text-gray-600 dark:text-gray-300">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Created: {{ formatDate(type.created_at) }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    <span>Updated: {{ formatDate(type.updated_at) }}</span>
                                </div>
                                <div v-if="type.metadata" class="mt-2">
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Metadata:</div>
                                    <div class="text-xs bg-gray-50 dark:bg-gray-900/50 p-2 rounded">{{ JSON.stringify(type.metadata) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Desktop Table View -->
                    <div class="hidden lg:block overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Slug</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Position</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Updates</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Created</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <tr v-for="type in filteredTypes" :key="type.id" class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ type.name }}</div>
                                        <div v-if="type.metadata" class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            {{ JSON.stringify(type.metadata) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ type.slug }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ type.position }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span 
                                            :class="['px-2 inline-flex text-xs leading-5 font-semibold rounded-full', 
                                                type.status 
                                                    ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300' 
                                                    : 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300'
                                            ]"
                                        >
                                            {{ type.status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ type.update_count }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ formatDate(type.created_at) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <button 
                                                @click="editType(type)"
                                                class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors"
                                                title="Edit Type"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>
                                            <button 
                                                @click="toggleTypeStatus(type)"
                                                :class="['p-2 rounded-lg transition-colors', 
                                                    type.status 
                                                        ? 'text-yellow-600 dark:text-yellow-500 hover:text-yellow-900 dark:hover:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-yellow-900/20' 
                                                        : 'text-green-600 dark:text-green-500 hover:text-green-900 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20'
                                                ]"
                                                :title="type.status ? 'Deactivate' : 'Activate'"
                                            >
                                                <svg v-if="type.status" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                                </svg>
                                                <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </button>
                                            <button 
                                                @click="deleteType(type)"
                                                class="text-red-600 dark:text-red-500 hover:text-red-900 dark:hover:text-red-400 p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors"
                                                title="Delete Type"
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
                    <div v-if="filteredTypes.length === 0" class="text-center py-8 lg:py-12">
                        <svg class="w-12 h-12 lg:w-16 lg:h-16 text-gray-400 dark:text-gray-500 mx-auto mb-3 lg:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        <h3 class="text-base lg:text-lg font-medium text-gray-900 dark:text-white mb-2">No types found</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm lg:text-base mb-4">Get started by creating your first type for {{ mainType.name }}.</p>
                        <button 
                            @click="showCreateTypeModal = true"
                            class="bg-blue-600 dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition-colors text-sm lg:text-base shadow-md hover:shadow-lg"
                        >
                            Add Type
                        </button>
                    </div>

                    <!-- Pagination -->
                    <div v-if="types.data && types.data.length > 0" class="px-4 lg:px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                Showing {{ types.from }} to {{ types.to }} of {{ types.total }} types
                            </div>
                            <div class="flex items-center space-x-2">
                                <button 
                                    @click="previousPage"
                                    :disabled="!types.prev_page_url"
                                    :class="['px-4 py-2 text-sm font-medium rounded-lg border', 
                                        types.prev_page_url 
                                            ? 'text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700' 
                                            : 'text-gray-400 dark:text-gray-500 border-gray-200 dark:border-gray-700 cursor-not-allowed'
                                    ]"
                                >
                                    Previous
                                </button>
                                
                                <!-- Page Numbers -->
                                <div class="hidden sm:flex items-center space-x-1">
                                    <button 
                                        v-for="page in paginationRange"
                                        :key="page"
                                        @click="goToPage(page)"
                                        :class="['w-10 h-10 flex items-center justify-center rounded-lg text-sm font-medium', 
                                            types.current_page === page 
                                                ? 'bg-blue-600 dark:bg-blue-700 text-white' 
                                                : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'
                                        ]"
                                    >
                                        {{ page }}
                                    </button>
                                </div>
                                
                                <button 
                                    @click="nextPage"
                                    :disabled="!types.next_page_url"
                                    :class="['px-4 py-2 text-sm font-medium rounded-lg border', 
                                        types.next_page_url 
                                            ? 'text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700' 
                                            : 'text-gray-400 dark:text-gray-500 border-gray-200 dark:border-gray-700 cursor-not-allowed'
                                    ]"
                                >
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Create Type Modal -->
                <CreateTypeModal 
                    v-if="showCreateTypeModal"
                    :show="showCreateTypeModal"
                    :main-type="mainType"
                    @close="showCreateTypeModal = false"
                    @created="handleTypeCreated"
                />

                <!-- Edit Type Modal -->
                <EditTypeModal 
                    v-if="showEditTypeModal"
                    :show="showEditTypeModal"
                    :type="editingType"
                    :main-type="mainType"
                    @close="showEditTypeModal = false"
                    @updated="handleTypeUpdated"
                />

                <!-- Edit Main Type Modal -->
                <EditMainTypeModal 
                    v-if="showEditMainTypeModal"
                    :show="showEditMainTypeModal"
                    :main-type="mainType"
                    @close="showEditMainTypeModal = false"
                    @updated="handleMainTypeInfoUpdated"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateTypeModal from './Components/CreateTypeModal.vue';
import EditTypeModal from './Components/EditTypeModal.vue';
import EditMainTypeModal from './Components/EditMainTypeModal.vue';

const props = defineProps({
    mainType: {
        type: Object,
        required: true
    },
    types: {
        type: Object,
        default: () => ({ data: [] })
    },
    flash: {
        type: Object,
        default: () => ({})
    }
});

// Reactive data
const searchQuery = ref('');
const statusFilter = ref('all');
const sortBy = ref('position');
const sortOrder = ref('asc');
const showCreateTypeModal = ref(false);
const showEditTypeModal = ref(false);
const showEditMainTypeModal = ref(false);
const editingType = ref(null);

// Computed properties
const filteredTypes = computed(() => {
    let filtered = props.types.data || [];
    
    // Apply search filter
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        filtered = filtered.filter(type => 
            type.name?.toLowerCase().includes(query) ||
            type.slug?.toLowerCase().includes(query)
        );
    }
    
    // Apply status filter
    if (statusFilter.value !== 'all') {
        const isActive = statusFilter.value === 'active';
        filtered = filtered.filter(type => type.status === isActive);
    }
    
    // Apply sorting
    filtered.sort((a, b) => {
        let aValue = a[sortBy.value];
        let bValue = b[sortBy.value];
        
        // Handle null values
        if (aValue === null) aValue = '';
        if (bValue === null) bValue = '';
        
        // Handle different data types
        if (typeof aValue === 'string') {
            aValue = aValue.toLowerCase();
            bValue = bValue.toLowerCase();
        }
        
        if (aValue < bValue) return sortOrder.value === 'asc' ? -1 : 1;
        if (aValue > bValue) return sortOrder.value === 'asc' ? 1 : -1;
        return 0;
    });
    
    return filtered;
});

const paginationRange = computed(() => {
    if (!props.types.current_page || !props.types.last_page) {
        return [];
    }
    
    const current = props.types.current_page;
    const last = props.types.last_page;
    const delta = 2;
    const range = [];
    const rangeWithDots = [];
    let l;
    
    for (let i = 1; i <= last; i++) {
        if (i === 1 || i === last || (i >= current - delta && i <= current + delta)) {
            range.push(i);
        }
    }
    
    for (let i of range) {
        if (l) {
            if (i - l === 2) {
                rangeWithDots.push(l + 1);
            } else if (i - l !== 1) {
                rangeWithDots.push('...');
            }
        }
        rangeWithDots.push(i);
        l = i;
    }
    
    return rangeWithDots;
});

// Methods
const editType = (type) => {
    editingType.value = type;
    showEditTypeModal.value = true;
};

const deleteType = (type) => {
    if (confirm(`Are you sure you want to delete "${type.name}"?`)) {
        router.delete(`/settings/types/type/${type.id}`, {
            preserveScroll: true,
            onSuccess: () => {
                router.reload({ only: ['types'] });
            },
            onError: (errors) => {
                alert('Failed to delete type.');
            }
        });
    }
};

const toggleTypeStatus = (type) => {
    const newStatus = !type.status;
    const action = newStatus ? 'activate' : 'deactivate';
    
    if (confirm(`Are you sure you want to ${action} "${type.name}"?`)) {
        router.patch(`/settings/types/type/${type.id}/toggle-status`, {
            status: newStatus,
            _method: 'PATCH'
        }, {
            preserveScroll: true,
            onSuccess: () => {
                router.reload({ only: ['types'] });
            }
        });
    }
};

const editMainTypeInfo = () => {
    showEditMainTypeModal.value = true;
};

const toggleMainTypeStatus = () => {
    const newStatus = !props.mainType.status;
    const action = newStatus ? 'activate' : 'deactivate';
    
    if (confirm(`Are you sure you want to ${action} "${props.mainType.name}"? This will affect all associated types.`)) {
        router.patch(route('settings.types.main.toggle-status', { id: props.mainType.id }), {
            status: newStatus,
            _method: 'PATCH'
        }, {
            preserveScroll: true,
            onSuccess: () => {
                router.reload({ only: ['mainType', 'types'] });
            }
        });
    }
};

const handleTypeCreated = () => {
    showCreateTypeModal.value = false;
    router.reload({ only: ['types'] });
};

const handleTypeUpdated = () => {
    showEditTypeModal.value = false;
    editingType.value = null;
    router.reload({ only: ['types'] });
};

const handleMainTypeInfoUpdated = () => {
    showEditMainTypeModal.value = false;
    router.reload({ only: ['mainType'] });
};

const resetFilters = () => {
    searchQuery.value = '';
    statusFilter.value = 'all';
    sortBy.value = 'position';
    sortOrder.value = 'asc';
};

const formatDate = (dateString) => {
    if (!dateString) return 'N/A';
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
};

const previousPage = () => {
    if (props.types.prev_page_url) {
        const url = new URL(props.types.prev_page_url);
        // Add filters to URL
        if (searchQuery.value) url.searchParams.set('search', searchQuery.value);
        if (statusFilter.value !== 'all') url.searchParams.set('status', statusFilter.value);
        if (sortBy.value !== 'position') url.searchParams.set('sort_by', sortBy.value);
        if (sortOrder.value !== 'asc') url.searchParams.set('sort_order', sortOrder.value);
        
        router.get(url.toString(), {}, {
            preserveScroll: true,
            preserveState: true
        });
    }
};

const nextPage = () => {
    if (props.types.next_page_url) {
        const url = new URL(props.types.next_page_url);
        // Add filters to URL
        if (searchQuery.value) url.searchParams.set('search', searchQuery.value);
        if (statusFilter.value !== 'all') url.searchParams.set('status', statusFilter.value);
        if (sortBy.value !== 'position') url.searchParams.set('sort_by', sortBy.value);
        if (sortOrder.value !== 'asc') url.searchParams.set('sort_order', sortOrder.value);
        
        router.get(url.toString(), {}, {
            preserveScroll: true,
            preserveState: true
        });
    }
};

const goToPage = (page) => {
    if (page !== '...' && page !== props.types.current_page) {
        const url = new URL(props.types.first_page_url);
        url.searchParams.set('page', page);
        // Add filters to URL
        if (searchQuery.value) url.searchParams.set('search', searchQuery.value);
        if (statusFilter.value !== 'all') url.searchParams.set('status', statusFilter.value);
        if (sortBy.value !== 'position') url.searchParams.set('sort_by', sortBy.value);
        if (sortOrder.value !== 'asc') url.searchParams.set('sort_order', sortOrder.value);
        
        router.get(url.toString(), {}, {
            preserveScroll: true,
            preserveState: true
        });
    }
};

// Watch filters and update URL
watch([searchQuery, statusFilter, sortBy, sortOrder], ([search, status, sortByVal, sortOrderVal]) => {
    const url = new URL(window.location.href);
    
    if (search) {
        url.searchParams.set('search', search);
    } else {
        url.searchParams.delete('search');
    }
    
    if (status !== 'all') {
        url.searchParams.set('status', status);
    } else {
        url.searchParams.delete('status');
    }
    
    if (sortByVal !== 'position') {
        url.searchParams.set('sort_by', sortByVal);
    } else {
        url.searchParams.delete('sort_by');
    }
    
    if (sortOrderVal !== 'asc') {
        url.searchParams.set('sort_order', sortOrderVal);
    } else {
        url.searchParams.delete('sort_order');
    }
    
    // Reset to page 1 when filters change
    url.searchParams.set('page', 1);
    
    router.get(url.toString(), {}, {
        preserveScroll: true,
        preserveState: true,
        replace: true
    });
}, { deep: true });
</script>

<style scoped>
/* Custom styles for dark mode */
.hover\:bg-gray-50 {
    transition: background-color 0.3s ease;
}

.dark .hover\:bg-gray-700\/50 {
    transition: background-color 0.3s ease;
}

/* Table row hover effects */
tr {
    transition: background-color 0.2s ease;
}

/* Pagination button hover effects */
button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Focus styles for accessibility */
:focus-visible {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}

.dark :focus-visible {
    outline-color: #60a5fa;
}

/* Card hover effects */
.bg-white {
    transition: transform 0.2s ease, box-shadow 0.3s ease;
}

.bg-white:hover {
    transform: translateY(-1px);
}

.dark .bg-gray-800:hover {
    transform: translateY(-1px);
}

/* Status badge animation */
.px-3.py-1 {
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Button animations */
button:active {
    transform: scale(0.98);
}

/* Smooth transitions */
.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
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

/* Responsive improvements */
@media (max-width: 640px) {
    .grid-cols-4 {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Loading states */
button:disabled {
    opacity: 0.6;
}

/* Modal backdrop for dark mode */
.dark .fixed {
    backdrop-filter: blur(4px);
}

/* Metadata display */
.text-xs.bg-gray-50 {
    max-height: 100px;
    overflow-y: auto;
}

.dark .text-xs.bg-gray-900\/50 {
    max-height: 100px;
    overflow-y: auto;
}

/* Custom scrollbar for metadata */
.text-xs.bg-gray-50::-webkit-scrollbar {
    width: 4px;
}

.text-xs.bg-gray-50::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 2px;
}

.text-xs.bg-gray-50::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 2px;
}

.dark .text-xs.bg-gray-900\/50::-webkit-scrollbar-track {
    background: #374151;
}

.dark .text-xs.bg-gray-900\/50::-webkit-scrollbar-thumb {
    background: #6b7280;
}
</style>
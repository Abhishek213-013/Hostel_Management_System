<template>
    <Head title="Users Management" />

    <div>
        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4 mb-6">
            <div>
                <h1 class="text-xl lg:text-2xl font-bold text-gray-900">Users Management</h1>
                <p class="text-gray-600 text-sm lg:text-base">Manage all system users by their roles</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <Link 
                    href="/users/create"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg flex items-center justify-center space-x-2 transition-all duration-200 text-sm lg:text-base shadow-md hover:shadow-lg active:scale-95"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="font-medium">Add New User</span>
                </Link>
                
                <!-- Quick Navigation -->
                <div class="relative">
                    <button 
                        @click="toggleQuickNav"
                        class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-lg flex items-center justify-center space-x-2 transition-all duration-200 text-sm lg:text-base"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                        <span>Quick Navigation</span>
                    </button>
                    
                    <!-- Quick Navigation Dropdown -->
                    <div 
                        v-show="quickNavOpen"
                        class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 z-10"
                    >
                        <div class="p-2 space-y-1">
                            <Link 
                                href="/users/super-admins"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-700"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                </svg>
                                <span>Super Admins</span>
                            </Link>
                            <Link 
                                href="/users/branch-managers"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-700"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span>Branch Managers</span>
                            </Link>
                            <Link 
                                href="/users/accountants"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-700"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Accountants</span>
                            </Link>
                            <Link 
                                href="/users/wardens"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-700"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <span>Wardens</span>
                            </Link>
                            <Link 
                                href="/users/residents"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-700"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                                <span>Residents</span>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
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

        <!-- Role-based Navigation Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 mb-8">
            <!-- Super Admins Card -->
            <Link 
                href="/users/super-admins"
                class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 text-white hover:shadow-lg transition-shadow"
            >
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <div class="text-3xl font-bold">{{ roleStats.superAdmins || 0 }}</div>
                        <div class="text-sm opacity-90">Super Admins</div>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-sm opacity-90">
                    <span>Full system access</span>
                    <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </Link>

            <!-- Branch Managers Card -->
            <Link 
                href="/users/branch-managers"
                class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 text-white hover:shadow-lg transition-shadow"
            >
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <div class="text-3xl font-bold">{{ roleStats.branchManagers || 0 }}</div>
                        <div class="text-sm opacity-90">Branch Managers</div>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-sm opacity-90">
                    <span>Branch operations management</span>
                    <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </Link>

            <!-- Accountants Card -->
            <Link 
                href="/users/accountants"
                class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-6 text-white hover:shadow-lg transition-shadow"
            >
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <div class="text-3xl font-bold">{{ roleStats.accountants || 0 }}</div>
                        <div class="text-sm opacity-90">Accountants</div>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-sm opacity-90">
                    <span>Financial management</span>
                    <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </Link>

            <!-- Wardens Card -->
            <Link 
                href="/users/wardens"
                class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg p-6 text-white hover:shadow-lg transition-shadow"
            >
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <div class="text-3xl font-bold">{{ roleStats.wardens || 0 }}</div>
                        <div class="text-sm opacity-90">Wardens</div>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-sm opacity-90">
                    <span>Hostel supervision</span>
                    <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </Link>

            <!-- Residents Card -->
            <Link 
                href="/users/residents"
                class="bg-gradient-to-r from-red-500 to-red-600 rounded-lg p-6 text-white hover:shadow-lg transition-shadow"
            >
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <div class="text-3xl font-bold">{{ roleStats.residents || 0 }}</div>
                        <div class="text-sm opacity-90">Residents</div>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-sm opacity-90">
                    <span>Hostel residents</span>
                    <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </Link>

            <!-- All Users Card -->
            <Link 
                href="/users/all"
                class="bg-gradient-to-r from-gray-600 to-gray-700 rounded-lg p-6 text-white hover:shadow-lg transition-shadow"
            >
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <div class="text-3xl font-bold">{{ roleStats.total || 0 }}</div>
                        <div class="text-sm opacity-90">All Users</div>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-sm opacity-90">
                    <span>View all system users</span>
                    <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </Link>
        </div>

        <!-- Recent Users Table -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden mb-8">
            <div class="px-4 lg:px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
                    <h3 class="text-base lg:text-lg font-semibold text-gray-800">Recently Added Users</h3>
                    <div class="text-sm text-gray-600">
                        Showing {{ Math.min(recentUsers.length, 5) }} of {{ recentUsers.length }} users
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="user in recentUsers.slice(0, 5)" :key="user.id" class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center" :class="getRoleColorClass(user.role.name)">
                                        <span class="text-white text-sm font-semibold">
                                            {{ getUserInitials(user.name) }}
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ user.name }}</div>
                                        <div class="text-sm text-gray-500">{{ user.phone || 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full" :class="getRoleBadgeClass(user.role.name)">
                                    {{ user.role.name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ user.email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ formatDate(user.created_at) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Active
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <Link 
                                        :href="`/users/${getRoleSlug(user.role.name)}/${user.id}`"
                                        class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50 transition-colors"
                                        title="View User"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </Link>
                                    <Link 
                                        :href="`/users/${getRoleSlug(user.role.name)}/${user.id}/edit`"
                                        class="text-yellow-600 hover:text-yellow-900 p-2 rounded-lg hover:bg-yellow-50 transition-colors"
                                        title="Edit User"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div v-if="recentUsers.length === 0" class="text-center py-8 lg:py-12">
                <svg class="w-12 h-12 lg:w-16 lg:h-16 text-gray-400 mx-auto mb-3 lg:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
                <h3 class="text-base lg:text-lg font-medium text-gray-900 mb-2">No users found</h3>
                <p class="text-gray-500 text-sm lg:text-base mb-4">Get started by creating your first user.</p>
                <Link 
                    href="/users/create"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors text-sm lg:text-base shadow-md hover:shadow-lg"
                >
                    Add New User
                </Link>
            </div>
        </div>

        <!-- System Statistics -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h3 class="text-base lg:text-lg font-semibold text-gray-800 mb-4">System Statistics</h3>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="text-center">
                    <div class="text-2xl lg:text-3xl font-bold text-blue-600">{{ roleStats.total || 0 }}</div>
                    <div class="text-sm text-gray-600">Total Users</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl lg:text-3xl font-bold text-green-600">{{ roleStats.activeToday || 0 }}</div>
                    <div class="text-sm text-gray-600">Active Today</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl lg:text-3xl font-bold text-purple-600">{{ roleStats.newThisWeek || 0 }}</div>
                    <div class="text-sm text-gray-600">New This Week</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl lg:text-3xl font-bold text-yellow-600">{{ roleStats.inactive || 0 }}</div>
                    <div class="text-sm text-gray-600">Inactive Users</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    users: {
        type: Array,
        default: () => []
    },
    roleStats: {
        type: Object,
        default: () => ({})
    },
    flash: {
        type: Object,
        default: () => ({})
    }
});

const quickNavOpen = ref(false);

const recentUsers = computed(() => {
    return [...props.users].sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
});

const toggleQuickNav = () => {
    quickNavOpen.value = !quickNavOpen.value;
};

// Close quick nav when clicking outside
const closeQuickNav = (event) => {
    if (!event.target.closest('.relative')) {
        quickNavOpen.value = false;
    }
};

// Helper functions
const getUserInitials = (name) => {
    if (!name) return 'U';
    return name.split(' ').map(word => word[0]).join('').toUpperCase().slice(0, 2);
};

const formatDate = (dateString) => {
    if (!dateString) return 'N/A';
    return new Date(dateString).toLocaleDateString();
};

const getRoleBadgeClass = (roleName) => {
    switch (roleName.toLowerCase()) {
        case 'admin':
        case 'super admin':
            return 'bg-blue-100 text-blue-800';
        case 'branch manager':
            return 'bg-green-100 text-green-800';
        case 'accountant':
            return 'bg-purple-100 text-purple-800';
        case 'warden':
            return 'bg-yellow-100 text-yellow-800';
        case 'resident':
            return 'bg-red-100 text-red-800';
        default:
            return 'bg-gray-100 text-gray-800';
    }
};

const getRoleColorClass = (roleName) => {
    switch (roleName.toLowerCase()) {
        case 'admin':
        case 'super admin':
            return 'bg-blue-600';
        case 'branch manager':
            return 'bg-green-600';
        case 'accountant':
            return 'bg-purple-600';
        case 'warden':
            return 'bg-yellow-600';
        case 'resident':
            return 'bg-red-600';
        default:
            return 'bg-gray-600';
    }
};

const getRoleSlug = (roleName) => {
    switch (roleName.toLowerCase()) {
        case 'admin':
        case 'super admin':
            return 'super-admins';
        case 'branch manager':
            return 'branch-managers';
        case 'accountant':
            return 'accountants';
        case 'warden':
            return 'wardens';
        case 'resident':
            return 'residents';
        default:
            return 'users';
    }
};

// Add event listener
import { onMounted, onUnmounted } from 'vue';

onMounted(() => {
    document.addEventListener('click', closeQuickNav);
});

onUnmounted(() => {
    document.removeEventListener('click', closeQuickNav);
});
</script>
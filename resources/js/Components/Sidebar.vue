<template>
    <aside class="w-64 bg-gray-900 text-white min-h-screen">
        <!-- Logo -->
        <div class="p-4 border-b border-gray-800">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                    <span class="font-bold">🏠</span>
                </div>
                <h1 class="text-xl font-bold">HMS</h1>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="p-4">
            <!-- Main Navigation -->
            <div class="mb-8">
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                    Main
                </h3>
                <ul class="space-y-2">
                    <li>
                        <Link 
                            href="/dashboard" 
                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                $page.url === '/dashboard' 
                                    ? 'bg-blue-600 text-white' 
                                    : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                            ]"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Dashboard</span>
                        </Link>
                    </li>
                </ul>
            </div>

            <!-- Analytics -->
            <div class="mb-8">
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                    Analytics
                </h3>
                <ul class="space-y-2">
                    <li>
                        <Link 
                            href="/students" 
                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                $page.url.startsWith('/students')
                                    ? 'bg-blue-600 text-white' 
                                    : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                            ]"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            <span>Students</span>
                        </Link>
                    </li>
                    <li>
                        <Link 
                            href="/complaints" 
                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                $page.url.startsWith('/complaints')
                                    ? 'bg-blue-600 text-white' 
                                    : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                            ]"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.954-.833-2.724 0L4.346 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            <span>Complaints</span>
                        </Link>
                    </li>
                    <li>
                        <Link 
                            href="/inventory" 
                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                $page.url.startsWith('/inventory')
                                    ? 'bg-blue-600 text-white' 
                                    : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                            ]"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <span>Stock</span>
                        </Link>
                    </li>
                    <li>
                        <Link 
                            href="/users" 
                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                $page.url.startsWith('/users')
                                    ? 'bg-blue-600 text-white' 
                                    : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                            ]"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>Users</span>
                        </Link>
                    </li>
                    <li>
                        <Link 
                            href="/meals" 
                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                $page.url.startsWith('/meals')
                                    ? 'bg-blue-600 text-white' 
                                    : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                            ]"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Meals</span>
                        </Link>
                    </li>
                </ul>
            </div>

            <!-- Dashboard -->
            <div class="mb-8">
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                    Dashboard
                </h3>
                <ul class="space-y-2">
                    <li>
                        <Link 
                            href="/rooms" 
                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                $page.url.startsWith('/rooms')
                                    ? 'bg-blue-600 text-white' 
                                    : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                            ]"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Rooms</span>
                            <span v-if="$page.url.startsWith('/rooms')" class="ml-auto w-2 h-2 bg-blue-500 rounded-full"></span>
                        </Link>
                    </li>
                    <li>
                        <Link 
                            href="/attendance" 
                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                $page.url.startsWith('/attendance')
                                    ? 'bg-blue-600 text-white' 
                                    : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                            ]"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <span>Attendance</span>
                            <span v-if="$page.url.startsWith('/attendance')" class="ml-auto w-2 h-2 bg-blue-500 rounded-full"></span>
                        </Link>
                    </li>
                    <li>
                        <Link 
                            href="/payments" 
                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                $page.url.startsWith('/payments')
                                    ? 'bg-blue-600 text-white' 
                                    : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                            ]"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Accounts</span>
                        </Link>
                    </li>
                    <li>
                        <Link 
                            href="/maintenance" 
                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                $page.url.startsWith('/maintenance')
                                    ? 'bg-blue-600 text-white' 
                                    : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                            ]"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Maintenance</span>
                            <span v-if="$page.url.startsWith('/maintenance')" class="ml-auto w-2 h-2 bg-blue-500 rounded-full"></span>
                        </Link>
                    </li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                    Quick Links
                </h3>
                <ul class="space-y-2">
                    <li>
                        <Link 
                            href="/admissions" 
                            class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-colors"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            <span>New Admission</span>
                        </Link>
                    </li>
                    <li>
                        <Link 
                            href="/reports" 
                            class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-colors"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span>Reports</span>
                        </Link>
                    </li>
                    <li>
                        <Link 
                            href="/settings" 
                            class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-colors"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Settings</span>
                        </Link>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Emergency Section -->
        <div class="p-4 border-t border-gray-800">
            <div class="bg-red-600 rounded-lg p-4 text-center">
                <h4 class="font-bold text-white mb-2">Emergency</h4>
                <p class="text-sm text-red-100 mb-3">Press only in emergency cases</p>
                <button 
                    @click="triggerEmergency"
                    class="w-full bg-white text-red-600 font-bold py-2 px-4 rounded-lg hover:bg-red-50 transition-colors"
                >
                    EMERGENCY
                </button>
            </div>
        </div>
    </aside>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const triggerEmergency = () => {
    if (confirm('Are you sure you want to trigger an emergency alert? This will notify all staff members immediately.')) {
        alert('Emergency alert has been triggered! All staff members have been notified.');
        // In a real application, you would make an API call here
        // axios.post('/api/emergency-alert');
    }
};
</script>
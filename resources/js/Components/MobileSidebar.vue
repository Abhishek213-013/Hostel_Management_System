<template>
    <!-- Mobile sidebar backdrop -->
    <Transition
        enter-active-class="transition-opacity ease-linear duration-300"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition-opacity ease-linear duration-300"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div 
            v-show="open"
            @click="closeSidebar"
            class="fixed inset-0 bg-gray-600 bg-opacity-75 lg:hidden"
        ></div>
    </Transition>

    <!-- Mobile sidebar -->
    <Transition
        enter-active-class="transition ease-in-out duration-300 transform"
        enter-from-class="-translate-x-full"
        enter-to-class="translate-x-0"
        leave-active-class="transition ease-in-out duration-300 transform"
        leave-from-class="translate-x-0"
        leave-to-class="-translate-x-full"
    >
        <aside 
            v-show="open"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 text-white overflow-y-auto lg:hidden"
        >
            <!-- Logo and Close Button -->
            <div class="flex items-center justify-between p-4 border-b border-gray-800">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                        <span class="font-bold">🏠</span>
                    </div>
                    <h1 class="text-xl font-bold">HMS</h1>
                </div>
                <button @click="closeSidebar" class="text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="p-4">
                <!-- Main Navigation -->
                <div class="mb-6">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                        Main
                    </h3>
                    <ul class="space-y-2">
                        <li>
                            <Link 
                                href="/dashboard" 
                                @click="closeSidebar"
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
                <div class="mb-6">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                        Analytics
                    </h3>
                    <ul class="space-y-2">
                        <li>
                            <Link 
                                href="/students" 
                                @click="closeSidebar"
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
                                @click="closeSidebar"
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
                                @click="closeSidebar"
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
                    </ul>
                </div>

                <!-- Dashboard -->
                <div class="mb-6">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                        Dashboard
                    </h3>
                    <ul class="space-y-2">
                        <li>
                            <Link 
                                href="/rooms" 
                                @click="closeSidebar"
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
                            </Link>
                        </li>
                        <li>
                            <Link 
                                href="/attendance" 
                                @click="closeSidebar"
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
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Emergency Section -->
                <div class="mt-8">
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
            </nav>
        </aside>
    </Transition>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    open: {
        type: Boolean,
        required: true
    }
});

const emit = defineEmits(['close']);

const closeSidebar = () => {
    emit('close');
};

const triggerEmergency = () => {
    if (confirm('Are you sure you want to trigger an emergency alert? This will notify all staff members immediately.')) {
        alert('Emergency alert has been triggered! All staff members have been notified.');
        closeSidebar();
    }
};
</script>
<template>
    <div class="min-h-screen bg-gray-100 dark:bg-[#212325] flex transition-colors duration-200">
        <!-- Mobile Sidebar Overlay -->
        <Transition
            enter-active-class="transition-opacity ease-linear duration-300"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition-opacity ease-linear duration-300"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div 
                v-show="mobileSidebarOpen"
                @click="mobileSidebarOpen = false"
                class="fixed inset-0 bg-gray-600 bg-opacity-75 lg:hidden z-40"
            ></div>
        </Transition>

        <!-- Sidebar -->
        <aside 
            :class="[
                'flex flex-col fixed h-screen overflow-y-auto transition-all duration-300 ease-in-out z-50 font-montserrat',
                isSidebarCollapsed ? 'w-16' : 'w-64',
                mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0',
                // Updated colors for light/dark mode
                isDarkMode 
                    ? 'bg-[#212325] text-white' 
                    : 'bg-[#0F173C] text-white'
            ]"
        >
            <!-- Mobile Header with Hamburger -->
            <div 
                :class="[
                    'lg:hidden flex items-center justify-between p-4 border-b',
                    isDarkMode ? 'border-gray-700' : 'border-gray-800'
                ]"
            >
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                        <span class="font-bold">🏠</span>
                    </div>
                    <h1 class="text-xl font-bold">HMS</h1>
                </div>
                <button @click="mobileSidebarOpen = false" class="text-gray-400 hover:text-white p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Desktop Logo (Expanded View) -->
            <div v-if="!isSidebarCollapsed" 
                 :class="[
                     'p-4 border-b',
                     isDarkMode ? 'border-gray-700' : 'border-gray-800'
                 ]"
                 class="hidden lg:block"
            >
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                            <span class="font-bold">🏠</span>
                        </div>
                        <h1 class="text-xl font-bold">HMS</h1>
                    </div>
                </div>
            </div>
            
            <!-- Collapsed Logo Icon -->
            <div v-else 
                 :class="[
                     'p-4 border-b',
                     isDarkMode ? 'border-gray-700' : 'border-gray-800'
                 ]"
                 class="hidden lg:block"
            >
                <div class="flex items-center justify-center">
                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                        <span class="font-bold">🏠</span>
                    </div>
                </div>
            </div>

            <!-- Navigation - Expanded View -->
            <nav v-if="!isSidebarCollapsed" class="flex-1 p-4 overflow-y-auto">
                <!-- Main Navigation -->
                <div class="mb-8">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                        Main
                    </h3>
                    <ul class="space-y-2">
                        <li>
                            <Link 
                                href="/dashboard" 
                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                    page.url === '/dashboard' 
                                        ? 'bg-blue-600 text-white' 
                                        : isDarkMode 
                                            ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                            : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                ]"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                <span class="font-montserrat sidebar-text">Dashboard</span>
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
                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                    page.url.startsWith('/students')
                                        ? 'bg-blue-600 text-white' 
                                        : isDarkMode 
                                            ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                            : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                ]"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                                <span class="font-montserrat sidebar-text">Students</span>
                            </Link>
                        </li>
                        <li>
                            <Link 
                                href="/complaints" 
                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                    page.url.startsWith('/complaints')
                                        ? 'bg-blue-600 text-white' 
                                        : isDarkMode 
                                            ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                            : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                ]"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.954-.833-2.724 0L4.346 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                <span class="font-montserrat sidebar-text">Complaints</span>
                            </Link>
                        </li>
                        <li>
                            <Link 
                                href="/inventory" 
                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                    page.url.startsWith('/inventory')
                                        ? 'bg-blue-600 text-white' 
                                        : isDarkMode 
                                            ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                            : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                ]"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <span class="font-montserrat sidebar-text">Stock</span>
                            </Link>
                        </li>
                        
                        <!-- Users Dropdown -->
                        <li class="relative">
                            <button 
                                @click="toggleUsersDropdown"
                                :class="['flex items-center justify-between w-full px-3 py-2 rounded-lg transition-colors text-sm', 
                                    isUsersSectionActive
                                        ? 'bg-blue-600 text-white' 
                                        : isDarkMode 
                                            ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                            : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                ]"
                            >
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span class="font-montserrat sidebar-text">Users</span>
                                </div>
                                <svg 
                                    :class="['w-4 h-4 transition-transform', usersDropdownOpen ? 'rotate-180' : '']" 
                                    fill="none" 
                                    stroke="currentColor" 
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <!-- Users Dropdown Menu -->
                            <Transition
                                enter-active-class="transition-all duration-200 ease-out"
                                enter-from-class="transform opacity-0 -translate-y-2"
                                enter-to-class="transform opacity-100 translate-y-0"
                                leave-active-class="transition-all duration-150 ease-in"
                                leave-from-class="transform opacity-100 translate-y-0"
                                leave-to-class="transform opacity-0 -translate-y-2"
                            >
                                <ul 
                                    v-show="usersDropdownOpen"
                                    :class="[
                                        'ml-8 mt-1 space-y-1 rounded-lg p-2',
                                        isDarkMode ? 'bg-gray-700' : 'bg-blue-900'
                                    ]"
                                >
                                    <li>
                                        <Link 
                                            href="/users/super-admins"
                                            @click="closeUsersDropdown"
                                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                                page.url.startsWith('/users/super-admins')
                                                    ? 'bg-blue-600 text-white' 
                                                    : isDarkMode 
                                                        ? 'text-gray-300 hover:bg-gray-600 hover:text-white' 
                                                        : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                            ]"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                            </svg>
                                            <span class="font-montserrat sidebar-text">Super Admins</span>
                                        </Link>
                                    </li>
                                    <li>
                                        <Link 
                                            href="/users/branch-managers"
                                            @click="closeUsersDropdown"
                                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                                page.url.startsWith('/users/branch-managers')
                                                    ? 'bg-blue-600 text-white' 
                                                    : isDarkMode 
                                                        ? 'text-gray-300 hover:bg-gray-600 hover:text-white' 
                                                        : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                            ]"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                            <span class="font-montserrat sidebar-text">Branch Managers</span>
                                        </Link>
                                    </li>
                                    <li>
                                        <Link 
                                            href="/users/accountants"
                                            @click="closeUsersDropdown"
                                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                                page.url.startsWith('/users/accountants')
                                                    ? 'bg-blue-600 text-white' 
                                                    : isDarkMode 
                                                        ? 'text-gray-300 hover:bg-gray-600 hover:text-white' 
                                                        : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                            ]"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="font-montserrat sidebar-text">Accountants</span>
                                        </Link>
                                    </li>
                                    <li>
                                        <Link 
                                            href="/users/wardens"
                                            @click="closeUsersDropdown"
                                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                                page.url.startsWith('/users/wardens')
                                                    ? 'bg-blue-600 text-white' 
                                                    : isDarkMode 
                                                        ? 'text-gray-300 hover:bg-gray-600 hover:text-white' 
                                                        : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                            ]"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                            <span class="font-montserrat sidebar-text">Wardens</span>
                                        </Link>
                                    </li>
                                    <li>
                                        <Link 
                                            href="/users/residents"
                                            @click="closeUsersDropdown"
                                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                                page.url.startsWith('/users/residents')
                                                    ? 'bg-blue-600 text-white' 
                                                    : isDarkMode 
                                                        ? 'text-gray-300 hover:bg-gray-600 hover:text-white' 
                                                        : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                            ]"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                            </svg>
                                            <span class="font-montserrat sidebar-text">Residents</span>
                                        </Link>
                                    </li>
                                    <li>
                                        <Link 
                                            href="/users/all"
                                            @click="closeUsersDropdown"
                                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                                page.url === '/users' || page.url === '/users/all'
                                                    ? 'bg-blue-600 text-white' 
                                                    : isDarkMode 
                                                        ? 'text-gray-300 hover:bg-gray-600 hover:text-white' 
                                                        : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                            ]"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                            </svg>
                                            <span class="font-montserrat sidebar-text">All Users</span>
                                        </Link>
                                    </li>
                                </ul>
                            </Transition>
                        </li>
                        
                        <li>
                            <Link 
                                href="/meals" 
                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                    page.url.startsWith('/meals')
                                        ? 'bg-blue-600 text-white' 
                                        : isDarkMode 
                                            ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                            : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                ]"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-montserrat sidebar-text">Meals</span>
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
                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                    page.url.startsWith('/rooms')
                                        ? 'bg-blue-600 text-white' 
                                        : isDarkMode 
                                            ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                            : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                ]"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                <span class="font-montserrat sidebar-text">Rooms</span>
                            </Link>
                        </li>
                        <li>
                            <Link 
                                href="/attendance" 
                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                    page.url.startsWith('/attendance')
                                        ? 'bg-blue-600 text-white' 
                                        : isDarkMode 
                                            ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                            : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                ]"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                <span class="font-montserrat sidebar-text">Attendance</span>
                            </Link>
                        </li>
                        <li>
                            <Link 
                                href="/payments" 
                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                    page.url.startsWith('/payments')
                                        ? 'bg-blue-600 text-white' 
                                        : isDarkMode 
                                            ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                            : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                ]"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-montserrat sidebar-text">Accounts</span>
                            </Link>
                        </li>
                        <li>
                            <Link 
                                href="/maintenance" 
                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                    page.url.startsWith('/maintenance')
                                        ? 'bg-blue-600 text-white' 
                                        : isDarkMode 
                                            ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                            : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                ]"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="font-montserrat sidebar-text">Maintenance</span>
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
                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                    isDarkMode 
                                        ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                        : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                ]"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                <span class="font-montserrat sidebar-text">New Admission</span>
                            </Link>
                        </li>
                        <li>
                            <Link 
                                href="/reports" 
                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                    isDarkMode 
                                        ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                        : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                ]"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <span class="font-montserrat sidebar-text">Reports</span>
                            </Link>
                        </li>
                        <li class="relative">
                            <button 
                                @click="toggleSettingsDropdown"
                                :class="['flex items-center justify-between w-full px-3 py-2 rounded-lg transition-colors text-sm', 
                                    isSettingsSectionActive
                                        ? 'bg-blue-600 text-white' 
                                        : isDarkMode 
                                            ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                            : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                ]"
                            >
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="font-montserrat sidebar-text">Settings</span>
                                </div>
                                <svg 
                                    :class="['w-4 h-4 transition-transform', settingsDropdownOpen ? 'rotate-180' : '']" 
                                    fill="none" 
                                    stroke="currentColor" 
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <!-- Settings Dropdown Menu -->
                            <Transition
                                enter-active-class="transition-all duration-200 ease-out"
                                enter-from-class="transform opacity-0 -translate-y-2"
                                enter-to-class="transform opacity-100 translate-y-0"
                                leave-active-class="transition-all duration-150 ease-in"
                                leave-from-class="transform opacity-100 translate-y-0"
                                leave-to-class="transform opacity-0 -translate-y-2"
                            >
                                <ul 
                                    v-show="settingsDropdownOpen"
                                    :class="[
                                        'ml-8 mt-1 space-y-1 rounded-lg p-2',
                                        isDarkMode ? 'bg-gray-700' : 'bg-blue-900'
                                    ]"
                                >
                                    <li>
                                        <Link 
                                            href="/settings/general"
                                            @click="closeSettingsDropdown"
                                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                                page.url === '/settings/general'
                                                    ? 'bg-blue-600 text-white' 
                                                    : isDarkMode 
                                                        ? 'text-gray-300 hover:bg-gray-600 hover:text-white' 
                                                        : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                            ]"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            </svg>
                                            <span class="font-montserrat sidebar-text">General Settings</span>
                                        </Link>
                                    </li>
                                    
                                    <!-- Type Configuration Dropdown -->
                                    <li class="relative">
                                        <button 
                                            @click="toggleTypeConfigDropdown"
                                            :class="['flex items-center justify-between w-full px-3 py-2 rounded-lg transition-colors text-sm', 
                                                page.url.startsWith('/settings/types')
                                                    ? 'bg-blue-600 text-white' 
                                                    : isDarkMode 
                                                        ? 'text-gray-300 hover:bg-gray-600 hover:text-white' 
                                                        : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                            ]"
                                        >
                                            <div class="flex items-center space-x-3">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                                </svg>
                                                <span class="font-montserrat sidebar-text">Type Configuration</span>
                                            </div>
                                            <svg 
                                                :class="['w-4 h-4 transition-transform', typeConfigDropdownOpen ? 'rotate-180' : '']" 
                                                fill="none" 
                                                stroke="currentColor" 
                                                viewBox="0 0 24 24"
                                            >
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        
                                        <!-- Type Configuration Nested Dropdown -->
                                        <Transition
                                            enter-active-class="transition-all duration-200 ease-out"
                                            enter-from-class="transform opacity-0 -translate-y-2"
                                            enter-to-class="transform opacity-100 translate-y-0"
                                            leave-active-class="transition-all duration-150 ease-in"
                                            leave-from-class="transform opacity-100 translate-y-0"
                                            leave-to-class="transform opacity-0 -translate-y-2"
                                        >
                                            <ul 
                                                v-show="typeConfigDropdownOpen"
                                                :class="[
                                                    'ml-8 mt-1 space-y-1 rounded-lg p-2',
                                                    isDarkMode ? 'bg-gray-600' : 'bg-blue-800'
                                                ]"
                                            >
                                                <!-- All Type Configuration -->
                                                <li>
                                                    <Link 
                                                        href="/settings/types"
                                                        @click="closeAllDropdowns"
                                                        :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                            page.url === '/settings/types'
                                                                ? 'bg-blue-600 text-white' 
                                                                : isDarkMode 
                                                                    ? 'text-gray-300 hover:bg-gray-500 hover:text-white' 
                                                                    : 'text-gray-300 hover:bg-blue-700 hover:text-white'
                                                        ]"
                                                    >
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                                        </svg>
                                                        <span class="font-montserrat sidebar-text text-sm">All Type Configuration</span>
                                                    </Link>
                                                </li>
                                                
                                                <!-- Dynamic Main Types List -->
                                                <template v-for="mainType in mainTypes" :key="mainType.id">
                                                    <li>
                                                        <Link 
                                                            :href="`/settings/types/main-type/${mainType.id}`"
                                                            @click="closeAllDropdowns"
                                                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                                page.url === `/settings/types/main-type/${mainType.id}`
                                                                    ? 'bg-blue-600 text-white' 
                                                                    : isDarkMode 
                                                                        ? 'text-gray-300 hover:bg-gray-500 hover:text-white' 
                                                                        : 'text-gray-300 hover:bg-blue-700 hover:text-white'
                                                            ]"
                                                        >
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                                            </svg>
                                                            <span class="font-montserrat sidebar-text text-sm truncate">{{ mainType.name }}</span>
                                                        </Link>
                                                    </li>
                                                </template>
                                                
                                                <!-- Empty State -->
                                                <li v-if="mainTypes.length === 0">
                                                    <div class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-400">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        <span class="font-montserrat sidebar-text text-sm">No types found</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </Transition>
                                    </li>
                                    
                                    <li>
                                        <Link 
                                            href="/settings/system"
                                            @click="closeSettingsDropdown"
                                            :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-sm', 
                                                page.url === '/settings/system'
                                                    ? 'bg-blue-600 text-white' 
                                                    : isDarkMode 
                                                        ? 'text-gray-300 hover:bg-gray-600 hover:text-white' 
                                                        : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                                            ]"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12.55a11 11 0 0114.08 0M1.42 9a16 16 0 0121.16 0M8.53 16.11a6 6 0 016.95 0M12 20h.01"></path>
                                            </svg>
                                            <span class="font-montserrat sidebar-text">System Settings</span>
                                        </Link>
                                    </li>
                                </ul>
                            </Transition>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Navigation - Collapsed View -->
            <nav v-else class="flex-1 flex flex-col items-center space-y-3 py-4">
                <!-- Dashboard -->
                <Link 
                    href="/dashboard" 
                    @click="handleMenuClick"
                    :class="['p-2 rounded-lg transition-colors group relative', 
                        page.url === '/dashboard' 
                            ? 'bg-blue-600 text-white' 
                            : isDarkMode 
                                ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                    ]"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <div :class="[
                        'absolute left-full ml-2 px-2 py-1 text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-10 font-montserrat',
                        isDarkMode ? 'bg-[#212325] text-white' : 'bg-[#0F173C] text-white'
                    ]" style="font-size: 13.4px">
                        Dashboard
                    </div>
                </Link>

                <!-- Students -->
                <div class="relative group">
                    <Link 
                        href="/students" 
                        @click="handleMenuClick"
                        :class="['p-2 rounded-lg transition-colors block', 
                            page.url.startsWith('/students')
                                ? 'bg-blue-600 text-white' 
                                : isDarkMode 
                                    ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                    : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </Link>
                    <div :class="[
                        'absolute left-full ml-2 px-2 py-1 text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-10 font-montserrat',
                        isDarkMode ? 'bg-[#212325] text-white' : 'bg-[#0F173C] text-white'
                    ]" style="font-size: 13.4px">
                        Students
                    </div>
                </div>

                <!-- Complaints -->
                <div class="relative group">
                    <Link 
                        href="/complaints" 
                        @click="handleMenuClick"
                        :class="['p-2 rounded-lg transition-colors block', 
                            page.url.startsWith('/complaints')
                                ? 'bg-blue-600 text-white' 
                                : isDarkMode 
                                    ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                    : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.954-.833-2.724 0L4.346 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </Link>
                    <div :class="[
                        'absolute left-full ml-2 px-2 py-1 text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-10 font-montserrat',
                        isDarkMode ? 'bg-[#212325] text-white' : 'bg-[#0F173C] text-white'
                    ]" style="font-size: 13.4px">
                        Complaints
                    </div>
                </div>

                <!-- Stock -->
                <div class="relative group">
                    <Link 
                        href="/inventory" 
                        @click="handleMenuClick"
                        :class="['p-2 rounded-lg transition-colors block', 
                            page.url.startsWith('/inventory')
                                ? 'bg-blue-600 text-white' 
                                : isDarkMode 
                                    ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                    : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </Link>
                    <div :class="[
                        'absolute left-full ml-2 px-2 py-1 text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-10 font-montserrat',
                        isDarkMode ? 'bg-[#212325] text-white' : 'bg-[#0F173C] text-white'
                    ]" style="font-size: 13.4px">
                        Stock
                    </div>
                </div>

                <!-- Users -->
                <div class="relative group">
                    <Link 
                        href="/users/all" 
                        @click="handleMenuClick"
                        :class="['p-2 rounded-lg transition-colors block', 
                            page.url.startsWith('/users')
                                ? 'bg-blue-600 text-white' 
                                : isDarkMode 
                                    ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                    : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </Link>
                    <div :class="[
                        'absolute left-full ml-2 px-2 py-1 text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-10 font-montserrat',
                        isDarkMode ? 'bg-[#212325] text-white' : 'bg-[#0F173C] text-white'
                    ]" style="font-size: 13.4px">
                        Users
                    </div>
                </div>

                <!-- Meals -->
                <div class="relative group">
                    <Link 
                        href="/meals" 
                        @click="handleMenuClick"
                        :class="['p-2 rounded-lg transition-colors block', 
                            page.url.startsWith('/meals')
                                ? 'bg-blue-600 text-white' 
                                : isDarkMode 
                                    ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                    : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </Link>
                    <div :class="[
                        'absolute left-full ml-2 px-2 py-1 text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-10 font-montserrat',
                        isDarkMode ? 'bg-[#212325] text-white' : 'bg-[#0F173C] text-white'
                    ]" style="font-size: 13.4px">
                        Meals
                    </div>
                </div>

                <!-- Rooms -->
                <div class="relative group">
                    <Link 
                        href="/rooms" 
                        @click="handleMenuClick"
                        :class="['p-2 rounded-lg transition-colors block', 
                            page.url.startsWith('/rooms')
                                ? 'bg-blue-600 text-white' 
                                : isDarkMode 
                                    ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                    : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </Link>
                    <div :class="[
                        'absolute left-full ml-2 px-2 py-1 text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-10 font-montserrat',
                        isDarkMode ? 'bg-[#212325] text-white' : 'bg-[#0F173C] text-white'
                    ]" style="font-size: 13.4px">
                        Rooms
                    </div>
                </div>

                <!-- Attendance -->
                <div class="relative group">
                    <Link 
                        href="/attendance" 
                        @click="handleMenuClick"
                        :class="['p-2 rounded-lg transition-colors block', 
                            page.url.startsWith('/attendance')
                                ? 'bg-blue-600 text-white' 
                                : isDarkMode 
                                    ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                    : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </Link>
                    <div :class="[
                        'absolute left-full ml-2 px-2 py-1 text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-10 font-montserrat',
                        isDarkMode ? 'bg-[#212325] text-white' : 'bg-[#0F173C] text-white'
                    ]" style="font-size: 13.4px">
                        Attendance
                    </div>
                </div>

                <!-- Accounts -->
                <div class="relative group">
                    <Link 
                        href="/payments" 
                        @click="handleMenuClick"
                        :class="['p-2 rounded-lg transition-colors block', 
                            page.url.startsWith('/payments')
                                ? 'bg-blue-600 text-white' 
                                : isDarkMode 
                                    ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                    : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </Link>
                    <div :class="[
                        'absolute left-full ml-2 px-2 py-1 text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-10 font-montserrat',
                        isDarkMode ? 'bg-[#212325] text-white' : 'bg-[#0F173C] text-white'
                    ]" style="font-size: 13.4px">
                        Accounts
                    </div>
                </div>

                <!-- Maintenance -->
                <div class="relative group">
                    <Link 
                        href="/maintenance" 
                        @click="handleMenuClick"
                        :class="['p-2 rounded-lg transition-colors block', 
                            page.url.startsWith('/maintenance')
                                ? 'bg-blue-600 text-white' 
                                : isDarkMode 
                                    ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                    : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </Link>
                    <div :class="[
                        'absolute left-full ml-2 px-2 py-1 text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-10 font-montserrat',
                        isDarkMode ? 'bg-[#212325] text-white' : 'bg-[#0F173C] text-white'
                    ]" style="font-size: 13.4px">
                        Maintenance
                    </div>
                </div>

                <!-- New Admission -->
                <div class="relative group">
                    <Link 
                        href="/admissions" 
                        @click="handleMenuClick"
                        :class="['p-2 rounded-lg transition-colors block', 
                            isDarkMode 
                                ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </Link>
                    <div :class="[
                        'absolute left-full ml-2 px-2 py-1 text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-10 font-montserrat',
                        isDarkMode ? 'bg-[#212325] text-white' : 'bg-[#0F173C] text-white'
                    ]" style="font-size: 13.4px">
                        New Admission
                    </div>
                </div>

                <!-- Reports -->
                <div class="relative group">
                    <Link 
                        href="/reports" 
                        @click="handleMenuClick"
                        :class="['p-2 rounded-lg transition-colors block', 
                            isDarkMode 
                                ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </Link>
                    <div :class="[
                        'absolute left-full ml-2 px-2 py-1 text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-10 font-montserrat',
                        isDarkMode ? 'bg-[#212325] text-white' : 'bg-[#0F173C] text-white'
                    ]" style="font-size: 13.4px">
                        Reports
                    </div>
                </div>

                <!-- Settings -->
                <div class="relative group">
                    <Link 
                        href="/settings/general" 
                        @click="handleMenuClick"
                        :class="['p-2 rounded-lg transition-colors block', 
                            page.url.startsWith('/settings')
                                ? 'bg-blue-600 text-white' 
                                : isDarkMode 
                                    ? 'text-gray-300 hover:bg-gray-700 hover:text-white' 
                                    : 'text-gray-300 hover:bg-blue-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </Link>
                    <div :class="[
                        'absolute left-full ml-2 px-2 py-1 text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-10 font-montserrat',
                        isDarkMode ? 'bg-[#212325] text-white' : 'bg-[#0F173C] text-white'
                    ]" style="font-size: 13.4px">
                        Settings
                    </div>
                </div>
            </nav>

            <!-- Bottom: Emergency Section and Expand/Collapse Toggle -->
            
        </aside>

        <!-- Main Content Area -->
        <div :class="['flex-1 flex flex-col min-w-0 transition-all duration-300', isSidebarCollapsed ? 'lg:ml-16' : 'lg:ml-64']">
            <!-- Top Navigation Bar -->
            <nav :class="[
                'shadow-sm border-b',
                isDarkMode 
                    ? 'bg-[#212325] border-gray-700' 
                    : 'bg-white border-gray-200'
            ]">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <!-- Left side: Mobile menu button and breadcrumb -->
                        <div class="flex items-center">
                            <!-- Desktop Sidebar Toggle (Hamburger) -->
                            <button 
                                @click="toggleSidebar"
                                :class="[
                                    'hidden lg:block mr-4 -ml-2 p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500',
                                    isDarkMode 
                                        ? 'text-gray-400 hover:text-gray-300' 
                                        : 'text-gray-500 hover:text-gray-600'
                                ]"
                                :title="isSidebarCollapsed ? 'Expand Sidebar' : 'Collapse Sidebar'"
                            >
                                <span class="sr-only">Toggle sidebar</span>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            
                            <!-- Mobile menu button -->
                            <button 
                                @click="mobileSidebarOpen = true"
                                :class="[
                                    'lg:hidden mr-4 -ml-2 p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500',
                                    isDarkMode 
                                        ? 'text-gray-400 hover:text-gray-300' 
                                        : 'text-gray-500 hover:text-gray-600'
                                ]"
                            >
                                <span class="sr-only">Open sidebar</span>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                </svg>
                            </button>

                            <!-- Breadcrumb -->
                            <div :class="[
                                'text-sm',
                                isDarkMode ? 'text-gray-400' : 'text-gray-600'
                            ]">
                                <span :class="[
                                    'font-medium',
                                    isDarkMode ? 'text-white' : 'text-gray-900'
                                ]">HMS</span>
                                <span class="mx-2">/</span>
                                <span class="capitalize">{{ getCurrentPage() }}</span>
                            </div>
                        </div>

                        <!-- Right side: Theme toggle, notifications, and user dropdown -->
                        <div class="flex items-center space-x-4">
                            <!-- Theme Toggle -->
                            <button 
                                @click="toggleTheme"
                                :class="[
                                    'p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors',
                                    isDarkMode ? 'text-gray-400 hover:text-gray-300' : 'text-gray-500 hover:text-gray-600'
                                ]"
                                :title="isDarkMode ? 'Switch to light mode' : 'Switch to dark mode'"
                            >
                                <span class="sr-only">Toggle theme</span>
                                <!-- Sun icon for light mode -->
                                <svg 
                                    v-if="!isDarkMode" 
                                    class="w-5 h-5" 
                                    fill="none" 
                                    stroke="currentColor" 
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <!-- Moon icon for dark mode -->
                                <svg 
                                    v-else 
                                    class="w-5 h-5" 
                                    fill="none" 
                                    stroke="currentColor" 
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                                </svg>
                            </button>

                            <!-- Notifications -->
                            <button :class="[
                                'p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors',
                                isDarkMode ? 'text-gray-400 hover:text-gray-300' : 'text-gray-500 hover:text-gray-600'
                            ]">
                                <span class="sr-only">View notifications</span>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                            </button>

                            <!-- User dropdown -->
                            <div class="relative">
                                <div class="flex items-center space-x-3">
                                    <div class="text-right hidden sm:block">
                                        <div :class="[
                                            'text-sm font-medium',
                                            isDarkMode ? 'text-white' : 'text-gray-900'
                                        ]">{{ page.props.auth.user.name }}</div>
                                        <div :class="[
                                            'text-xs',
                                            isDarkMode ? 'text-gray-400' : 'text-gray-500'
                                        ]" class="capitalize">{{ page.props.auth.user.role?.name || 'User' }}</div>
                                    </div>
                                    <button 
                                        @click="toggleDropdown"
                                        class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800"
                                    >
                                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ page.props.auth.user.name.charAt(0).toUpperCase() }}
                                        </div>
                                    </button>
                                </div>

                                <!-- Dropdown menu -->
                                <div 
                                    v-show="dropdownOpen"
                                    :class="[
                                        'origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 focus:outline-none z-50',
                                        isDarkMode 
                                            ? 'bg-[#212325] ring-gray-700' 
                                            : 'bg-white'
                                    ]"
                                >
                                    <Link 
                                        href="/profile"
                                        :class="[
                                            'block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700',
                                            isDarkMode ? 'text-gray-300' : 'text-gray-700'
                                        ]"
                                    >
                                        Your Profile
                                    </Link>
                                    <Link 
                                        href="/settings"
                                        :class="[
                                            'block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700',
                                            isDarkMode ? 'text-gray-300' : 'text-gray-700'
                                        ]"
                                    >
                                        Settings
                                    </Link>
                                    <div :class="[
                                        'border-t',
                                        isDarkMode ? 'border-gray-700' : 'border-gray-100'
                                    ]"></div>
                                    <Link 
                                        href="/logout"
                                        method="post"
                                        as="button"
                                        :class="[
                                            'block w-full text-left px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700',
                                            isDarkMode ? 'text-gray-300' : 'text-gray-700'
                                        ]"
                                    >
                                        Sign out
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Header (if slot exists) -->
            <header v-if="$slots.header" :class="[
                'shadow-sm',
                isDarkMode ? 'bg-[#212325]' : 'bg-white'
            ]">
                <div class="px-4 py-6 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 py-6" :class="[
                isDarkMode ? 'bg-[#212325]' : 'bg-gray-100'
            ]">
                <div class="px-4 sm:px-6 lg:px-8">
                    <slot />
                </div>
            </main>

            <!-- Footer -->
            <footer :class="[
                'border-t',
                isDarkMode 
                    ? 'bg-[#212325] border-gray-700' 
                    : 'bg-white border-gray-200'
            ]">
                <div class="px-4 py-6 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row justify-between items-center">
                        <div :class="[
                            'text-sm mb-2 sm:mb-0',
                            isDarkMode ? 'text-gray-400' : 'text-gray-600'
                        ]">
                            © {{ new Date().getFullYear() }} Hostel Management System. All rights reserved.
                        </div>
                        <div class="flex space-x-4">
                            <Link 
                                href="/privacy" 
                                :class="[
                                    'text-sm transition-colors',
                                    isDarkMode 
                                        ? 'text-gray-400 hover:text-blue-400' 
                                        : 'text-gray-600 hover:text-blue-600'
                                ]"
                            >Privacy Policy</Link>
                            <Link 
                                href="/terms" 
                                :class="[
                                    'text-sm transition-colors',
                                    isDarkMode 
                                        ? 'text-gray-400 hover:text-blue-400' 
                                        : 'text-gray-600 hover:text-blue-600'
                                ]"
                            >Terms of Service</Link>
                            <Link 
                                href="/contact" 
                                :class="[
                                    'text-sm transition-colors',
                                    isDarkMode 
                                        ? 'text-gray-400 hover:text-blue-400' 
                                        : 'text-gray-600 hover:text-blue-600'
                                ]"
                            >Contact</Link>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

// Get the page instance
const page = usePage();

// Reactive states
const dropdownOpen = ref(false);
const mobileSidebarOpen = ref(false);
const usersDropdownOpen = ref(false);
const mobileUsersDropdownOpen = ref(false);
const settingsDropdownOpen = ref(false);
const typeConfigDropdownOpen = ref(false);
const isDarkMode = ref(false);
const isSidebarCollapsed = ref(false);

// Add main types ref
const mainTypes = ref([]);

// Theme management
const toggleTheme = () => {
    isDarkMode.value = !isDarkMode.value;
    
    if (isDarkMode.value) {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    }
};

// Initialize theme based on user preference
const initTheme = () => {
    // Check local storage first
    const savedTheme = localStorage.getItem('theme');
    
    if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        isDarkMode.value = true;
        document.documentElement.classList.add('dark');
    } else {
        isDarkMode.value = false;
        document.documentElement.classList.remove('dark');
    }
};

// Listen for system theme changes
const handleThemeChange = (e) => {
    if (!localStorage.getItem('theme')) {
        if (e.matches) {
            isDarkMode.value = true;
            document.documentElement.classList.add('dark');
        } else {
            isDarkMode.value = false;
            document.documentElement.classList.remove('dark');
        }
    }
};

// Sidebar toggle function
const toggleSidebar = () => {
    isSidebarCollapsed.value = !isSidebarCollapsed.value;
    // Save sidebar state to localStorage
    localStorage.setItem('sidebarCollapsed', isSidebarCollapsed.value);
};

// Handle menu clicks in mobile
const handleMenuClick = () => {
    mobileSidebarOpen.value = false;
};

// Computed properties
const isSettingsSectionActive = computed(() => {
    return page.url.startsWith('/settings/');
});

const isUsersSectionActive = computed(() => {
    return page.url.startsWith('/users');
});

// Dropdown toggle functions
const toggleDropdown = () => {
    dropdownOpen.value = !dropdownOpen.value;
};

const toggleSettingsDropdown = () => {
    settingsDropdownOpen.value = !settingsDropdownOpen.value;
};

const toggleTypeConfigDropdown = () => {
    typeConfigDropdownOpen.value = !typeConfigDropdownOpen.value;
};

const closeSettingsDropdown = () => {
    settingsDropdownOpen.value = false;
};

const closeTypeConfigDropdown = () => {
    typeConfigDropdownOpen.value = false;
};

const closeAllDropdowns = () => {
    settingsDropdownOpen.value = false;
    typeConfigDropdownOpen.value = false;
    usersDropdownOpen.value = false;
};

const toggleUsersDropdown = () => {
    usersDropdownOpen.value = !usersDropdownOpen.value;
};

const toggleMobileUsersDropdown = () => {
    mobileUsersDropdownOpen.value = !mobileUsersDropdownOpen.value;
};

const closeUsersDropdown = () => {
    usersDropdownOpen.value = false;
};

const closeAllMobileDropdowns = () => {
    mobileUsersDropdownOpen.value = false;
    settingsDropdownOpen.value = false;
    typeConfigDropdownOpen.value = false;
    mobileSidebarOpen.value = false;
};

// Get current page for breadcrumb
const getCurrentPage = () => {
    const path = page.url;
    if (path === '/dashboard') return 'Dashboard';
    if (path.startsWith('/students')) return 'Students';
    if (path.startsWith('/rooms')) return 'Rooms';
    if (path.startsWith('/branches')) return 'Branches';
    if (path.startsWith('/attendance')) return 'Attendance';
    if (path.startsWith('/payments')) return 'Payments';
    if (path.startsWith('/inventory')) return 'Inventory';
    if (path.startsWith('/complaints')) return 'Complaints';
    if (path.startsWith('/users')) return 'Users Management';
    if (path.startsWith('/meals')) return 'Meals';
    if (path.startsWith('/profile')) return 'Profile';
    if (path.startsWith('/settings')) return 'Settings';
    return 'Dashboard';
};

// Emergency functions
const triggerEmergency = () => {
    if (confirm('Are you sure you want to trigger an emergency alert? This will notify all staff members immediately.')) {
        alert('Emergency alert has been triggered! All staff members have been notified.');
    }
};

const triggerEmergencyMobile = () => {
    triggerEmergency();
    mobileSidebarOpen.value = false;
};

// Close dropdowns on outside click
const closeDropdownOnClickOutside = (event) => {
    if (!event.target.closest('.relative')) {
        dropdownOpen.value = false;
    }
};

const closeUsersDropdownOnClickOutside = (event) => {
    if (!event.target.closest('li.relative')) {
        usersDropdownOpen.value = false;
    }
};

const closeSettingsDropdownOnClickOutside = (event) => {
    if (!event.target.closest('li.relative')) {
        settingsDropdownOpen.value = false;
        typeConfigDropdownOpen.value = false;
    }
};

// Fetch main types from API
const fetchMainTypes = async () => {
    try {
        const response = await fetch('/api/main-types/active');
        if (response.ok) {
            const data = await response.json();
            mainTypes.value = data;
        }
    } catch (error) {
        console.error('Failed to fetch main types:', error);
    }
};

// Alternative: Use Inertia props if main types are passed from backend
// Check if mainTypes are passed via props
const checkMainTypesFromProps = () => {
    if (page.props.mainTypes) {
        mainTypes.value = page.props.mainTypes;
    } else {
        // Fallback to API fetch
        fetchMainTypes();
    }
};

// Initialize sidebar state from localStorage
const initSidebarState = () => {
    const savedSidebarState = localStorage.getItem('sidebarCollapsed');
    if (savedSidebarState !== null) {
        isSidebarCollapsed.value = savedSidebarState === 'true';
    }
};

// Lifecycle hooks
onMounted(() => {
    initTheme();
    initSidebarState();
    
    // Watch for system theme changes
    const darkModeMediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
    darkModeMediaQuery.addEventListener('change', handleThemeChange);
    
    // Event listeners for closing dropdowns
    document.addEventListener('click', closeDropdownOnClickOutside);
    document.addEventListener('click', closeUsersDropdownOnClickOutside);
    document.addEventListener('click', closeSettingsDropdownOnClickOutside);
    
    // Fetch main types
    checkMainTypesFromProps();
});

onUnmounted(() => {
    const darkModeMediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
    darkModeMediaQuery.removeEventListener('change', handleThemeChange);
    
    document.removeEventListener('click', closeDropdownOnClickOutside);
    document.removeEventListener('click', closeUsersDropdownOnClickOutside);
    document.removeEventListener('click', closeSettingsDropdownOnClickOutside);
});
</script>

<style scoped>
/* Apply Montserrat font to all sidebar text */
.font-montserrat {
    font-family: 'Montserrat', sans-serif;
}

.sidebar-text {
    font-family: 'Montserrat', sans-serif;
    font-size: 13.4px;
}

/* Ensure proper font size for all sidebar text */
nav ul li a span,
nav ul li button span {
    font-family: 'Montserrat', sans-serif;
    font-size: 13.4px;
}

/* Tooltip styles for collapsed view */
.group:hover .group-hover\:opacity-100 {
    opacity: 1 !important;
}

/* Ensure sidebar has proper z-index */
.z-50 {
    z-index: 50;
}

.z-40 {
    z-index: 40;
}

.z-30 {
    z-index: 30;
}

/* Hide scrollbar but allow scrolling */
.h-screen {
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: rgba(156, 163, 175, 0.5) transparent;
}

.h-screen::-webkit-scrollbar {
    width: 6px;
}

.h-screen::-webkit-scrollbar-track {
    background: transparent;
}

.h-screen::-webkit-scrollbar-thumb {
    background-color: rgba(156, 163, 175, 0.5);
    border-radius: 3px;
}

/* Dark mode scrollbar */
.dark .h-screen::-webkit-scrollbar-thumb {
    background-color: rgba(75, 85, 99, 0.5);
}

.dark .h-screen::-webkit-scrollbar-thumb:hover {
    background-color: rgba(75, 85, 99, 0.7);
}

/* Sidebar specific colors */
.sidebar-bg-light {
    background-color: #0F173C !important;
}

.sidebar-bg-dark {
    background-color: #212325 !important;
}

.navbar-bg-dark {
    background-color: #212325 !important;
}

/* Main content background */
.main-bg-dark {
    background-color: #212325 !important;
}

/* Smooth transitions for all elements */
* {
    transition-property: background-color, border-color, color, fill, stroke;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 300ms;
}

/* Ensure proper tooltip positioning */
.relative .absolute {
    pointer-events: none;
}

.group:hover .absolute {
    pointer-events: auto;
}
</style>
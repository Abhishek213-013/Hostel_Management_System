<template>
    <div class="min-h-screen bg-gray-100 flex">
        <!-- Desktop Sidebar -->
        <aside class="hidden lg:flex lg:flex-shrink-0">
            <div class="w-64 bg-gray-900 text-white flex flex-col">
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
                <nav class="flex-1 p-4 overflow-y-auto">
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
                                        page.url === '/dashboard' 
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
                                        page.url.startsWith('/students')
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
                                        page.url.startsWith('/complaints')
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
                                        page.url.startsWith('/inventory')
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
                            
                            <!-- Users Dropdown -->
                            <li class="relative">
                                <button 
                                    @click="toggleUsersDropdown"
                                    :class="['flex items-center justify-between w-full px-3 py-2 rounded-lg transition-colors', 
                                        isUsersSectionActive
                                            ? 'bg-blue-600 text-white' 
                                            : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                                    ]"
                                >
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <span>Users</span>
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
                                        class="ml-8 mt-1 space-y-1 bg-gray-800 rounded-lg p-2"
                                    >
                                        <li>
                                            <Link 
                                                href="/users/super-admins"
                                                @click="closeUsersDropdown"
                                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                    page.url.startsWith('/users/super-admins')
                                                        ? 'bg-blue-600 text-white' 
                                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'
                                                ]"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                                </svg>
                                                <span>Super Admins</span>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link 
                                                href="/users/branch-managers"
                                                @click="closeUsersDropdown"
                                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                    page.url.startsWith('/users/branch-managers')
                                                        ? 'bg-blue-600 text-white' 
                                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'
                                                ]"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                                <span>Branch Managers</span>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link 
                                                href="/users/accountants"
                                                @click="closeUsersDropdown"
                                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                    page.url.startsWith('/users/accountants')
                                                        ? 'bg-blue-600 text-white' 
                                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'
                                                ]"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span>Accountants</span>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link 
                                                href="/users/wardens"
                                                @click="closeUsersDropdown"
                                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                    page.url.startsWith('/users/wardens')
                                                        ? 'bg-blue-600 text-white' 
                                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'
                                                ]"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                </svg>
                                                <span>Wardens</span>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link 
                                                href="/users/residents"
                                                @click="closeUsersDropdown"
                                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                    page.url.startsWith('/users/residents')
                                                        ? 'bg-blue-600 text-white' 
                                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'
                                                ]"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                                </svg>
                                                <span>Residents</span>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link 
                                                href="/users/all"
                                                @click="closeUsersDropdown"
                                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                    page.url === '/users' || page.url === '/users/all'
                                                        ? 'bg-blue-600 text-white' 
                                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'
                                                ]"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                                </svg>
                                                <span>All Users</span>
                                            </Link>
                                        </li>
                                    </ul>
                                </Transition>
                            </li>
                            
                            <li>
                                <Link 
                                    href="/meals" 
                                    :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                        page.url.startsWith('/meals')
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
                                        page.url.startsWith('/rooms')
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
                                    :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                        page.url.startsWith('/attendance')
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
                            <li>
                                <Link 
                                    href="/payments" 
                                    :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                        page.url.startsWith('/payments')
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
                                        page.url.startsWith('/maintenance')
                                            ? 'bg-blue-600 text-white' 
                                            : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                                    ]"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>Maintenance</span>
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
                            <li class="relative">
                                <button 
                                    @click="toggleSettingsDropdown"
                                    :class="['flex items-center justify-between w-full px-3 py-2 rounded-lg transition-colors', 
                                        isSettingsSectionActive
                                            ? 'bg-blue-600 text-white' 
                                            : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                                    ]"
                                >
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span>Settings</span>
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
                                        class="ml-8 mt-1 space-y-1 bg-gray-800 rounded-lg p-2"
                                    >
                                        <li>
                                            <Link 
                                                href="/settings/general"
                                                @click="closeSettingsDropdown"
                                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                    page.url === '/settings/general'
                                                        ? 'bg-blue-600 text-white' 
                                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'
                                                ]"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                </svg>
                                                <span>General Settings</span>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link 
                                                href="/settings/types"
                                                @click="closeSettingsDropdown"
                                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                    page.url.startsWith('/settings/types')
                                                        ? 'bg-blue-600 text-white' 
                                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'
                                                ]"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                                </svg>
                                                <span>Type Configuration</span>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link 
                                                href="/settings/system"
                                                @click="closeSettingsDropdown"
                                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                    page.url === '/settings/system'
                                                        ? 'bg-blue-600 text-white' 
                                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'
                                                ]"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12.55a11 11 0 0114.08 0M1.42 9a16 16 0 0121.16 0M8.53 16.11a6 6 0 016.95 0M12 20h.01"></path>
                                                </svg>
                                                <span>System Settings</span>
                                            </Link>
                                        </li>
                                    </ul>
                                </Transition>
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
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Top Navigation Bar -->
            <nav class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <!-- Left side: Mobile menu button and breadcrumb -->
                        <div class="flex items-center">
                            <!-- Mobile menu button -->
                            <button 
                                @click="mobileSidebarOpen = true"
                                class="lg:hidden mr-4 -ml-2 p-2 rounded-md text-gray-500 hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                                <span class="sr-only">Open sidebar</span>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                </svg>
                            </button>

                            <!-- Breadcrumb -->
                            <div class="text-sm text-gray-600">
                                <span class="font-medium text-gray-900">HMS</span>
                                <span class="mx-2">/</span>
                                <span class="capitalize">{{ getCurrentPage() }}</span>
                            </div>
                        </div>

                        <!-- Right side: User dropdown and notifications -->
                        <div class="flex items-center">
                            <!-- Notifications -->
                            <button class="p-2 rounded-full text-gray-500 hover:text-gray-600 hover:bg-gray-100">
                                <span class="sr-only">View notifications</span>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                            </button>

                            <!-- User dropdown -->
                            <div class="ml-3 relative">
                                <div class="flex items-center space-x-3">
                                    <div class="text-right hidden sm:block">
                                        <div class="text-sm font-medium text-gray-900">{{ page.props.auth.user.name }}</div>
                                        <div class="text-xs text-gray-500 capitalize">{{ page.props.auth.user.role?.name || 'User' }}</div>
                                    </div>
                                    <button 
                                        @click="toggleDropdown"
                                        class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                    >
                                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ page.props.auth.user.name.charAt(0).toUpperCase() }}
                                        </div>
                                    </button>
                                </div>

                                <!-- Dropdown menu -->
                                <div 
                                    v-show="dropdownOpen"
                                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                                >
                                    <Link 
                                        href="/profile"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    >
                                        Your Profile
                                    </Link>
                                    <Link 
                                        href="/settings"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    >
                                        Settings
                                    </Link>
                                    <div class="border-t border-gray-100"></div>
                                    <Link 
                                        href="/logout"
                                        method="post"
                                        as="button"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
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
            <header class="bg-white shadow-sm" v-if="$slots.header">
                <div class="px-4 py-6 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 py-6">
                <div class="px-4 sm:px-6 lg:px-8">
                    <slot />
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200">
                <div class="px-4 py-6 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row justify-between items-center">
                        <div class="text-sm text-gray-600 mb-2 sm:mb-0">
                            © {{ new Date().getFullYear() }} Hostel Management System. All rights reserved.
                        </div>
                        <div class="flex space-x-4">
                            <Link href="/privacy" class="text-sm text-gray-600 hover:text-blue-600">Privacy Policy</Link>
                            <Link href="/terms" class="text-sm text-gray-600 hover:text-blue-600">Terms of Service</Link>
                            <Link href="/contact" class="text-sm text-gray-600 hover:text-blue-600">Contact</Link>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

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

        <!-- Mobile Sidebar -->
        <Transition
            enter-active-class="transition ease-in-out duration-300 transform"
            enter-from-class="-translate-x-full"
            enter-to-class="translate-x-0"
            leave-active-class="transition ease-in-out duration-300 transform"
            leave-from-class="translate-x-0"
            leave-to-class="-translate-x-full"
        >
            <aside 
                v-show="mobileSidebarOpen"
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
                    <button @click="mobileSidebarOpen = false" class="text-gray-400 hover:text-white">
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
                                    @click="mobileSidebarOpen = false"
                                    :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                        page.url === '/dashboard' 
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
                                    @click="mobileSidebarOpen = false"
                                    :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                        page.url.startsWith('/students')
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
                                    @click="mobileSidebarOpen = false"
                                    :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                        page.url.startsWith('/complaints')
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
                                    @click="mobileSidebarOpen = false"
                                    :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                        page.url.startsWith('/inventory')
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
                            
                            <!-- Mobile Users Dropdown -->
                            <li class="relative">
                                <button 
                                    @click="toggleMobileUsersDropdown"
                                    :class="['flex items-center justify-between w-full px-3 py-2 rounded-lg transition-colors', 
                                        isUsersSectionActive
                                            ? 'bg-blue-600 text-white' 
                                            : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                                    ]"
                                >
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <span>Users</span>
                                    </div>
                                    <svg 
                                        :class="['w-4 h-4 transition-transform', mobileUsersDropdownOpen ? 'rotate-180' : '']" 
                                        fill="none" 
                                        stroke="currentColor" 
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                
                                <!-- Mobile Users Dropdown Menu -->
                                <Transition
                                    enter-active-class="transition-all duration-200 ease-out"
                                    enter-from-class="transform opacity-0 -translate-y-2"
                                    enter-to-class="transform opacity-100 translate-y-0"
                                    leave-active-class="transition-all duration-150 ease-in"
                                    leave-from-class="transform opacity-100 translate-y-0"
                                    leave-to-class="transform opacity-0 -translate-y-2"
                                >
                                    <ul 
                                        v-show="mobileUsersDropdownOpen"
                                        class="ml-8 mt-1 space-y-1 bg-gray-800 rounded-lg p-2"
                                    >
                                        <li>
                                            <Link 
                                                href="/users/super-admins"
                                                @click="closeAllMobileDropdowns"
                                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                    page.url.startsWith('/users/super-admins')
                                                        ? 'bg-blue-600 text-white' 
                                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'
                                                ]"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                                </svg>
                                                <span>Super Admins</span>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link 
                                                href="/users/branch-managers"
                                                @click="closeAllMobileDropdowns"
                                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                    page.url.startsWith('/users/branch-managers')
                                                        ? 'bg-blue-600 text-white' 
                                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'
                                                ]"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                                <span>Branch Managers</span>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link 
                                                href="/users/accountants"
                                                @click="closeAllMobileDropdowns"
                                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                    page.url.startsWith('/users/accountants')
                                                        ? 'bg-blue-600 text-white' 
                                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'
                                                ]"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span>Accountants</span>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link 
                                                href="/users/wardens"
                                                @click="closeAllMobileDropdowns"
                                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                    page.url.startsWith('/users/wardens')
                                                        ? 'bg-blue-600 text-white' 
                                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'
                                                ]"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                </svg>
                                                <span>Wardens</span>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link 
                                                href="/users/residents"
                                                @click="closeAllMobileDropdowns"
                                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                    page.url.startsWith('/users/residents')
                                                        ? 'bg-blue-600 text-white' 
                                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'
                                                ]"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                                </svg>
                                                <span>Residents</span>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link 
                                                href="/users/all"
                                                @click="closeAllMobileDropdowns"
                                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                    page.url === '/users' || page.url === '/users/all'
                                                        ? 'bg-blue-600 text-white' 
                                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'
                                                ]"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                                </svg>
                                                <span>All Users</span>
                                            </Link>
                                        </li>
                                    </ul>
                                </Transition>
                            </li>
                            
                            <li>
                                <Link 
                                    href="/meals" 
                                    @click="mobileSidebarOpen = false"
                                    :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                        page.url.startsWith('/meals')
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
                    <div class="mb-6">
                        <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                            Dashboard
                        </h3>
                        <ul class="space-y-2">
                            <li>
                                <Link 
                                    href="/rooms" 
                                    @click="mobileSidebarOpen = false"
                                    :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                        page.url.startsWith('/rooms')
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
                                    @click="mobileSidebarOpen = false"
                                    :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                        page.url.startsWith('/attendance')
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
                            <li>
                                <Link 
                                    href="/payments" 
                                    @click="mobileSidebarOpen = false"
                                    :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                        page.url.startsWith('/payments')
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
                                    @click="mobileSidebarOpen = false"
                                    :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                        page.url.startsWith('/maintenance')
                                            ? 'bg-blue-600 text-white' 
                                            : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                                    ]"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>Maintenance</span>
                                </Link>
                            </li>
                        </ul>
                    </div>

                    <!-- Quick Links -->
                    <div class="mb-6">
                        <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                            Quick Links
                        </h3>
                        <ul class="space-y-2">
                            <li>
                                <Link 
                                    href="/admissions" 
                                    @click="mobileSidebarOpen = false"
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
                                    @click="mobileSidebarOpen = false"
                                    class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-colors"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    <span>Reports</span>
                                </Link>
                            </li>
                            <li class="relative">
                                <button 
                                    @click="toggleSettingsDropdown"
                                    :class="['flex items-center justify-between w-full px-3 py-2 rounded-lg transition-colors', 
                                        isSettingsSectionActive
                                            ? 'bg-blue-600 text-white' 
                                            : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                                    ]"
                                >
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span>Settings</span>
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
                                        class="ml-8 mt-1 space-y-1 bg-gray-800 rounded-lg p-2"
                                    >
                                        <li>
                                            <Link 
                                                href="/settings/general"
                                                @click="closeSettingsDropdown; mobileSidebarOpen = false"
                                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                    page.url === '/settings/general'
                                                        ? 'bg-blue-600 text-white' 
                                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'
                                                ]"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                </svg>
                                                <span>General Settings</span>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link 
                                                href="/settings/types"
                                                @click="closeSettingsDropdown; mobileSidebarOpen = false"
                                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                    page.url.startsWith('/settings/types')
                                                        ? 'bg-blue-600 text-white' 
                                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'
                                                ]"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                                </svg>
                                                <span>Type Configuration</span>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link 
                                                href="/settings/system"
                                                @click="closeSettingsDropdown; mobileSidebarOpen = false"
                                                :class="['flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors', 
                                                    page.url === '/settings/system'
                                                        ? 'bg-blue-600 text-white' 
                                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'
                                                ]"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12.55a11 11 0 0114.08 0M1.42 9a16 16 0 0121.16 0M8.53 16.11a6 6 0 016.95 0M12 20h.01"></path>
                                                </svg>
                                                <span>System Settings</span>
                                            </Link>
                                        </li>
                                    </ul>
                                </Transition>
                            </li>
                        </ul>
                    </div>

                    <!-- Emergency Section -->
                    <div class="mt-8">
                        <div class="bg-red-600 rounded-lg p-4 text-center">
                            <h4 class="font-bold text-white mb-2">Emergency</h4>
                            <p class="text-sm text-red-100 mb-3">Press only in emergency cases</p>
                            <button 
                                @click="triggerEmergencyMobile"
                                class="w-full bg-white text-red-600 font-bold py-2 px-4 rounded-lg hover:bg-red-50 transition-colors"
                            >
                                EMERGENCY
                            </button>
                        </div>
                    </div>
                </nav>
            </aside>
        </Transition>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

// Get the page instance
const page = usePage();

const dropdownOpen = ref(false);
const mobileSidebarOpen = ref(false);
const usersDropdownOpen = ref(false);
const mobileUsersDropdownOpen = ref(false);
const settingsDropdownOpen = ref(false);

const toggleDropdown = () => {
    dropdownOpen.value = !dropdownOpen.value;
};

const isSettingsSectionActive = computed(() => {
    return page.url.startsWith('/settings/');
});

const toggleSettingsDropdown = () => {
    settingsDropdownOpen.value = !settingsDropdownOpen.value;
};

const closeSettingsDropdown = () => {
    settingsDropdownOpen.value = false;
};

const closeSettingsDropdownOnClickOutside = (event) => {
    if (!event.target.closest('li.relative')) {
        settingsDropdownOpen.value = false;
    }
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
    mobileSidebarOpen.value = false;
};

const isUsersSectionActive = computed(() => {
    return page.url.startsWith('/users');
});

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

const triggerEmergency = () => {
    if (confirm('Are you sure you want to trigger an emergency alert? This will notify all staff members immediately.')) {
        alert('Emergency alert has been triggered! All staff members have been notified.');
    }
};

const triggerEmergencyMobile = () => {
    triggerEmergency();
    mobileSidebarOpen.value = false;
};

const closeDropdown = (event) => {
    if (!event.target.closest('.relative')) {
        dropdownOpen.value = false;
    }
};

const closeUsersDropdownOnClickOutside = (event) => {
    if (!event.target.closest('li.relative')) {
        usersDropdownOpen.value = false;
    }
};

onMounted(() => {
    document.addEventListener('click', closeDropdown);
    document.addEventListener('click', closeUsersDropdownOnClickOutside);
    document.addEventListener('click', closeSettingsDropdownOnClickOutside);
});

onUnmounted(() => {
    document.removeEventListener('click', closeDropdown);
    document.removeEventListener('click', closeUsersDropdownOnClickOutside);
    document.removeEventListener('click', closeSettingsDropdownOnClickOutside);
});
</script>
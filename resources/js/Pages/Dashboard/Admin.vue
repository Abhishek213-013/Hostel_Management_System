<template>
    <Head title="Admin Dashboard - HMS" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <!-- <div>
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        HMS Dashboard
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Track your hostel activity, students and occupancy here.</p>
                </div> -->
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    {{ currentDate }}
                </div>
            </div>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Welcome Section -->
                <div class="mb-8">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-900 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                        <div class="flex flex-col md:flex-row md:items-center justify-between">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Welcome back, {{ $page.props.auth.user?.name || 'Admin' }}!</h1>
                                <p class="text-gray-600 dark:text-gray-300 mt-1">Here's what's happening in your Hostel Management System today.</p>
                                
                                <!-- Target Progress -->
                                <div class="mt-6 max-w-md">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Your target is incomplete</span>
                                        <span class="text-sm font-bold text-blue-600 dark:text-blue-400">{{ dashboardStats.targetCompletion }}%</span>
                                    </div>
                                    <div class="w-full h-3 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full" 
                                             :style="{ width: dashboardStats.targetCompletion + '%' }"></div>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                        You have completed {{ dashboardStats.targetCompletion }}% of the given target.
                                        <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline ml-1">Check your status →</a>
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Quick Stats -->
                            <div class="mt-6 md:mt-0 grid grid-cols-2 gap-4">
                                <div class="text-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ dashboardStats.studentsThisMonth }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">New Students</div>
                                    <div class="text-xs text-green-600 dark:text-green-400 mt-1">+{{ dashboardStats.monthlyStudentGrowth }}% this month</div>
                                </div>
                                <div class="text-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white">₹{{ formatCurrency(dashboardStats.revenueThisMonth) }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Revenue</div>
                                    <div class="text-xs text-green-600 dark:text-green-400 mt-1">+{{ dashboardStats.monthlyRevenueGrowth }}% this month</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Analytics Section - Updated to match screenshot layout -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Students -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Students</h3>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ formatNumber(dashboardStats.totalStudents) }}</p>
                                <div class="flex items-center mt-3">
                                    <span class="text-green-600 dark:text-green-400 flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        +{{ dashboardStats.monthlyStudentGrowth }}%
                                    </span>
                                    <span class="text-gray-500 dark:text-gray-400 text-sm ml-3">this month</span>
                                </div>
                            </div>
                            <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-xl">
                                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Revenue -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Revenue</h3>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">₹{{ formatCurrency(dashboardStats.totalRevenue) }}</p>
                                <div class="flex items-center mt-3">
                                    <span class="text-green-600 dark:text-green-400 flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        +{{ dashboardStats.monthlyRevenueGrowth }}%
                                    </span>
                                    <span class="text-gray-500 dark:text-gray-400 text-sm ml-3">this month</span>
                                </div>
                            </div>
                            <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-xl">
                                <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Conversion Ratio -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Occupancy Rate</h3>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ dashboardStats.occupancyRate }}%</p>
                                <div class="flex items-center mt-3">
                                    <span class="text-red-600 dark:text-red-400 flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        -{{ dashboardStats.occupancyChange }}%
                                    </span>
                                    <span class="text-gray-500 dark:text-gray-400 text-sm ml-3">this month</span>
                                </div>
                            </div>
                            <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-xl">
                                <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Deals -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Active Complaints</h3>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ dashboardStats.activeComplaints }}</p>
                                <div class="flex items-center mt-3">
                                    <span class="text-green-600 dark:text-green-400 flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        +{{ dashboardStats.complaintGrowth }}%
                                    </span>
                                    <span class="text-gray-500 dark:text-gray-400 text-sm ml-3">this month</span>
                                </div>
                            </div>
                            <div class="p-3 bg-yellow-100 dark:bg-yellow-900/30 rounded-xl">
                                <svg class="w-8 h-8 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.954-.833-2.724 0L4.346 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Content - Two Column Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left Column -->
                    <div class="lg:col-span-2">
                        <!-- Top Students/Residents -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Top Residents</h3>
                                <a href="#" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">View All →</a>
                            </div>
                            <div class="space-y-4">
                                <!-- Student 1 -->
                                <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-blue-600 dark:text-blue-400 font-semibold">MJ</span>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-800 dark:text-gray-200">Michael Jordan</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">michael.jordan@example.com</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm font-medium text-gray-700 dark:text-gray-300">Room 101</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Hostel 1</div>
                                    </div>
                                </div>

                                <!-- Student 2 -->
                                <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-green-600 dark:text-green-400 font-semibold">EK</span>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-800 dark:text-gray-200">Emigo Klaren</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">emigo.klaren@gmail.com</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm font-medium text-gray-700 dark:text-gray-300">Room 205</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Hostel 2</div>
                                    </div>
                                </div>

                                <!-- Student 3 -->
                                <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-purple-600 dark:text-purple-400 font-semibold">RO</span>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-800 dark:text-gray-200">Randy Ortooan</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">randy.ortooan@example.com</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm font-medium text-gray-700 dark:text-gray-300">Room 312</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Hostel 3</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Revenue Analytics -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Revenue Analytics</h3>
                                <div class="flex items-center">
                                    <span class="text-green-600 dark:text-green-400 text-sm mr-2">+25% this month</span>
                                    <a href="#" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">View All →</a>
                                </div>
                            </div>
                            
                            <!-- Monthly Revenue Chart -->
                            <div class="mb-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <p class="text-2xl font-bold text-gray-900 dark:text-white">₹{{ formatCurrency(dashboardStats.monthlyRevenue) }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Monthly Revenue</p>
                                    </div>
                                    <div class="flex space-x-4">
                                        <div class="text-right">
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Expected</p>
                                            <p class="text-lg font-bold text-blue-600 dark:text-blue-400">₹{{ formatCurrency(dashboardStats.expectedFees) }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Collected</p>
                                            <p class="text-lg font-bold text-green-600 dark:text-green-400">₹{{ formatCurrency(dashboardStats.collectedFees) }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Simple Bar Chart -->
                                <div class="h-48 mt-6">
                                    <div class="flex items-end justify-between h-full space-x-2">
                                        <div v-for="(month, index) in revenueData" :key="index" class="flex flex-col items-center flex-1">
                                            <div class="text-xs text-gray-500 dark:text-gray-400 mb-2">{{ month.month }}</div>
                                            <div class="w-full bg-blue-100 dark:bg-blue-900/30 rounded-t-lg relative group">
                                                <div class="bg-blue-500 dark:bg-blue-600 rounded-t-lg absolute bottom-0 w-full transition-all duration-300"
                                                     :style="{ height: month.percentage + '%' }"></div>
                                                <div class="opacity-0 group-hover:opacity-100 absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-900 dark:bg-gray-700 text-white text-xs px-2 py-1 rounded whitespace-nowrap transition-opacity">
                                                    ₹{{ formatCurrency(month.amount) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Revenue Summary -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                    <div class="text-sm text-blue-800 dark:text-blue-300">Total Expected</div>
                                    <div class="text-xl font-bold text-blue-600 dark:text-blue-400 mt-1">₹{{ formatCurrency(dashboardStats.expectedFees) }}</div>
                                </div>
                                <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                                    <div class="text-sm text-green-800 dark:text-green-300">Total Collected</div>
                                    <div class="text-xl font-bold text-green-600 dark:text-green-400 mt-1">₹{{ formatCurrency(dashboardStats.collectedFees) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Fees Collection Summary -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Fees Collection</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-300">Expected</span>
                                    <span class="font-bold text-gray-900 dark:text-white">₹{{ formatCurrency(dashboardStats.expectedFees) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-300">Collected</span>
                                    <span class="font-bold text-green-600 dark:text-green-400">₹{{ formatCurrency(dashboardStats.collectedFees) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-300">Remaining</span>
                                    <span class="font-bold text-blue-600 dark:text-blue-400">₹{{ formatCurrency(dashboardStats.remainingFees) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-300">Overdue</span>
                                    <span class="font-bold text-red-600 dark:text-red-400">₹{{ formatCurrency(dashboardStats.overdueFees) }}</span>
                                </div>
                            </div>
                            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <div class="text-center">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Collection Rate</div>
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ dashboardStats.collectionRate }}%</div>
                                    <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full mt-2">
                                        <div class="h-full bg-green-500 dark:bg-green-600 rounded-full" 
                                             :style="{ width: dashboardStats.collectionRate + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Occupancy Rate -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Occupancy Rate</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                                        <span class="text-sm text-gray-600 dark:text-gray-300">Hostel 1</span>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold text-gray-900 dark:text-white">{{ dashboardStats.hostel1Occupancy }}%</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">50/100 beds</div>
                                    </div>
                                </div>
                                <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full">
                                    <div class="h-full bg-blue-500 rounded-full" :style="{ width: dashboardStats.hostel1Occupancy + '%' }"></div>
                                </div>

                                <div class="flex items-center justify-between mt-4">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                        <span class="text-sm text-gray-600 dark:text-gray-300">Hostel 2</span>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold text-gray-900 dark:text-white">{{ dashboardStats.hostel2Occupancy }}%</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">60/80 beds</div>
                                    </div>
                                </div>
                                <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full">
                                    <div class="h-full bg-green-500 rounded-full" :style="{ width: dashboardStats.hostel2Occupancy + '%' }"></div>
                                </div>

                                <div class="flex items-center justify-between mt-4">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-purple-500 rounded-full mr-2"></div>
                                        <span class="text-sm text-gray-600 dark:text-gray-300">Hostel 3</span>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold text-gray-900 dark:text-white">{{ dashboardStats.hostel3Occupancy }}%</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">114/120 beds</div>
                                    </div>
                                </div>
                                <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full">
                                    <div class="h-full bg-purple-500 rounded-full" :style="{ width: dashboardStats.hostel3Occupancy + '%' }"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Quick Actions</h3>
                            <div class="grid grid-cols-2 gap-3">
                                <button class="p-3 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30 rounded-lg transition-colors text-center">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Add Student</span>
                                </button>
                                <button class="p-3 bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/30 rounded-lg transition-colors text-center">
                                    <svg class="w-6 h-6 text-green-600 dark:text-green-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Collect Fees</span>
                                </button>
                                <button class="p-3 bg-purple-50 dark:bg-purple-900/20 hover:bg-purple-100 dark:hover:bg-purple-900/30 rounded-lg transition-colors text-center">
                                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Stock Update</span>
                                </button>
                                <button class="p-3 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-lg transition-colors text-center">
                                    <svg class="w-6 h-6 text-red-600 dark:text-red-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.954-.833-2.724 0L4.346 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Complaints</span>
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
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, computed } from 'vue';

// Current date
const currentDate = computed(() => {
    return new Date().toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
});

// Format currency function
const formatCurrency = (amount) => {
    return new Intl.NumberFormat('en-IN').format(amount);
};

// Format number with commas
const formatNumber = (num) => {
    return new Intl.NumberFormat('en-IN').format(num);
};

// Sample revenue data for chart
const revenueData = ref([
    { month: 'Jan', amount: 4500000, percentage: 75 },
    { month: 'Feb', amount: 5200000, percentage: 85 },
    { month: 'Mar', amount: 4800000, percentage: 80 },
    { month: 'Apr', amount: 5600000, percentage: 90 },
    { month: 'May', amount: 4900000, percentage: 82 },
    { month: 'Jun', amount: 6100000, percentage: 95 }
]);

// Props for dynamic data
const props = defineProps({
    dashboardStats: {
        type: Object,
        default: () => ({
            // Target and Welcome
            targetCompletion: 48,
            
            // Quick Stats
            studentsThisMonth: 124,
            monthlyStudentGrowth: 40,
            revenueThisMonth: 5656200,
            monthlyRevenueGrowth: 25,
            
            // Analytics Cards
            totalStudents: 102890,
            totalRevenue: 56562000,
            occupancyRate: 85,
            occupancyChange: 12,
            activeComplaints: 2543,
            complaintGrowth: 19,
            
            // Revenue Analytics
            monthlyRevenue: 6100000,
            expectedFees: 12500000,
            collectedFees: 8650000,
            remainingFees: 3850000,
            overdueFees: 1250000,
            collectionRate: 69,
            
            // Occupancy
            hostel1Occupancy: 50,
            hostel2Occupancy: 75,
            hostel3Occupancy: 95
        })
    }
});
</script>

<style scoped>
/* Custom styles for the dashboard */
.bg-gradient-to-r {
    background-size: 200% 200%;
    animation: gradient 15s ease infinite;
}

@keyframes gradient {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

/* Smooth transitions */
.bg-white, .bg-blue-50, .bg-green-50, .bg-purple-50, .bg-red-50 {
    transition: all 0.3s ease;
}

.bg-white:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.dark .bg-gray-800:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
}

/* Progress bar animation */
@keyframes progress {
    from { width: 0; }
}

.w-full.h-2 > div {
    animation: progress 1s ease-out;
}

/* Responsive adjustments */
@media (max-width: 640px) {
    .grid-cols-4 {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .grid-cols-2 {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .grid-cols-4 {
        grid-template-columns: 1fr;
    }
}

/* Chart bar hover effect */
.bg-blue-100 .bg-blue-500 {
    transition: height 0.3s ease;
}

.group:hover .bg-blue-500 {
    opacity: 0.9;
}
</style>
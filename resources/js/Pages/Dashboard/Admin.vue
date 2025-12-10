<template>
    <Head title="Admin Dashboard - HMS" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    HMS Dashboard
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
                    <h1 class="text-2xl font-bold text-gray-900">Welcome back, {{ $page.props.auth.user?.name || 'Admin' }}!</h1>
                    <p class="text-gray-600 mt-2">Here's what's happening in your Hostel Management System today.</p>
                </div>

                <!-- Analytics Section -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
                    <div class="bg-white rounded-lg shadow border border-gray-200 p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600">Students</h3>
                                <p class="text-2xl font-bold text-gray-900 mt-1">284</p>
                            </div>
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow border border-gray-200 p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600">Complaints</h3>
                                <p class="text-2xl font-bold text-gray-900 mt-1">158</p>
                                <div class="flex items-center mt-2 text-xs">
                                    <span class="text-green-600 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        96 Received
                                    </span>
                                    <span class="ml-4 text-red-600">62 Open</span>
                                </div>
                            </div>
                            <div class="p-2 bg-red-100 rounded-lg">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.954-.833-2.724 0L4.346 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow border border-gray-200 p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600">Stock</h3>
                                <p class="text-2xl font-bold text-gray-900 mt-1">156</p>
                            </div>
                            <div class="p-2 bg-green-100 rounded-lg">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow border border-gray-200 p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600">Users</h3>
                                <p class="text-2xl font-bold text-gray-900 mt-1">42</p>
                            </div>
                            <div class="p-2 bg-purple-100 rounded-lg">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow border border-gray-200 p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600">Meals</h3>
                                <p class="text-2xl font-bold text-gray-900 mt-1">1,248</p>
                            </div>
                            <div class="p-2 bg-yellow-100 rounded-lg">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Cards Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Occupancy Card -->
                    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Occupancy (2)</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-medium text-gray-700">Hostel 1 (2)</h4>
                                    <p class="text-sm text-gray-500">Capacity: 100 beds</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-blue-600">50%</div>
                                    <div class="w-32 h-2 bg-gray-200 rounded-full mt-1">
                                        <div class="h-full bg-blue-600 rounded-full" style="width: 50%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-medium text-gray-700">Hostel 2 (2)</h4>
                                    <p class="text-sm text-gray-500">Capacity: 80 beds</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-green-600">75%</div>
                                    <div class="w-32 h-2 bg-gray-200 rounded-full mt-1">
                                        <div class="h-full bg-green-600 rounded-full" style="width: 75%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-medium text-gray-700">Hostel 3 (2)</h4>
                                    <p class="text-sm text-gray-500">Capacity: 120 beds</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-purple-600">95%</div>
                                    <div class="w-32 h-2 bg-gray-200 rounded-full mt-1">
                                        <div class="h-full bg-purple-600 rounded-full" style="width: 95%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fees Collection Card -->
                    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Fees Collection (2)</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                                <span class="font-medium text-blue-800">Expected</span>
                                <span class="text-xl font-bold text-blue-600">₹ 52,00,000</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                                <span class="font-medium text-green-800">Remaining</span>
                                <span class="text-xl font-bold text-green-600">₹ 15,60,000</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-yellow-50 rounded-lg">
                                <span class="font-medium text-yellow-800">Collected</span>
                                <span class="text-xl font-bold text-yellow-600">₹ 26,00,000</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-red-50 rounded-lg">
                                <span class="font-medium text-red-800">Overdue</span>
                                <span class="text-xl font-bold text-red-600">₹ 10,40,000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Complaints Card -->
                    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Complaints (2)</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-blue-50 p-4 rounded-lg text-center">
                                <div class="text-3xl font-bold text-blue-600">158</div>
                                <div class="text-sm text-blue-800 mt-2">Total Complaints</div>
                            </div>
                            <div class="bg-green-50 p-4 rounded-lg text-center">
                                <div class="text-3xl font-bold text-green-600">96</div>
                                <div class="text-sm text-green-800 mt-2">Received</div>
                            </div>
                            <div class="bg-yellow-50 p-4 rounded-lg text-center">
                                <div class="text-3xl font-bold text-yellow-600">42</div>
                                <div class="text-sm text-yellow-800 mt-2">In Progress</div>
                            </div>
                            <div class="bg-red-50 p-4 rounded-lg text-center">
                                <div class="text-3xl font-bold text-red-600">62</div>
                                <div class="text-sm text-red-800 mt-2">Open</div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-600">Resolution Rate</span>
                                <span class="text-sm font-medium text-gray-900">61%</span>
                            </div>
                            <div class="w-full h-2 bg-gray-200 rounded-full">
                                <div class="h-full bg-green-600 rounded-full" style="width: 61%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Student Update Card -->
                    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Student Updates (2)</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800">Ramakant Sharma</h4>
                                        <p class="text-sm text-gray-500">Room 101, Hostel 1</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-yellow-600">₹ 12,500</div>
                                    <div class="text-sm text-gray-500">Due</div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800">Amit Kumar</h4>
                                        <p class="text-sm text-gray-500">Room 205, Hostel 2</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-green-600">₹ 15,000</div>
                                    <div class="text-sm text-gray-500">Paid</div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800">Priya Singh</h4>
                                        <p class="text-sm text-gray-500">Room 312, Hostel 3</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-red-600">₹ 8,000</div>
                                    <div class="text-sm text-gray-500">Overdue</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Emergency Button -->
                <div class="mt-8">
                    <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-lg shadow-lg p-6 text-center">
                        <h3 class="text-xl font-bold text-white mb-2">Press only in Case of Emergency</h3>
                        <p class="text-red-100 mb-4">This button should only be used for real emergencies that require immediate attention.</p>
                        <button 
                            @click="triggerEmergency"
                            class="bg-white text-red-600 font-bold py-3 px-8 rounded-lg text-lg hover:bg-red-50 transition-colors shadow-md hover:shadow-lg transform hover:scale-105 transition-transform"
                        >
                            EMERGENCY
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
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

// Emergency function
const triggerEmergency = () => {
    if (confirm('Are you sure you want to trigger an emergency alert? This will notify all staff members immediately.')) {
        alert('Emergency alert has been triggered! All staff members have been notified.');
        // In a real application, you would make an API call here
        // axios.post('/api/emergency-alert');
    }
};

// Props for dynamic data
const props = defineProps({
    dashboardStats: {
        type: Object,
        default: () => ({
            totalStudents: 284,
            totalComplaints: 158,
            receivedComplaints: 96,
            openComplaints: 62,
            stockItems: 156,
            activeUsers: 42,
            mealsServed: 1248,
            hostel1Occupancy: 50,
            hostel2Occupancy: 75,
            hostel3Occupancy: 95,
            expectedFees: 5200000,
            remainingFees: 1560000,
            collectedFees: 2600000,
            overdueFees: 1040000
        })
    }
});
</script>

<style scoped>
/* Custom styles for the dashboard */
.emergency-btn {
    transition: all 0.3s ease;
}

.emergency-btn:hover {
    box-shadow: 0 10px 25px rgba(220, 38, 38, 0.4);
}

/* Custom scrollbar for student updates */
.student-updates {
    max-height: 300px;
    overflow-y: auto;
}

.student-updates::-webkit-scrollbar {
    width: 6px;
}

.student-updates::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.student-updates::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

.student-updates::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
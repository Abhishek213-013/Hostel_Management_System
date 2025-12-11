<template>
    <Head title="Type Configuration" />
    
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Type Configuration
                </h2>
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Manage system types and configurations
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
                            <h1 class="text-xl lg:text-2xl font-bold text-gray-900 dark:text-white">Type Configuration</h1>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 text-sm lg:text-base">Manage system types and configurations</p>
                    </div>
                    <button 
                        @click="showCreateMainTypeModal = true"
                        class="bg-blue-600 dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-600 text-white px-6 py-3 rounded-lg flex items-center justify-center space-x-2 transition-all duration-200 w-full lg:w-auto text-sm lg:text-base shadow-md hover:shadow-lg active:scale-95"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="font-medium">Add Main Type</span>
                    </button>
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

                <!-- Search and Filters -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4 mb-6">
                    <div class="flex flex-col lg:flex-row lg:items-center gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <input 
                                    type="text" 
                                    v-model="searchQuery"
                                    placeholder="Search main types..." 
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
                            <button 
                                @click="resetFilters"
                                class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-300 text-sm"
                            >
                                Reset
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Main Types Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 mb-8">
                    <div 
                        v-for="mainType in filteredMainTypes" 
                        :key="mainType.id"
                        class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-blue-300 dark:hover:border-blue-500 hover:shadow-md dark:hover:shadow-lg transition-all duration-200"
                    >
                        <Link :href="`/settings/types/main-type/${mainType.id}`" class="block p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ mainType.name }}</h3>
                                        <span 
                                            :class="['px-2 py-1 text-xs font-semibold rounded-full', 
                                                mainType.status 
                                                    ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300' 
                                                    : 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300'
                                            ]"
                                        >
                                            {{ mainType.status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">{{ mainType.description || 'No description available' }}</p>
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                                </svg>
                                                <span>{{ mainType.types_count || 0 }} types</span>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </Link>
                        
                        <!-- Quick Actions -->
                        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 rounded-b-lg">
                            <div class="flex items-center justify-between">
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    Position: {{ mainType.position }}
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button 
                                        @click.stop="editMainType(mainType)"
                                        class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 p-1.5 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20"
                                        title="Edit Main Type"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button 
                                        @click.stop="toggleMainTypeStatus(mainType)"
                                        :class="['p-1.5 rounded', 
                                            mainType.status 
                                                ? 'text-yellow-600 dark:text-yellow-500 hover:text-yellow-800 dark:hover:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-yellow-900/20' 
                                                : 'text-green-600 dark:text-green-500 hover:text-green-800 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20'
                                        ]"
                                        :title="mainType.status ? 'Deactivate' : 'Activate'"
                                    >
                                        <svg v-if="mainType.status" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                        </svg>
                                        <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <button 
                                        @click.stop="deleteMainType(mainType)"
                                        class="text-red-600 dark:text-red-500 hover:text-red-800 dark:hover:text-red-400 p-1.5 rounded hover:bg-red-50 dark:hover:bg-red-900/20"
                                        title="Delete Main Type"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-if="filteredMainTypes.length === 0" class="text-center py-8 lg:py-12 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                    <svg class="w-12 h-12 lg:w-16 lg:h-16 text-gray-400 dark:text-gray-500 mx-auto mb-3 lg:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    <h3 class="text-base lg:text-lg font-medium text-gray-900 dark:text-white mb-2">No main types found</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm lg:text-base mb-4">Get started by creating your first main type configuration.</p>
                    <button 
                        @click="showCreateMainTypeModal = true"
                        class="bg-blue-600 dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition-colors text-sm lg:text-base shadow-md hover:shadow-lg"
                    >
                        Add Main Type
                    </button>
                </div>

                <!-- Pagination -->
                <div v-if="mainTypes.data && mainTypes.data.length > 0" class="mt-8">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            Showing {{ mainTypes.from }} to {{ mainTypes.to }} of {{ mainTypes.total }} main types
                        </div>
                        <div class="flex items-center space-x-2">
                            <button 
                                @click="previousPage"
                                :disabled="!mainTypes.prev_page_url"
                                :class="['px-4 py-2 text-sm font-medium rounded-lg border', 
                                    mainTypes.prev_page_url 
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
                                        mainTypes.current_page === page 
                                            ? 'bg-blue-600 dark:bg-blue-700 text-white' 
                                            : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'
                                    ]"
                                >
                                    {{ page }}
                                </button>
                            </div>
                            
                            <button 
                                @click="nextPage"
                                :disabled="!mainTypes.next_page_url"
                                :class="['px-4 py-2 text-sm font-medium rounded-lg border', 
                                    mainTypes.next_page_url 
                                        ? 'text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700' 
                                        : 'text-gray-400 dark:text-gray-500 border-gray-200 dark:border-gray-700 cursor-not-allowed'
                                ]"
                            >
                                Next
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Create Main Type Modal -->
                <CreateMainTypeModal 
                    v-if="showCreateMainTypeModal"
                    :show="showCreateMainTypeModal"
                    @close="showCreateMainTypeModal = false"
                    @created="handleMainTypeCreated"
                />

                <!-- Edit Main Type Modal -->
                <EditMainTypeModal 
                    v-if="showEditMainTypeModal"
                    :show="showEditMainTypeModal"
                    :main-type="editingMainType"
                    @close="showEditMainTypeModal = false"
                    @updated="handleMainTypeUpdated"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateMainTypeModal from './Components/CreateMainTypeModal.vue';
import EditMainTypeModal from './Components/EditMainTypeModal.vue';

const props = defineProps({
    mainTypes: {
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
const showCreateMainTypeModal = ref(false);
const showEditMainTypeModal = ref(false);
const editingMainType = ref(null);

// Computed properties
const filteredMainTypes = computed(() => {
    let filtered = props.mainTypes.data || [];
    
    // Apply search filter
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        filtered = filtered.filter(mainType => 
            mainType.name?.toLowerCase().includes(query) ||
            mainType.description?.toLowerCase().includes(query)
        );
    }
    
    // Apply status filter
    if (statusFilter.value !== 'all') {
        const isActive = statusFilter.value === 'active';
        filtered = filtered.filter(mainType => mainType.status === isActive);
    }
    
    return filtered;
});

const paginationRange = computed(() => {
    if (!props.mainTypes.current_page || !props.mainTypes.last_page) {
        return [];
    }
    
    const current = props.mainTypes.current_page;
    const last = props.mainTypes.last_page;
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
const editMainType = (mainType) => {
    editingMainType.value = mainType;
    showEditMainTypeModal.value = true;
};

const deleteMainType = (mainType) => {
    if (confirm(`Are you sure you want to delete "${mainType.name}"? This will also delete all associated types.`)) {
        router.delete(route('settings.types.main.destroy', { id: mainType.id }), {
            preserveScroll: true,
            onSuccess: () => {
                router.reload({ only: ['mainTypes'] });
            },
            onError: (errors) => {
                alert('Failed to delete main type. It might have associated types.');
            }
        });
    }
};

const toggleMainTypeStatus = (mainType) => {
    const newStatus = !mainType.status;
    const action = newStatus ? 'activate' : 'deactivate';
    
    if (confirm(`Are you sure you want to ${action} "${mainType.name}"?`)) {
        router.patch(route('settings.types.main.toggle-status', { id: mainType.id }), {
            status: newStatus,
            _method: 'PATCH'
        }, {
            preserveScroll: true,
            onSuccess: () => {
                router.reload({ only: ['mainTypes'] });
            }
        });
    }
};

const handleMainTypeCreated = () => {
    showCreateMainTypeModal.value = false;
    router.reload({ only: ['mainTypes'] });
};

const handleMainTypeUpdated = () => {
    showEditMainTypeModal.value = false;
    editingMainType.value = null;
    router.reload({ only: ['mainTypes'] });
};

const resetFilters = () => {
    searchQuery.value = '';
    statusFilter.value = 'all';
};

const previousPage = () => {
    if (props.mainTypes.prev_page_url) {
        router.get(props.mainTypes.prev_page_url, {}, {
            preserveScroll: true,
            preserveState: true
        });
    }
};

const nextPage = () => {
    if (props.mainTypes.next_page_url) {
        router.get(props.mainTypes.next_page_url, {}, {
            preserveScroll: true,
            preserveState: true
        });
    }
};

const goToPage = (page) => {
    if (page !== '...' && page !== props.mainTypes.current_page) {
        const url = new URL(props.mainTypes.first_page_url);
        url.searchParams.set('page', page);
        router.get(url.toString(), {}, {
            preserveScroll: true,
            preserveState: true
        });
    }
};

// Watch for URL changes to update filters
watch(() => props.mainTypes, (newValue) => {
    // Update filters from URL if needed
}, { deep: true });
</script>

<style scoped>
/* Custom styles for dark mode */
.hover\:shadow-md {
    transition: box-shadow 0.3s ease;
}

.dark .hover\:shadow-lg:hover {
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
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
    transform: translateY(-2px);
}

.dark .bg-gray-800:hover {
    transform: translateY(-2px);
}

/* Status badge animation */
.px-2.py-1 {
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
    .grid-cols-3 {
        grid-template-columns: 1fr;
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
</style>
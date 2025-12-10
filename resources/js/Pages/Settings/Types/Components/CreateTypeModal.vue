<template>
    <div v-if="show" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto mx-2">
            <div class="px-4 lg:px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Add New {{ mainType.name }}</h3>
            </div>

            <form @submit.prevent="createType" class="p-4 lg:p-6 space-y-4">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                    <input 
                        v-model="form.name"
                        type="text" 
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm lg:text-base"
                        :placeholder="`Enter ${mainType.name.toLowerCase()} name`"
                        :class="{ 'border-red-300': form.errors.name }"
                    >
                    <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
                </div>

                <!-- Slug -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                    <div class="relative">
                        <input 
                            v-model="form.slug"
                            type="text" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm lg:text-base"
                            placeholder="auto-generated-slug"
                            :class="{ 'border-red-300': form.errors.slug }"
                        >
                        <button 
                            type="button"
                            @click="generateSlug"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 text-blue-600 hover:text-blue-800 text-sm"
                        >
                            Generate
                        </button>
                    </div>
                    <div v-if="form.errors.slug" class="text-red-500 text-sm mt-1">{{ form.errors.slug }}</div>
                    <p class="text-gray-500 text-xs mt-1">URL-friendly version of the name</p>
                </div>

                <!-- Position -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Position</label>
                    <input 
                        v-model="form.position"
                        type="number" 
                        step="0.0001"
                        min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm lg:text-base"
                        placeholder="Auto-calculated if left empty"
                        :class="{ 'border-red-300': form.errors.position }"
                    >
                    <div v-if="form.errors.position" class="text-red-500 text-sm mt-1">{{ form.errors.position }}</div>
                    <p class="text-gray-500 text-xs mt-1">Lower numbers appear first (decimal allowed)</p>
                </div>

                <!-- Metadata -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Metadata (JSON)</label>
                    <textarea 
                        v-model="metadataInput"
                        rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm lg:text-base font-mono text-sm"
                        placeholder='{"key": "value", "color": "#ff0000"}'
                        :class="{ 'border-red-300': form.errors.metadata }"
                    ></textarea>
                    <div v-if="form.errors.metadata" class="text-red-500 text-sm mt-1">{{ form.errors.metadata }}</div>
                    <p class="text-gray-500 text-xs mt-1">Optional JSON data for additional configuration</p>
                </div>

                <!-- Status -->
                <div>
                    <label class="flex items-center space-x-3">
                        <input 
                            v-model="form.status"
                            type="checkbox"
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                        >
                        <span class="text-sm font-medium text-gray-700">Active</span>
                    </label>
                    <div v-if="form.errors.status" class="text-red-500 text-sm mt-1">{{ form.errors.status }}</div>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-4 border-t border-gray-200">
                    <button 
                        type="button"
                        @click="closeModal"
                        class="px-6 py-3 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm lg:text-base order-2 sm:order-1"
                    >
                        Cancel
                    </button>
                    <button 
                        type="submit"
                        :disabled="form.processing"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed text-sm lg:text-base order-1 sm:order-2 shadow-md hover:shadow-lg"
                    >
                        {{ form.processing ? 'Creating...' : `Add ${mainType.name}` }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    show: {
        type: Boolean,
        required: true
    },
    mainType: {
        type: Object,
        required: true
    }
});

const emit = defineEmits(['close', 'created']);

const form = useForm({
    type_id: props.mainType.id,
    name: '',
    slug: '',
    position: null,
    status: true,
    metadata: null
});

const metadataInput = ref('');

const generateSlug = () => {
    if (form.name) {
        form.slug = form.name
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }
};

const createType = () => {
    // Parse metadata if provided
    if (metadataInput.value.trim()) {
        try {
            form.metadata = JSON.parse(metadataInput.value);
        } catch (error) {
            form.setError('metadata', 'Invalid JSON format');
            return;
        }
    } else {
        form.metadata = null;
    }

    form.post('/settings/types', {
        preserveScroll: true,
        onSuccess: () => {
            emit('created');
            closeModal();
        }
    });
};

const closeModal = () => {
    emit('close');
    form.reset();
    form.clearErrors();
    metadataInput.value = '';
    form.type_id = props.mainType.id;
};

// Watch name changes to auto-generate slug
watch(() => form.name, (newName) => {
    if (newName && !form.slug) {
        generateSlug();
    }
});

// Set initial position based on existing types
watch(() => props.show, (show) => {
    if (show) {
        // Fetch next position from API or calculate
        form.position = null; // Let backend calculate
    }
});
</script>
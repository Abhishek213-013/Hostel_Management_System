<template>
    <div v-if="show" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto mx-2">
            <div class="px-4 lg:px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Create New Main Type</h3>
            </div>

            <form @submit.prevent="createMainType" class="p-4 lg:p-6 space-y-4">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                    <input 
                        v-model="form.name"
                        type="text" 
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm lg:text-base"
                        placeholder="Enter main type name (e.g., Gender, Room Type)"
                        :class="{ 'border-red-300': form.errors.name }"
                    >
                    <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
                </div>

                <!-- Slug -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Slug *</label>
                    <div class="relative">
                        <input 
                            v-model="form.slug"
                            type="text" 
                            required
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
                        min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm lg:text-base"
                        placeholder="Enter position number"
                        :class="{ 'border-red-300': form.errors.position }"
                    >
                    <div v-if="form.errors.position" class="text-red-500 text-sm mt-1">{{ form.errors.position }}</div>
                    <p class="text-gray-500 text-xs mt-1">Lower numbers appear first</p>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea 
                        v-model="form.description"
                        rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm lg:text-base"
                        placeholder="Enter description (optional)"
                        :class="{ 'border-red-300': form.errors.description }"
                    ></textarea>
                    <div v-if="form.errors.description" class="text-red-500 text-sm mt-1">{{ form.errors.description }}</div>
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
                        {{ form.processing ? 'Creating...' : 'Create Main Type' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    show: {
        type: Boolean,
        required: true
    }
});

const emit = defineEmits(['close', 'created']);

const form = useForm({
    name: '',
    slug: '',
    position: 0,
    description: '',
    status: true
});

const generateSlug = () => {
    if (form.name) {
        form.slug = form.name
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }
};

const createMainType = () => {
    form.post('/settings/types/main', {
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
};

// Watch name changes to auto-generate slug
watch(() => form.name, (newName) => {
    if (newName && !form.slug) {
        generateSlug();
    }
});
</script>
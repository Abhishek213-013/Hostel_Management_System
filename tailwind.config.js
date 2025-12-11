import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class', // Add this line to enable class-based dark mode
    
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // You can add custom colors for dark mode here if needed
                dark: {
                    'bg-primary': '#111827',    // gray-900
                    'bg-secondary': '#1f2937',  // gray-800
                    'bg-tertiary': '#374151',   // gray-700
                    'text-primary': '#f9fafb',  // gray-50
                    'text-secondary': '#e5e7eb', // gray-200
                    'text-tertiary': '#9ca3af',  // gray-400
                    'border': '#374151',        // gray-700
                }
            },
            transitionProperty: {
                'theme': 'background-color, border-color, color, fill, stroke, opacity, box-shadow, transform, filter',
            }
        },
    },

    plugins: [forms],
};
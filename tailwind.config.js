import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    darkMode: 'class',
    important: true,
    theme: {
        extend: {
            screens: {
                'sm': '640px',
                'md': '768px',
                'lg': '1024px',
                'xl': '1380px',
            },
            colors: {
                // Темная тема (по умолчанию)
                'primary': '#29292B',
                'primary-dark': '#29292B',
                'primary-light': '#ffffff',

                'secondary-dark': '#3a3a3c',
                'secondary-light': '#f8f9fa',

                'body': '#18181A',
                'body-dark': '#18181A',
                'body-light': '#ffffff',

                'red': '#d42222',

                // Дополнительные цвета для светлой темы
                'text-primary-light': '#1f2937',
                'text-secondary-light': '#6b7280',
                'text-muted-light': '#9ca3af',

                'border-light': '#e5e7eb',
                'border-dark': 'rgba(255, 255, 255, 0.2)',

                'hover-light': '#f3f4f6',
                'hover-dark': 'rgba(255, 255, 255, 0.1)',
            },
            backgroundColor: {
                'theme': 'var(--bg-theme)',
                'theme-primary': 'var(--bg-theme-primary)',
                'theme-secondary': 'var(--bg-theme-secondary)',
            },
            textColor: {
                'theme': 'var(--text-theme)',
                'theme-secondary': 'var(--text-theme-secondary)',
                'theme-muted': 'var(--text-theme-muted)',
            },
            borderColor: {
                'theme': 'var(--border-theme)',
            },
        },
    },
};

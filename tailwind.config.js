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
            'primary': '#29292B',
            'body': '#18181A',
            'red': '#d42222',

        } 
        },
     
    },

};

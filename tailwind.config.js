import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            // Tambahkan bagian colors ini:
            colors: {
                'ars-navy': '#1A365D',
                'ars-yellow': '#FFC107',
                'ars-gray': '#4A4A4A',
                // White dan Black tidak perlu didaftarkan karena Tailwind sudah memilikinya secara bawaan
            },
        },
    },

    plugins: [forms],
};
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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary': {
                    DEFAULT: '#0C5587',
                    dark: '#094468',
                    light: '#0F6BA3',
                },
                'secondary': {
                    DEFAULT: '#C7E339',
                    dark: '#B8BC4D',
                    light: '#DDE073',
                },
                'accent': {
                    DEFAULT: '#0884D1',
                    dark: '#0669A8',
                    light: '#3DA0DD',
                },
                'light-bg': '#EDF7FC',
                'light-blue': {
                    DEFAULT: '#B1D7F2',
                    dark: '#8CC3E8',
                    light: '#CBE4F7',
                },
            },
        },
    },

    plugins: [forms],
};

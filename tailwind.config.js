import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                google: {
                  'text-gray': '#3c4043',
                  'button-blue': '#1a73e8',
                  'button-blue-hover': '#5195ee',
                  'button-dark': '#202124',
                  'button-dark-hover': '#555658',
                  'button-border-light': '#dadce0',
                  'logo-blue': '#4285f4',
                  'logo-green': '#34a853',
                  'logo-yellow': '#fbbc05',
                  'logo-red': '#ea4335',
                },
              },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
};

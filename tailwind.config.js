import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                "primary": "#0df2f2",
                "background-light": "#f5f8f8",
                "background-dark": "#102222",
            },
            fontFamily: {
                // Kita gabungkan dengan font default bawaan tailwind sebagai cadangan
                "display": ["Plus Jakarta Sans", ...defaultTheme.fontFamily.sans],
            },
            borderRadius: {
                "DEFAULT": "0.5rem",
                "lg": "1rem",
                "xl": "1.5rem",
                "full": "9999px"
            },
        },
    },
    plugins: [],
};
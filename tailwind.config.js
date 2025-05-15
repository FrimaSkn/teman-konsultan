/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/frontend/**/*.blade.php",
        './resources/views/components/frontend/**/*.blade.php',
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    plugins: [],
}


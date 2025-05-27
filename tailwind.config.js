/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/frontend/**/*.blade.php",
        './resources/views/components/frontend/**/*.blade.php',
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            container: {
                center: true,
                padding: '1rem',
                screens: {
                    sm: "540px",
                    md: "720px",
                    lg: "1010px",
                    xl: "1220px"
                }
            },
            colors: {
                primary: '#283e89',
                secondary: '#e4bd22',
                accent: '#58585a',
                neutral: '#374151',
                'base-100': '#FFFFFF',
                info: '#3ABFF8',
                success: '#36D399',
                warning: '#FBBD23',
                error: '#F87272',
            },
        },
    },
    plugins: [],
}


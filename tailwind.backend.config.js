/** @type {import('tailwindcss').Config} */

import preset from "./vendor/filament/support/tailwind.config.preset";

// Shade 50-950 yang dipakai Filament (diambil dari CSS variable @filamentStyles)
const filamentShades = (name) =>
    Object.fromEntries(
        [50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 950].map((shade) => [
            shade,
            `rgba(var(--${name}-${shade}), <alpha-value>)`,
        ]),
    );

export default {
    presets: [preset],
    darkMode: "class",
    content: [
        // ...yang sudah ada
        "./vendor/awcodes/filament-tiptap-editor/resources/**/*.blade.php",
        "./app/**/*.php",
        "./vendor/filament/**/*.blade.php",
    ],
    theme: {
        extend: {
            colors: {
                primary: { DEFAULT: "#283e89", ...filamentShades("primary") },
                info: { DEFAULT: "#3ABFF8", ...filamentShades("info") },
                success: { DEFAULT: "#36D399", ...filamentShades("success") },
                warning: { DEFAULT: "#FBBD23", ...filamentShades("warning") },
                secondary: "#e4bd22",
                accent: "#58585a",
                neutral: "#374151",
                "base-100": "#FFFFFF",
                error: "#F87272",
            },
        },
    },
    plugins: [],
};

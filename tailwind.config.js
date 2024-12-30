import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./resources/js/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            screens: {
                xs: { max: "639px" },

                // Don't need xs since Tailwind uses min-width approach
                // to its media queries.
                sm: "576px",
                md: "768px",
                lg: "992px",
                xl: "1200px",
                xxl: "1400px",
                // => @media (max-width: 639px) { ... }
            },
        },
    },

    plugins: [forms],

    darkMode: "class",
};

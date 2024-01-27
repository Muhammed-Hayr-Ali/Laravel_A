/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/tw-elements/dist/js/**/*.js",

    ],
    theme: {
        extend: {




            colors: {
                "primaryColor": {
                    50: '#edfff9',
                    100: '#d5fff2',
                    200: '#aeffe5',
                    300: '#70ffd2',
                    400: '#2bfdb9',
                    500: '#00ffad',
                    600: '#00c07e',
                    700: '#009666',
                    800: '#067552',
                    900: '#076046',
                    950: '#003726',
                },
                "default": { 500: '#F8F9FA' },
                "primary": {
                    50: '#edfaff',
                    100: '#d6f2ff',
                    200: '#b5eaff',
                    300: '#83dfff',
                    400: '#48cbff',
                    500: '#1eadff',
                    600: '#068fff',
                    700: '#007bff',
                    800: '#085ec5',
                    900: '#0d519b',
                    950: '#0e315d',
                },
                'secondary': {
                    50: '#f5f6f6',
                    100: '#e5e7e8',
                    200: '#cdd1d4',
                    300: '#aab0b6',
                    400: '#808990',
                    500: '#6c757d',
                    600: '#565c64',
                    700: '#4a4f54',
                    800: '#414449',
                    900: '#3a3c3f',
                    950: '#242628',
                },

                "success": { 500: '#28a745' },
                "info": { 500: '#17a2b8' },
                "warning": { 500: '#ffc107' },
                "danger": { 500: '#dc3545' },
            },
























        },
    },
    darkMode: "class",
    plugins: [require("tw-elements/dist/plugin.cjs")]
}





/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/tw-elements/dist/js/**/*.js"

  ],
  theme: {
    extend: {




      colors: {
        "primaryColor": { 500: '#00ffad' },
        "default": { 500: '#F8F9FA' },
        "primary": { 500: '#007bff' },
        "secondary": { 500: '#6c757d' },
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





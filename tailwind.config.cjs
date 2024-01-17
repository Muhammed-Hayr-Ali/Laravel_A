/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {

      colors: {
        primaryColor: {
          500: '#00ffae',
        },
      },
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

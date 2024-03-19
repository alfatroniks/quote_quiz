/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.js",
        "./resources/**/**/*.js",
        "./resources/**/*.vue",
        "./resources/**/**/*.vue"
    ],
  theme: {
    extend: {
        colors: {
            'custom-red': '#ff4757',
        },
    },
  },
  plugins: [],
}


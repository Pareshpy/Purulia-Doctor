module.exports = {
  darkMode: 'class',
  content: [
    './assets/css/**/*.css',
    './**/*.html',
    './**/*.php',
    './src/**/*.{js,jsx,ts,tsx}',
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],
};

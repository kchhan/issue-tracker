module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {}
  },
  variants: {
    extend: {
      backgroundColor: ['even'],
    } 
  },
  plugins: [
    require('@tailwindcss/ui'),
  ]
}

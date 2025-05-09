/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/*.html.twig",
    "./templates/**/*.html.twig",
    "./templates/**/**/*.html.twig",
    "./src/Form/*.php",
  ],
  theme: {
    extend: {
      colors: {
        trasparent: 'transparent',
        primary: '#051014',
        secondary: '#FB8B24',
        light: '#D6D9CE',
      },
    },
  },
  plugins: [],
}


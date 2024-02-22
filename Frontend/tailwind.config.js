/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "src/App.vue",
    "src/components/Nav.vue",
    "src/pages/Home.vue",
    "src/pages/Signup.vue",
    "src/pages/Login.vue",
    "src/pages/Map.vue",
    "src/pages/Places.vue"
  ],
  theme: {
    extend: {},
    fontFamily: {
      sans: [
        '"Inter var", sans-serif',
        {
          fontFeatureSettings: '"cv11", "ss01"',
          fontVariationSettings: '"opsz" 32'
        },
      ],
    },
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      'white': '#ffffff',
      'black': '#2F2F2F',
      'gray': '#4F4E4E',
      'medium-gray': '#6D7877',
      'light-gray': '#99AAA9',
      'base': '#E8F3F3',
      'primary': '#70DAD3',
      'dark': '#3B4948',
      'accent': '#EC8C6F',
    },
    borderRadius: {
      'none': '0',
      DEFAULT: '0.25rem',
      DEFAULT: '4px',
      'sm': '0.5rem',
      'md': '1.5rem',
      'lg': '2.5rem',
      'xl': '4rem',
      'full': '9999px',
    },
  },
  plugins: [],
}


/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "Frontend/src/components/HelloWorld.vue"
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
      'medium-gray': '#848484',
      'light-gray': '#DBDBDB',
      'base': '#E8F3F3',
      'primary': '#70DAD3',
      'dark': '#D3E1EE',
      'accent': '#EC8C6F',
    },
    borderRadius: {
      'none': '0',
      DEFAULT: '0.25rem',
      DEFAULT: '4px',
      'sm': '0.5rem',
      'md': '1rem',
      'lg': '3rem',
      'full': '9999px',
    },
  },
  plugins: [],
}


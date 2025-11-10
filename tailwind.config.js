/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        primary: '#5272FF',   // Tu color azul
        secondary: '#1C9AEA', // Tu color rosa
      },
      keyframes: {
        // de -12px (arriba) a 12px (abajo)
        'slide-y': {
          from:   { transform: 'translateY(-12px)' },
          to:     { transform: 'translateY(12px)'  },
        },
      },
      animation: {
        // alterna dirección y repite infinito
        'slide-up': 'slide-y 2s ease-in-out infinite alternate',
      },
    },
  },
  plugins: [],
}
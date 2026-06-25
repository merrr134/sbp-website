/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#006591',
          light: '#0EA5E9',
          dark: '#004C6E',
        },
        navy: {
          DEFAULT: '#0C4A6E',
          deep: '#001E2F',
        },
        amber: {
          brand: '#D88A00',
        },
        surface: {
          DEFAULT: '#F8F9FF',
          low: '#EFF4FF',
          container: '#E5EEFF',
        }
      },
      animation: {
            marquee: 'marquee 30s linear infinite',
        },
        keyframes: {
            marquee: {
                '0%': { transform: 'translateX(0%)' },
                '100%': { transform: 'translateX(-100%)' },
            },
        },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      },
      maxWidth: {
        container: '1280px',
      },
      borderRadius: {
        DEFAULT: '0.5rem',
        md: '0.75rem',
        lg: '1rem',
        xl: '1.5rem',
      },
      boxShadow: {
        card: '0px 4px 20px rgba(12, 74, 110, 0.08)',
        modal: '0px 12px 32px rgba(12, 74, 110, 0.12)',
      }
    },
  },
  plugins: [],
}

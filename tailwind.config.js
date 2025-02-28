import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import flowbite from 'flowbite/plugin';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './node_modules/flowbite/**/*.js',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        "hijau-tua": "#347928",
        "hijau-muda": "#60DF4A",
        "hijau-toska": "#11AA66",
        "hijau": "#6D855E",
        "hijau-keruh": "#C0EBA6",
        "kuning-keruh": "#FCCD2A",
        "kuning-muda": "#FFFB00",
        "coklat-muda": "#E1341E",
        "coklat-tua": "#8F0404",
        "abu-abu": "#D9D9D9",
        "putih": "#FFFBE6",
        "pink-keruh": "#AA1155",
      },
      spacing: {
        '150': '33rem',
        '128': '26.25rem',
        "15": "3.75rem",
        "17": "4.25rem",
        "1.5": "0.375rem",
        "85": "22rem",
        "100": "26rem"
      }
    },
  },

  plugins: [
    forms,
    flowbite,
  ],
};

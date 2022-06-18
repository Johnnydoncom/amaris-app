const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],

    // make sure to safelist these classes when using purge
    safelist: [
        'w-64',
        'w-1/2',
        'rounded-l-lg',
        'rounded-r-lg',
        'bg-gray-200',
        'grid-cols-4',
        'grid-cols-7',
        'h-6',
        'leading-6',
        'h-9',
        'leading-9',
        'shadow-lg'
    ],

    // enable dark mode via class strategy
    darkMode: 'class',

    theme: {
        fontFamily: {
            sans: ['Muli', 'sans-serif'],
            serif: ['Montserrat', 'serif'],
        },
        extend: {
            colors: {
                "primary": {
                    DEFAULT: "#0C0531",
                    "50": "#DCD5FB",
                    "100": "#B8ACF7",
                    "200": "#7158EE",
                    "300": "#3616D5",
                    "400": "#210D82",
                    "500": "#0C0531",
                    "600": "#090425",
                    "700": "#07031C",
                    "800": "#050213",
                    "900": "#020109"
                },
                "secondary": {
                    DEFAULT: "#FB0404",
                    "50": "#FFE6E6",
                    "100": "#FECDCD",
                    "200": "#FD9B9B",
                    "300": "#FD6868",
                    "400": "#FC3636",
                    "500": "#FB0404",
                    "600": "#C90303",
                    "700": "#970202",
                    "800": "#640202",
                    "900": "#320101"
                },
                "accent": {
                    DEFAULT: "#F20505",
                    "50": "#FEE6E6",
                    "100": "#FECDCD",
                    "200": "#FD9696",
                    "300": "#FC6464",
                    "400": "#FB3232",
                    "500": "#F20505",
                    "600": "#C30404",
                    "700": "#910303",
                    "800": "#5F0202",
                    "900": "#320101"
                },
                "neutral": {
                    DEFAULT: "#040404",
                    "50": "#E6E6E6",
                    "100": "#CCCCCC",
                    "200": "#9C9C9C",
                    "300": "#696969",
                    "400": "#363636",
                    "500": "#040404",
                    "600": "#030303",
                    "700": "#030303",
                    "800": "#030303",
                    "900": "#000000"
                },
                "info": {
                    DEFAULT: "#3ABFF8",
                    "50": "#EBF9FE",
                    "100": "#D8F2FE",
                    "200": "#B0E5FC",
                    "300": "#89D9FB",
                    "400": "#61CCF9",
                    "500": "#3ABFF8",
                    "600": "#08A8EC",
                    "700": "#067EB1",
                    "800": "#045476",
                    "900": "#022A3B"
                },
                "success": {
                    DEFAULT: "#36D399",
                    "50": "#EAFAF4",
                    "100": "#D5F6EA",
                    "200": "#AFEED7",
                    "300": "#86E4C2",
                    "400": "#60DCAF",
                    "500": "#36D399",
                    "600": "#26B07D",
                    "700": "#1C825D",
                    "800": "#13583F",
                    "900": "#092A1E"
                },
                "warning": {
                    DEFAULT: "#FBBD23",
                    "50": "#FFF9EB",
                    "100": "#FEF2D2",
                    "200": "#FDE4A5",
                    "300": "#FDD87D",
                    "400": "#FCCB50",
                    "500": "#FBBD23",
                    "600": "#E1A304",
                    "700": "#AA7B03",
                    "800": "#6E5002",
                    "900": "#372801"
                },
                "error": {
                    DEFAULT: "#F87272",
                    "50": "#FEF0F0",
                    "100": "#FEE2E2",
                    "200": "#FCC5C5",
                    "300": "#FBACAC",
                    "400": "#F98F8F",
                    "500": "#F87272",
                    "600": "#F52E2E",
                    "700": "#D10A0A",
                    "800": "#880707",
                    "900": "#440303"
                }
            },
            backgroundImage: {
                'page-heading-pattern': "url('/storage/hero-bg.png')",
                'footer-pattern': "url('/storage/hero-bg.png')",
                'footer-texture': "url('/storage/Animated-Shape.svg')",
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('flowbite/plugin'),
        require('@tailwindcss/line-clamp')
    ],
};

const path = require("path");
const colors = require("tailwindcss/colors");

module.exports = {
    purge: [
        path.resolve(__dirname, "./node_modules/litepie-datepicker/**/*.js")
    ],
    darkMode: "class", // or 'media' or 'class'
    theme: {
        extend: {
            colors: {
                // Change with you want it
                "litepie-primary": colors.blue, // color system for light mode
                "litepie-secondary": colors.gray // color system for dark mode
            },
            padding: {
                "py-2.5": "0.375rem"
            },
            spacing: {
                "2.5": "0.375rem"
            }
        }
    },
    variants: {
        extend: {
            cursor: ["disabled"],
            textOpacity: ["disabled"],
            textColor: ["disabled"]
        }
    },
    plugins: []
};

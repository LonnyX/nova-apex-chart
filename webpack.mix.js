let mix = require("laravel-mix");
const path = require("path");

require("./nova.mix");

mix.setPublicPath("dist")
    .js("resources/js/nova-apex-chart.js", "js")
    .vue({ version: 3 })
    .postCss("resources/css/index.css", "dist", [
        require("postcss-import"),
        require("tailwindcss")
    ])
    .webpackConfig({
        resolve: {
            symlinks: false,
            alias: {
                "@": path.resolve(
                    __dirname,
                    "vendor/laravel/nova/resources/js/"
                )
            }
        }
    })
    .nova("lonnyx/nova-apex-chart");

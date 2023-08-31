let mix = require('laravel-mix');

mix.js("src/js/app.js", "dist/")
mix.sass("src/scss/app.scss", "dist/");

mix.browserSync({
    proxy: "https://search-initiative.test/",
    files: ["./**/*.php", "./dist/**/*.*"],
});
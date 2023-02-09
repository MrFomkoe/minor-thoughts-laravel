import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/scss/app.scss",
                "resources/js/imageSlider.js",
                "resources/js/addSongForm.js",
                "resources/js/collapseSection.js",
                "resources/js/filterPhotos.js",
            ],
            refresh: true,
        }),
    ],
});

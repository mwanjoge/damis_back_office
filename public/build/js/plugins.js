/*
Template Name: Velzon - Admin & Dashboard Template
Author: Themesbrand
Version: 4.3.0
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: Common Plugins Js File
*/

//Common plugins
if (document.querySelectorAll("[toast-list]") || document.querySelectorAll('[data-choices]') || document.querySelectorAll("[data-provider]")) {
    // Dynamically load scripts to avoid parser-blocking warnings
    const scripts = [
        'https://cdn.jsdelivr.net/npm/toastify-js',
        'build/libs/choices.js/public/assets/scripts/choices.min.js',
        'build/libs/flatpickr/flatpickr.min.js'
    ];

    scripts.forEach(function(src) {
        const script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = src;
        script.async = false; // Maintain execution order
        document.head.appendChild(script);
    });
}


window._ = require('lodash');
window.Popper = require('popper.js').default;
try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
    require('magnific-popup');
} catch (e) {}

try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
    require('@fortawesome/fontawesome-free/js/all.js');
} catch (e) {}

$(() => {
    $('#logout').click((e) => {
        e.preventDefault()
        $('#logout-form').submit()
    })
    $('[data-toggle="tooltip"]').tooltip()
})


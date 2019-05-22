
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

   // Alerte lorque l'on veut détruire une image
   $('.delete').submit(function(e){
    e.preventDefault()
    Swal.fire({
        title: 'Êtes-vous sûr?',
        text: "Vous ne pourrez pas revenir en arrière! ",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
            this.submit();
        }
    })
})

// Alerte lorque l'on autoriser une image
$('.undo').submit(function(e){
    e.preventDefault()
    Swal.mixin({
        confirmButtonText: 'Next &rarr;',
        showCancelButton: true,
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).queue([
        {
            title: 'Êtes-vous sûr?',
            text: "Vous ne pourrez pas revenir en arrière! ",
            confirmButtonText: 'Oui'
        },
    ]).then((result) => {
        if (result.value) {
            Swal.fire(
                'Autoriser!',
                'Image a bien ete autoriser.',
                'success'
            )
            this.submit();
        }
    })
})

// Previent le click par defaut du boutton logout
$(() => {
    $('#logout').click((e) => {
        e.preventDefault()
        $('#logout-form').submit()
    })
    $('[data-toggle="tooltip"]').tooltip()
})

// retourne le user_id de l'utilisateur actuel au modal
$('.btn-edit-user').on('click', function() {
    var button = $(event.relatedTarget)
    var recipient = $(this).data('id')
    var path = "/user/" + recipient;
    $('form').attr('action', path)
})

// retourne le location_id du locations actuel au modal
$('.btn-edit-location').on('click', function() {
    var button = $(event.relatedTarget)
    var recipient = $(this).data('id')
    var path = "/location/" + recipient;
    $('form').attr('action', path)
})



 // Alerte l'images  
$('.flag').submit(function(e){
    e.preventDefault()
    Swal.fire(
        'Êtes-vous sûr?',
        'Vous ne pourrez pas revenir en arrière!',
        'question'
    )
    .then((result) => {
        if (result.value) {
            this.submit();
        }
    })
})

// // animation du header

// var header_mini = false;

// $(window).scroll(function() {
//     var y_position = window.pageYOffset
//     var y_menu = 50;

//     if(y_position > y_menu && !header_mini) {
//         $('#main-header').addClass('headerMini')
//         header_mini = true
//     }
//     else if(y_position < y_menu && header_mini) {
//         $('#main-header').removeClass('headerMini')
//         header_mini = false
//     }
// })




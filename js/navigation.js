/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
jQuery(document).ready(function($) {
    $('body').on('click', '.password-control', function(){
        if ($('#password').attr('type') == 'password'){
            $(this).addClass('view');
            $('#password').attr('type', 'text');
        } else {
            $(this).removeClass('view');
            $('#password').attr('type', 'password');
        }
        return false;
    });
    $('#phone').on('input', function() {
        var phoneInput = $(this);
        var phonePattern = /^\+?[0-9]{1,3}\s?[0-9]{3}\s?[0-9]{3}\s?[0-9]{4}$/;

        if (!phonePattern.test(phoneInput.val())) {
            $('#phoneError').show();
        } else {
            $('#phoneError').hide();
        }
    });
    $('#emailForm').submit(function(event) {
        var emailInput = $('#email').val();
        var emailError = $('#emailError');

        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailInput)) {
            emailError.show();
            event.preventDefault();
        } else {
            emailError.hide();
        }
    });

    $('#email').on('input', function() {
        $('#emailError').hide();
    });

    $('#name').on('input', function() {
        var nameInput = $(this).val();
        var nameError = $('#nameError');

        var namePattern = /^[A-Za-zА-ЯҐЄІЇа-яґєії'][A-Za-zА-ЯҐЄІЇа-яґєії']*$/;
        if (!namePattern.test(nameInput)) {
            nameError.show();
        } else {
            nameError.hide();
        }
    });
    $('#my-form').submit(function(event) {
        var emptyFields = false;

        // Перевіряємо кожне поле на наявність значення
        $(this).find('input, select').each(function() {
            if ($(this).prop('required') && !$(this).val().trim()) {
                emptyFields = true;
                $(this).siblings('.error-message').text('Це поле обов\'язкове для заповнення').show();
            }
        });

        // Якщо є пусті поля, відміняємо дію відправки форми
        if (emptyFields) {
            event.preventDefault();
        }
    });
});



jQuery(document).ready(function($) {
    $('#my-form').submit(function(event) {
        event.preventDefault();

        var password = $('#password').val();
        var confirmPassword = $('#password').val(); // Використовуємо той самий пароль для порівняння

        // Перевірка, чи пароль порожній
        if (password.trim() === '') {
            $('#password-error').text("Password is required");
            return false;
        }

        // Перевіряємо співпадіння паролів
        if (password !== confirmPassword) {
            $('#password-error').text("Passwords do not match"); // Display error message
            return false; // Виходимо з функції без відправлення форми
        } else {
            $('#password-error').text(""); // Clear error message if passwords match
        }

        var form_data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'my_ajax_action',
                data: form_data
            },
            success: function(response) {
                $('#response').html(response);
            }
        });
    });

    // Clear error message when passwords match
    $('#password').keyup(function() {
        $('#password-error').text(""); // Clear error message
    });
});

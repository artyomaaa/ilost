/**
 *sign up
 */
function hideLoader() {
    $('#user-id').attr('disabled', false);
    $('#user-id').removeClass('btn-lg');
    $('.loading').css('display', 'none');
}

$(document).ready(function () {
    $('#user-id').click(function (e) {
        // $(this).attr('disabled', true);
        $(this).addClass('btn-lg');
        $('.loading').css('display', 'inline-block');
        e.preventDefault();
        $(".error-massage").empty();
        let first_name = $('#first-name').val();
        let last_name = $('#last-name').val();
        let email = $('#email').val();
        let password = $('#user-password').val();
        let contact_number = $('#contact_number').val();
        let messages = userErrorMessages();
        let language = $('#language').text();
        if (first_name.trim() === "") {
            $('#first-name').css('border-bottom', '1px solid red');
            $("#first-name-error").text(messages['empty_first_name']);
            hideLoader();

        } else if (last_name.trim() === "") {
            $('#last-name').css('border-bottom', '1px solid red');
            $("#last-name-error").text(messages['empty_last_name']);
            hideLoader();
        } else if (email.trim() === "") {
            $('#email').css('border-bottom', '1px solid red');
            $("#email-error").text(messages['empty_email']);
            hideLoader();

        } else if (!validateEmail(email)) {
            $('#email').css('border-bottom', '1px solid red');
            $("#email-error").text(messages['no_email']);
            hideLoader();

        } else if (password.trim() === "") {
            $('#user-password').css('border-bottom', '1px solid red');
            $("#user-password-error").text(messages['empty_user_password']);
            hideLoader();

        } else if (password.length < 8) {
            $('#user-password').css('border-bottom', '1px solid red');
            $("#user-password-error").text(messages['min_password']);
            hideLoader();
        } else if (contact_number.trim() === '') {
            $('#contact_number').css('border-bottom', '1px solid red');
            $("#contact_number_error").text(messages['empty_contact_number']);
            hideLoader();

        } else {
            let data = {
                first_name: first_name,
                last_name: last_name,
                email: email,
                password: password,
                contact_number: contact_number,
            };
            $.ajax({
                type: "POST",
                url: "/auth/sign-up",
                data: data,
                success: function (response) {
                    if (response.success === false) {
                        $('#error-message').text(response['errors']['email'][0]);
                    } else {
                        $('.contact-user-error > p').text(errorMessages()['sign_up_message']).css({'color': '#3247a9'});
                        $("#contact_myModal").show();
                        $("body").css('overflow', 'hidden');
                        alertBox();
                        $('#login-modal').hide();
                    }
                    hideLoader();
                }
            });
        }

    });
});
/**
 *sign in
 */
$(document).ready(function () {
    $('#change-email').click(function (e) {
        // $(this).attr('disabled', true);
        $(this).addClass('btn-lg');
        $('.loading').css('display', 'inline-block');
        e.preventDefault();
        $(".error-massage").empty();
        let email = $('#sign-in-email').val();
        let password = $('#sign-in-password').val();
        let messages = userErrorMessages();
        if (email.trim() === "") {
            $('#sign-in-email').css('border-bottom', '1px solid red');
            $("#sign-in-email-error").text(messages['empty_email']);
            hideLoader();
        } else if (!validateEmail(email)) {
            $('#sign-in-email').css('border-bottom', '1px solid red');
            $("#sign-in-email-error").text(messages['no_email']);
            hideLoader();
        } else if (password.trim() === "") {
            $('#sign-in-password').css('border-bottom', '1px solid red');
            $("#sign-in-password-error").text(messages['empty_user_password']);
            hideLoader();
        } else {
            $('.loading').css('display', 'inline-block');
            $.ajax({
                type: "POST",
                url: "/auth/sign-in",
                data: {
                    email: email,
                    password: password,
                },
                success: function (response) {
                    $('.loading').css('display', 'none');
                    if (response.success === false) {
                        let email = response['errors']['email'];
                        let password = response['errors']['password'];
                        if (email !== undefined) {
                            $('#sign-in-email-error').text(email[0]);
                        }
                        if (password !== undefined) {
                            $('#sign-in-password-error').text(password[0]);
                        }
                    } else {
                        window.location.reload(true);
                    }
                }
            })
        }
    });
});
/**
 * log out
 *
 */
$(document).ready(function () {
    $('#logout').click(function (e) {
        e.preventDefault();

        function makeid() {
            let text = "";
            let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for (let i = 0; i < 8; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            return text;
        }

        let data = makeid();
        $.ajax({
            type: "POST",
            url: "/auth/log-out",
            data: {data: data},
            success: function (response) {
                if (response.success === false) {
                    alert('no out');
                } else {
                    window.location = '/site/';
                }
            }
        })
    });
});
/**
 * send forgot password email to forgot function in auth controller
 */
$(document).ready(function () {
    $('#forgot-button').click(function (e) {
        e.preventDefault();
        $(".error-massage").empty();
        let email = $('#forgot-email').val();
        let language = $('#language').text();
        if (email.length === 0) {
            $(this).parent().children('div').children('span').text(userErrorMessages()["empty_email"]);
        } else if (!validateEmail(email)) {
            $(this).parent().children('div').children('span').text(userErrorMessages()["no_email"]);
        } else {
            $('.loading').css('display', 'inline-block');
            $.ajax({
                type: "POST",
                url: "/forgot/forgot",
                data: {email: email},
                success: function (response) {
                    $('.loading').css('display', 'none');
                    if (response.success === false) {
                        if (response['errors']['email'][0].length === 22 && (language === "am/" || language === "")) {
                            $('#forgot-form div span').text('Էլ․հասցե  չի կարող լինել դատարկ');
                        } else {
                            $('#forgot-form div span').text(response['errors']['email'][0]);
                        }
                    } else {
                        $('#forgot').slideUp(500);
                        $('#confirm-password').slideDown(500);
                    }
                }
            })
        }
    })
});
/**
 * send forgot password code to confirm-code function in auth controller
 */
$(document).ready(function () {
    $('#confirm-password > form > button').click(function (e) {
        e.preventDefault();
        $(".error-massage").empty();
        let code = $('#confirm-input').val();
        if (code.length === 0) {
            $('#confirm-input').parent('div').children('span').text(userErrorMessages()['empty_code']);
        } else {
            $('.loading').css('display', 'inline-block');
            $.ajax({
                type: "POST",
                url: '/forgot/confirm-code',
                data: {code: code},
                success: function (response) {
                    $('.loading').css('display', 'none');
                    if (response.success === false) {
                        $('#confirm-input').parent('div').children('span').text(response['errors']['code'][0]);
                    } else {
                        $('#confirm-password').slideUp(500);
                        $('#new-password-table').slideDown(500);
                    }
                }
            })
        }

    })
});
/**
 *  send new password to confirm-new-password function in forgot controller
 */
$(document).ready(function () {
    $('#new-password-table > form > button').click(function (e) {
        e.preventDefault();
        $(".error-massage").empty();
        let new_password = $('#new-password-input').val();
        if (new_password.length === 0) {
            $('#new-password-input').parent('div').children('span').text(userErrorMessages()['empty_user_password']);
        } else if (new_password.length < 8) {
            $('#new-password-input').parent('div').children('span').text(userErrorMessages()['min_password']);
        } else {
            $('.loading').css('display', 'inline-block');
            $.ajax({
                type: "POST",
                url: '/forgot/confirm-new-password',
                data: {new_password: new_password},
                success: function (response) {
                    $('.loading').css('display', 'none');
                    if (response.success === false) {
                        let language = $('#language').text();
                        if (language.length === 0 || language === 'am/') {
                            $('#new-password-input').parent('div').children('span').text(userErrorMessages()['min_password']);
                        } else {
                            $('#new-password-input').parent('div').children('span').text(response['errors']['new_password'][0])
                        }
                    } else {
                        window.location = '/site/index';
                    }
                }
            })
        }
    });
});
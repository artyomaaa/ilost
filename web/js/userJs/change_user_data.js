/**
 * open user form
 */
$(document).on('click', '.change', function () {
    let parent = $(this).parent();
    if (parent.children("input").attr('type') !== "password") {
        parent.children("input").removeAttr("disabled");
        $(this).hide();
        parent.children(".close-input").show();
        parent.children("input").keyup(function () {
            let parent = $(this).parent();
            parent.children(".close-input").hide(100);
            parent.children(".done").show(200);
        })
    }
});
/**
 * close user form input
 */
$(document).on("click", ".close-input", function () {
    let parent = $(this).parent();
    parent.children("input").prop('disabled', true);
    $(this).hide();
    parent.children(".change").show();
});
/**
 * show errors when click done if no error disable input
 */
$(document).on("click", ".done", function () {
    let parent = $(this).parent();
    let data = parent.children("input").val();
    if (data === "") {
        parent.children("span").text(userErrorMessages()['empty_input']);
    } else {
        let parent = $(this).parent();
        parent.children("input").prop('disabled', true);
        $(this).hide();
        parent.children(".change").show();
    }
});
/**
 * open change password table
 */
$(document).on("click", "#password-icon", function () {
    $('.change-password-table').slideDown();
    $('#password-close-input').show(200);
    $('#new_password, #new_password_again, #old_password').keyup(function () {
        validatePass();
    });
});
/**
 * close change password table
 */
$(document).on("click", "#password-close-input, #password-done", function () {
    $('.change-password-table').slideUp(500);
});
/**
 * send data to back
 */
$(document).ready(function () {
    $('#save-user-changes').click(function (e) {
        e.preventDefault();
        $(".error-massage").empty();
        let first_name = $('input[name="first-name"]').val();
        let last_name = $('input[name="last-name"]').val();
        let email = $('input[name="email"]').val();
        let old_password = $('#old_password').val();
        let new_password = $('#new_password').val();
        let number = $('input[name="number"]').val();
        let user_id = $("#user_id").val();
        let messages = userErrorMessages();
        if (first_name.length === 0) {
            $('input[name="first-name"]').parent().children('span').text(messages['empty_first_name'])
        } else if (last_name.length === 0) {
            $('input[name="last-name"]').parent().children('span').text(messages['empty_last_name'])
        } else if (email.length === 0) {
            $('input[name="email"]').parent().children('span').text(messages['empty_email'])
        } else if (!validateEmail(email)) {
            $('input[name="email"]').parent().children('span').text(messages['no_email'])
        } else if (number.length === 0) {
            $('input[name="number"]').parent().children('span').text(messages['empty_contact_number'])
        } else {
            $(this).find('.loading').css('display', 'inline-block');
            let data = {
                first_name: first_name,
                last_name: last_name,
                email: email,
                old_password: old_password,
                new_password: new_password,
                contact_number: number,
                user_id: user_id,
            };
            $.ajax({
                type: "POST",
                url: "/auth/change-user-data",
                data: data,
                success: function (response) {
                    $('.loading').css('display', 'none');
                    if (response.success === false) {
                        if (response['errors']['email'] !== undefined) {
                            $('input[name="email"]').parent().children('span').text(response['errors']['email'][0]);
                        }
                        if (response['errors']['old_password'] !== undefined) {
                            $('.change-password-table').slideDown();
                            $('#password-done').hide(200);
                            $('#password-close-input').show(200);
                            $('#old_password_message').text(response['errors']['old_password'][0]);
                        }
                    } else {
                        if (response['send_email'] === true) {
                            $('.contact-user-error > p').text(errorMessages()['change_email']).css({'color': '#3247a9'});
                            $("#contact_myModal").show();
                        } else {
                            window.location.reload();
                        }
                    }
                }
            })
        }

    });
});
/**
 *Cancel changes in user data
 */
$(document).ready(function () {
    $('#cancel-changes').click(function (e) {
        e.preventDefault();
        $(this).find('.loading').css('display', 'inline-block');
        window.location = '/site/index';
    })
});


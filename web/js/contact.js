/*send data to  user*/
$(document).ready(function () {
    $('#send_contact_data').click(function (e) {
        e.preventDefault();
        $(".contact-error-massage").empty();
        let send_email = $('#send_email').val();
        let send_number = $('#send_number').val();
        let send_text = $('#send_text').val();
        let user_email = $("#user_email").text();
        let language = $('#language').text();
        let empty_email;
        let no_email;
        let empty_number;
        let empty_text;
        if (language === '' || language === 'am/') {
            empty_email = "Էլ․հասցե  չի կարող լինել դատարկ";
            no_email = "Նշվածը Էլ․հասցե չէ";
            empty_number = "Համարը չի կարող լինել դատարկ";
            empty_text = "Տեքստը չի կարող լինել դատարկ";
        } else {
            empty_email = "Email cannot be blank";
            no_email = "This is not an email";
            empty_number = "Number cannot be blank";
            empty_text = "Text cannot be blank";
        }
        if (send_email.trim() === "") {
            $('#send_email').css('border-bottom', '1px solid red');
            $('#send_email_error').text(empty_email);
        } else if (!validateEmail(send_email)) {
            $('#send_email').css('border-bottom', '1px solid red');
            $('#send_email_error').text(no_email);
        } else if (send_number.trim() === "") {
            $('#send_number').css('border-bottom', '1px solid red');
            $('#send_number_error').text(empty_number);
        } else if (send_text.trim() === "") {
            $('#send_text').css('border-bottom', '1px solid red');
            $('#send_text_error').text(empty_text);
        } else {
            $('.loading').css('display', 'inline-block');
            let data = {
                send_email: send_email,
                send_number: send_number,
                send_text: send_text,
                user_email: user_email,
            };
            $.ajax({
                type: "POST",
                url: "/contact/contact-user",
                data: data,
                success: function (response) {
                    let messages = errorMessages();
                    if (response.success === false) {
                        $('#contact').append('<span id="error-message" style="color:red;font-size: 13px">Something goes wrong, please try again</span>');
                        $("#myModal").removeClass("show").hide();
                        $(".modal-backdrop.fade.show").remove();
                        $('.contact-user-error > p').text(messages['contact_user_error']).css({'color': 'red '});
                        $("#contact_myModal").show();
                    } else {
                        $("#myModal").removeClass("show").hide();
                        $(".modal-backdrop.fade.show").remove();
                        $('.contact-user-error > p').text(messages['contact_user_success']).css({'color': '#3247a9'});
                        $("#contact_myModal").show();
                        $("body").css('overflow','hidden');
                        alertBox();
                    }
                    $('.loading').css('display', 'none');
                }
            });
        }
    })
});
/*send data to us*/
$(document).ready(function () {
    $('#send_massage_us').click(function (e) {
        e.preventDefault();
        $(".contact-error-massage").empty();
        let contact_name = $('#contact_name').val();
        let contact_email = $('#contact_email').val();
        let contact_text = $('#contact_text').val();
        let language = $('#language').text();
        let contact_name_error;
        let contact_email_error;
        let no_contact_email_error;
        let contact_text_error;
        if (language === '' || language === 'am/') {
            contact_name_error = "Անունը չի կարող լինել դատարկ";
            contact_email_error = "Էլ․հասցե  չի կարող լինել դատարկ";
            no_contact_email_error = "Նշվածը Էլ․հասցե չէ";
            contact_text_error = "Տեքստը չի կարող լինել դատարկ";
        } else {
            contact_name_error = "Name cannot be blank";
            contact_email_error = "Email cannot be blank";
            no_contact_email_error = "This is not an email";
            contact_text_error = "Text cannot be blank";
        }
        if (contact_name.trim() === "") {
            $('#contact_name').css('border-bottom', '1px solid red');
            $('#contact_name_error').text(contact_name_error);
        } else if (contact_email.trim() === "") {
            $('#contact_name').css('border-bottom', '1px solid red');
            $('#contact_email_error').text(contact_email_error);
        } else if (!validateEmail(contact_email)) {
            $('#contact_email').css('border-bottom', '1px solid red');
            $('#contact_email_error').text(no_contact_email_error);
        } else if (contact_text.trim() === "") {
            $('#contact_text').css('border-bottom', '1px solid red');
            $('#contact_text_error').text(contact_text_error);
        } else {
            $('.loading').css('display', 'inline-block');
            let data = {
                contact_name: contact_name,
                contact_email: contact_email,
                contact_text: contact_text,
            };
            $.ajax({
                type: "POST",
                url: "/contact/contact-us",
                data: data,

                success: function (response) {
                    let messages = errorMessages();
                    if (response.success === false) {
                        $('#contact-table').append('<span id="error-message" style="color:red;font-size: 13px">Something goes wrong, please try again</span>')
                        $('.contact-user-error > p').text(messages['contact_user_error']).css('color', 'red ');
                        $("#contact_myModal").show();
                        $("body").css('overflow','hidden');
                    } else {
                        $('.contact-user-error > p').text(messages['contact_user_success']).css({'color': '#3247a9'});
                        $("#contact_myModal").show();
                        $("body").css('overflow','hidden');
                        alertBox();
                    }
                    $('.loading').css('display', 'none');
                }
            });

        }

    });
});
/*close contact modal message*/
$(document).on('click', '#close-contact', function f() {
    window.location.reload();
});











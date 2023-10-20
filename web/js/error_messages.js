/**
 *
 * @returns {{contact_user_error: string, contact_user_success: string, sign_up_message: string, equal: string, not_equal: string}}
 */
function errorMessages() {
    let language = $('#language').text();
    let messages = {
        contact_user_error: '',
        contact_user_success: '',
        sign_up_message: '',
        equal: '',
        not_equal: '',
        change_email:'',

    };
    if (language === '' || language === 'am/') {
        messages['contact_user_error'] = 'Ինչ-որ բան այն չէ, խնդրում ենք փորձել մի փոքր ուշ։';
        messages['contact_user_success'] = 'Ձեր նամակը հաջողությամբ ուղարկվել է։';
        messages['sign_up_message'] = 'Շնորհակալություն !\n' +
            'Մենք ձեզ ուղարկեցինք հաստատման նամակ `ձեր հաշիվը ակտիվացնելու համար:\n' +
            'Խնդրում ենք ստուգել ձեր էլ.փոստը եւ սեղմել հղումը:';
        messages['equal'] = "Գաղտնաբառերը համնկնում են";
        messages['not_equal'] = "Գաղտնաբառերը չեն համնկնում";
        messages['change_email'] = 'Մենք ձեզ ուղարկեցինք հաստատման նամակ `ձեր էլ.փոստը փոխելու համար:\n' +
            'Խնդրում ենք ստուգել ձեր էլ.փոստը եւ հաստատել:';

    } else {
        messages['contact_user_error'] = 'Something went wrong, pleas try again later.';
        messages['contact_user_success'] = "The message has been sent successfully.";
        messages['sign_up_message'] = ' Thank You !\n' +
            'We sent you a confirmation email with a link to activate your account.\n' +
            'Please check your email and click the link.';
        messages['equal'] = 'Passwords match';
        messages['not_equal'] = 'Passwords do not match';
        messages['change_email'] = 'We sent you a confirmation email to change your email address.\n' +
            'Please check your email and confirm.';

    }
    return messages;
}

/**
 * statement save error messages
 * @returns {{title_message: string, contact_message: string, category_message: string, text_message: string}}
 */
function statementErrorMessage() {
    let language = $('#language').text();
    let messages = {
        title_message: '',
        contact_message: '',
        category_message: '',
        text_message: '',
    };
    if (language === '' || language === 'am/') {
        messages['title_message'] = 'Վերնագիրը չի կարող լինել դատարկ';
        messages['contact_message'] = 'Պարտադիր';
        messages['category_message'] = 'Պարտադիր';
        messages['text_message'] = 'Տեքստը չի կարող լինել դատարկ';
    } else {
        messages['title_message'] = 'Title name cannot be blank';
        messages['contact_message'] = 'required';
        messages['category_message'] = 'required';
        messages['text_message'] = 'Text cannot be blank';
    }
    return messages

}

/**
 *
 * @returns {{empty_first_name: string, empty_last_name: string, empty_email: string, no_email: string, empty_user_password: string, empty_contact_number: string, empty_input: string, empty_old_password: string, empty_new_password: string, min_password: string, empty_code: string}}
 */
function userErrorMessages() {
    let language = $('#language').text();
    let messages = {
        empty_first_name: '',
        empty_last_name: '',
        empty_email: '',
        no_email: '',
        empty_user_password: '',
        empty_contact_number: '',
        empty_input: '',
        empty_old_password: '',
        empty_new_password: '',
        min_password: '',
        empty_code:'',
    };
    if (language === '' || language === 'am/') {
        messages['empty_first_name'] = "Անունը չի կարող լինել դատարկ";
        messages['empty_last_name'] = "Ազգանունը չի կարող լինել դատարկ";
        messages['empty_email'] = "Էլ․հասցե  չի կարող լինել դատարկ";
        messages['no_email'] = "Նշվածը Էլ․հասցե չէ";
        messages['empty_user_password'] = "Գաղտնաբառը չի կարող լինել դատարկ";
        messages['empty_contact_number'] = "Համարը չի կարող լինել դատարկ";
        messages['empty_input'] = 'Լրացնել տվյալները';
        messages['empty_old_password'] = 'Լրացնել ընթացիկ գաղտնաբառը';
        messages['empty_new_password'] = 'Լրացնել նոր գաղտնաբառը';
        messages['min_password'] = 'Չափազանց կարճ է:Գաղտնաբառը պետք է լինի 8 նիշ և ավելի։';
        messages['empty_code'] = 'Կոդը չի կարող լինել դատարկ';
    } else {
        messages['empty_first_name'] = "First name cannot be blank";
        messages['empty_last_name'] = "Last name cannot be blank";
        messages['empty_email'] = "Email cannot be blank";
        messages['no_email'] = "This is not an email";
        messages['empty_user_password'] = "Password cannot be blank";
        messages['empty_contact_number'] = "Number cannot be blank";
        messages['empty_input'] = 'Complete the data';
        messages['empty_old_password'] = 'Complete current password';
        messages['empty_new_password'] = 'Complete new password';
        messages['min_password'] = 'Too short.Password must be 8 characters or more.';
        messages['empty_code'] = 'Code cannot be blank';
    }
    return messages;
}

/**
 * function password validate
 */
function validatePass() {
    let new_password = $('#new_password').val();
    let new_password_again = $('#new_password_again').val();
    let old_password = $('#old_password').val();
    if (new_password.length === 0 && new_password_again.length === 0) {
        $('#equal_password').text("");
    } else if (new_password === new_password_again) {
        $('#equal_password').text(errorMessages()["equal"]).css('color', 'forestgreen');
        if (old_password.length === 0) {
            $('#old_password_message').text(userErrorMessages()['empty_old_password']);
            $('#password-close-input').show(200);
            $('#password-done').hide(200)
        } else {
            $('#password-close-input').hide(200);
            $('#password-done').show(200)
        }
    } else {
        $('#equal_password').text(errorMessages()["not_equal"]).css('color', 'red');
        $('#password-close-input').show(200);
        $('#password-done').hide(200)
    }
}
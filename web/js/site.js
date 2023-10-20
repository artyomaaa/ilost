/**
 * cancel statement change
 */

$(document).ready(function () {
    $('#cancel').click(function () {
        function makeid() {
            let text = "";
            let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for (let i = 0; i < 8; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }

        let cancel = (makeid());
        let data = {cancel: cancel};
        $.ajax({
            type: "POST",
            url: "/post/cancel",
            data: data,
            success: function (response) {
                if (response.success === false) {
                    alert('error');
                } else {
                    window.location = '/user/my-items';
                }
            }
        })
    });
});


/**
 * sort statements
 */
$(document).on('click', '#no-selected', function () {
    $('#span-selected').text('old files');
});

/**
 * selectbox
 */


$(document).on('click', '#no-selected', function () {
    let old = $('#old').text();
    $.ajax({
        type: "POST",
        url: "/site/lost",
        data: {old: old},
        success: function (response) {

        }
    })


});
/**
 *
 */
$(document).on('click', '#selected', function () {
    $('#span-selected').text('new files');
});
/**
 *
 */
$('.form').find('input, textarea').on('keyup blur focus', function (e) {

    var $this = $(this),
        label = $this.prev('label');

    if (e.type === 'keyup') {
        if ($this.val() === '') {
            label.removeClass('active highlight');
        } else {
            label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
        if ($this.val() === '') {
            label.removeClass('active highlight');
        } else {
            label.removeClass('highlight');
        }
    } else if (e.type === 'focus') {

        if ($this.val() === '') {
            label.removeClass('highlight');
        }
        else if ($this.val() !== '') {
            label.addClass('highlight');
        }
    }

});

$('.tab a').on('click', function (e) {

    e.preventDefault();

    $(this).parent().addClass('active');
    $(this).parent().siblings().removeClass('active');

    target = $(this).attr('href');

    $('.tab-content > div').not(target).hide();

    $(target).fadeIn(600);

});

/*login sign up modal*/
/*open modal*/
$(document).on("click", "#open-login-modal", function () {
    $("#login-modal").show();
    $("#body").css(
        "overflow", "hidden"
    );
    $('.welcome_area').css('z-index', '0')
});

/*close modal*/
$(document).on("click", "#close-login", function () {
    $("#login-modal").hide();
    $("#body").css(
        "overflow", "auto"
    );
    $('.welcome_area').css('z-index', '1')

});
/*language*/
$(document).ready(function () {
    $('.option').click(function () {
        let language = $(this).attr('data-value');
        if (language === 'english') {
            $.ajax({
                type: "POST",
                url: "/site/language",
                data: {language: language},
                success: function (response) {
                    if (response.success === false) {
                        alert("error");
                    } else {
                        window.location.reload();
                    }
                }
            })
        } else {
            $.ajax({
                type: "POST",
                url: "/site/language",
                data: {language: language},
                success: function (response) {
                    if (response.success === false) {
                        alert("error");
                    } else {
                        window.location.reload();
                    }
                }
            })
        }

    })
});
$(document).ready(function () {
    var th = $(".animated-image");
    if ($(window).width() < 481) {
        $(th).animate({
            "top": "30%"
        }, 3000);
    } else {

        $(th).animate({
            "top": "5%"
        }, 3000);
    }
});
$(document).on('mouseenter', '.cn-dropdown-item', function () {
    $('.fa-angle-down').hide();
    $('.fa-angle-up').show();
});
$(document).on('mouseleave', '.cn-dropdown-item', function () {
    $('.fa-angle-up').hide();
    $('.fa-angle-down').show();
});
$(document).on('click', '.cn-dropdown-item-footer', function () {
    $('.cn-dropdown-item-footer').addClass('open');
    $('.fa-angle-down').hide();
    $('.fa-angle-up').show();
    $('.dropdown-content-footer').show();
});
$(document).on('click', '.cn-dropdown-item-footer.open', function (e) {
    e.stopPropagation();
    $('.cn-dropdown-item-footer.open').removeClass('open');
    $('.fa-angle-up').hide();
    $('.fa-angle-down').show();
    $('.dropdown-content-footer').hide();

});
$(document).on('click', '.favourite-area', function () {
    if ($(window).width() < 481) {
        $('.dropdown-content').show();
        $('.favourite-area').addClass('open');
    }
});
$(document).on('click', '.favourite-area.open', function () {
    if ($(window).width() < 481) {
        $('.dropdown-content').hide();
        $('.favourite-area.open').removeClass('open');
    }
});
/**
 * alert box
 */
function alertBox() {
    $(document).on('click','body',function (evt) {
        if ($(evt.target).closest('#modal_box').length > 0)
            return false;
        $('#close-contact').css({'border': '1.5px solid #ff0000d4'});
    })
}
/**
 *forgot password display block
 * signup display hide
 */
$(document).on('click', '#forgot-modal-open', function (e) {
    e.preventDefault();
   $('#signup').slideUp(500);
   $('#forgot').slideDown(500);
});
/**
 * sigup display show
 * forgot display hide
 */
$(document).on('click', '#forgot-to-login', function (e) {
    e.preventDefault();
    $('#forgot').slideUp(500);
    $('#signup').slideDown(500);
});


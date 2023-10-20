/* popups*/


$(document).on("click", "#myBtn", function () {
    $("#myModalPopup").show();
    $("#body").css(
        "overflow", "hidden"
    )
});


$(document).on("click", ".close-popup", function () {
    $("#myModalPopup").hide();
    $(".verify_modal").hide();
    $("#body").css(
        "overflow", "auto"
    )
});



/* form data input*/

$(document).ready(function () {


    $('.datetimepicker').datetimepicker({
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        }
    });
});

function validateEmail(email) {
    let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}







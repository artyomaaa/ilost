/*edit popup*/

$(document).on("click", "#edit", function () {
    $(".modal-popup-edit").show();
    $("#body").css(
        "overflow", "hidden"
    )
});

$(document).on("click", ".close-popup", function () {
    $(".modal-popup-edit").hide();
    $("#body").css(
        "overflow", "auto"
    )

});


/*send id*/
$(document).ready(function () {
    $("#send-password").on("click", "#id", function (e) {
        e.preventDefault();
        let data = $("#send-password").serializeArray();


        console.log(data);

        if (data[0]['value'] === "") {
            alert("invalid value");
        }
        else {
            $.ajax({
                type: "POST",
                url: "/site/edit-lost",
                data: data,
                // cache: false,


                success: function (response) {
                    if (response.success === false) {

                        $('#password').val('').attr('placeholder', 'Wrong password').css({
                            "border-bottom": "2px dashed red",


                        });
                        $(document).on('click', '#password', function () {
                            $(this).attr('placeholder', 'Password...').css({
                                "border": "none",

                            })
                        })

                    } else {

                        window.location = '/site/index';
                    }
                }


            });
        }
    });
});

/*change statement */
// $(document).ready(function () {
//     $("#form").on("click", "#edit", function (e) {
//         e.preventDefault();
//         let data =$("#form").serializeArray() ;
//         let id = $('#edit-id').attr("class");
//         let x = {name:"id",value:id};
//         data[11] = x;
//         console.log(data);
//         if (data[0]['value'] === "") {
//             alert("invalid value");
//         }
//         else {
//             $.ajax({
//                 type: "POST",
//                 url: "/post/change",
//                 data: data,
//                 cache: false,
//                 success: function (response) {
//                     if (response.success === false) {
//                         alert("error");
//                     } else {
//                         if (data[8]['value'] === "lost") {
//                             window.location = '/site/lost';
//                         } else {
//                             window.location = '/site/find';
//                         }
//
//                     }
//                 }
//
//
//             });
//         }
//     });
// });
/*delete modal open*/
$(document).on('click', '#delete-item', function () {
    let lost_id = $(this).attr('data-id');
    let lost_contact = $('#lost_contact_' + lost_id).text();
    // console.log(lost_contact );
    if (lost_contact === 'lost') {
        $('#item-id').attr('href', '/post/delete-lost?id=' + lost_id + '&contact=lost');
    } else {
        $('#item-id').attr('href', '/post/delete-lost?id=' + lost_id + '&contact=find');
    }

    // $('#item-contact').text(lost_contact);

});

/*delete image*/
$(document).on('click', '#image_name', function () {
    let image_name = $(this).attr('data-id');
    // let edit_id = $('#edit-id').val();

    $('#item-image').text(image_name);
    console.log(image_name);
});
/*send image name to controler*/
$(document).ready(function () {
    $('#delete_image').click(function () {
        let image_name = $('#item-image').text();
        let edit_id = $('#edit-id').val();
        let image_contact = $('#image_contact').text();
        let data = {
            edit_id: edit_id,
            image_name: image_name,
            image_contact: image_contact
        };
        $.ajax({
            type: "POST",
            url: "/post/delete-images",
            data: data,
            success: function (response) {
                if (response.success === false) {
                    alert('error');
                } else {
                    window.location = '/site/index';
                }
            }
        });
    });
});


$(function(){
    $('.selectpicker').selectpicker();
});
/*image upload*/
$(document).on('change', "#statement-file", function (evt) {
    let files = evt.target.files;
    let files_length = files['length'];
    for (let i = 0; i < files_length; i++) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let active =!$.trim( $('#active').html() ).length ;
            $('.carousel-inner').append(
                '<div class="carousel-item">\n' +
                '<img src="' + e.target['result'] + '" alt="">\n' +
                '<span title="Delete image" class="close-image" id="close-this-image" >&times;</span>\n' +
                '</div>',
            );
            if (active === true){
                $('.carousel-inner > div').first().addClass('active');
            }
            if (!$.trim( $('#active > div:nth-child(2)').html() ).length === false){
                $('.carousel-control-prev, .carousel-control-next').show();
            }
        };
        reader.readAsDataURL(this.files[i])
    }
});
/*hide carousel control*/
$(document).ready(function () {
    let active =!$.trim( $('#active').html() ).length ;
    if (active === true){
        $('.carousel-control-prev, .carousel-control-next').hide();
    }
});
/*close image*/
$(document).on('click','#close-this-image', function () {
    $('.active').remove();
    $('.carousel-inner > div').first().addClass('active');
    if (!$.trim( $('#active > div:nth-child(2)').html() ).length === true){
        $('.carousel-control-prev, .carousel-control-next').hide();
    }
});


/*save statement*/
$(document).ready(function () {
    $('#submit').click(function () {
        $('.error-massage').empty();
        let statement = $('#statement-form').serializeArray();
        let image_data_array = [];
        $('.carousel-item > img').each(function () {
            let image_data = this.src;
            image_data_array.push(image_data);
        });
        let messages = statementErrorMessage();
        if (statement[3]['value'] === '') {
            $('#title_message').text(messages['title_message'])
        } else if (statement[4]['name'] !== 'contact') {
            $('#contact_message').text(messages['contact_message'])
        } else if (statement[5]['name'] !== 'category') {
            $('#category_message').text(messages['category_message'])
        } else if (statement[7]['value'] === '') {
            $('#text_message').text(messages['text_message'])
        } else {
            let data = $('#statement-form').serialize() + "&" + $.param({image_data_array});
            $('.loading').css('display', 'inline-block');
            $.ajax({
                type: "post",
                url: "/post/statement-save",
                data: data,
                success:function (response) {
                    if (response.success === false){
                        console.log(response[0]);
                    } else {
                        if (response[0]['contact'] === 'lost'){
                            window.location = '/site/lost'
                        } else {
                            window.location = '/site/find'
                        }
                    }
                    $('.loading').css('display', 'none');
                }
            })
        }
    });
});
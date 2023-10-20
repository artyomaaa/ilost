$(document).ready(function () {
    $('#search-table').keypress(function (e) {
        if (e.which === 13) {
            let search_value = $('#search-table').val();
            $.ajax({
                url: "https://translate.yandex.net/api/v1.5/tr.json/detect?key=trnsl.1.1.20180927T135538Z.d3d13645fa578ea4.c4e9af9d1bad7be879e604f3eb03978473c885dc&text=" + search_value,
                type: "POST",
                dataType: "json",
                success: function (data) {
                    let language = "";
                    if (data['lang'] === 'hy'){
                        language = "en"
                    } else {
                        language = "hy"
                    }
                    $.ajax({
                        url: "https://translate.yandex.net/api/v1.5/tr.json/translate?lang=" + language + "&key=trnsl.1.1.20180927T135538Z.d3d13645fa578ea4.c4e9af9d1bad7be879e604f3eb03978473c885dc&text=" + search_value,
                        type: "POST",
                        dataType: "json",
                        success: function (data) {
                            console.log(data['text']);
                            $.ajax({
                                type: "POST",
                                url: "/post/search",
                                data: {
                                    0:search_value,
                                    1:data['text'][0]
                                },
                                success: function (response) {
                                    if (response.success === false) {
                                        alert('error');
                                    } else {
                                        window.location = '/site/search';
                                    }
                                }
                            });
                        },
                    });
                },
            });
        }
    });
});

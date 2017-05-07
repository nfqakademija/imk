$(document).ready(function () {
    $("#search").on('keyup', function () {
        var key = $(this).val();
        console.log(key);
        $("#result").empty();
        $.ajax({
            url: '/search',
            type: 'GET',
            data: 'tag=' + key,
            beforeSend: function () {
                //$("#result").slideUp('fast');
            },
            success: function (data) {

                data.forEach(function (item) {

                    var option = document.createElement('option');
                    option.value = item;
                    $("#result").append(option);
                });
                //$("#result").html(data);
                //$("#result").slideDown('fast');
                console.log(data);
            }
        });
    });
});
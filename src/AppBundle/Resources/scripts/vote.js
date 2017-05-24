$("label > img").click(function () {
    var optionId = $(this).parent().attr("for").match(/\d+/).pop();
    var pollId = $(this).prev().attr("name").match(/\d+/).pop();
    var optionContainer = $(this).parent();
    var voteCountElement = $(optionContainer).
      children(':first-child').
      children(':first-child').
      children('span:first-of-type');

    post_data = {
        'optionId':optionId,
        'pollId':pollId
    };
    console.log(post_data);

  $.post('/vote', post_data, function(data) {
        console.log(data);
        if (data.success){
            $(voteCountElement).text(data.voteCount);
        } else {
            console.log(data.error);
            if ($("#vote_error_"+optionId).length == 0) {
                var errorMsg = jQuery('<div/>', {
                        id: 'vote_error_'+optionId,
                        class: 'alert alert-danger',
                        text: data.error
                    }
                ).hide();
                errorMsg.appendTo(optionContainer);
                errorMsg.slideDown('fast');
                setTimeout(function () {
                    $("#vote_error_"+optionId).slideUp('fast', function () {
                        $("#vote_error_"+optionId).remove();
                    });
                }, 1000);
            }
        }

    }).fail(function (err) {

    });
});

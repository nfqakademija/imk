$("label > img").click(function () {
    var optionId = $(this).parent().attr("for").match(/\d+/).pop();
    var optionContainer = $(this).parent();
  var voteCountElement = $(optionContainer).
      children(':first-child').
      children(':first-child').
      children('span:first-of-type');

    post_data = {
        'optionId':optionId
    };

  $.post('/vote', post_data, function(data) {
        if (data.success){
            $(voteCountElement).text(data.voteCount);
        } else {
            console.log(data.error);
            if ($("#vote_error_"+optionId).length == 0) {
                jQuery('<div/>', {
                        id: 'vote_error_'+optionId,
                        text: data.error
                    }
                ).appendTo(optionContainer);
                setTimeout(function () {
                    $("#vote_error_"+optionId).remove();
                }, 1000);
            }
        }

    }).fail(function (err) {

    });
});

$( document ).ready(function() {
    let check = 0;
    $('.answer').click(function (event) {
        $("input[name = '_method']").attr('value', 'POST');
        $('form').attr('action', 'http://forum/forum/comment');
        $('#post_id_answer').attr('value', $(event.target).attr('value'));
        var destination = $(form).offset().top;
        $('html').animate( {
            scrollTop: destination
        }, 1100);
        $('#send').html('Ответить');
        $('#cancelAnswer').attr('hidden', false);
        $('#comment').html('');
        $('#cancelEditing').attr('hidden', true);
    });

    $('.edit').click(function (event) {
        $('#post_id_answer').attr('value', 0);
        $('#post_id_answer').attr('value', ((($(event.target).parents('li')).siblings('#answerPost')).val()));
        $('form').attr('action', 'http://forum/forum/comment/'+$(event.target).attr('value'));
        $("input[name = '_method']").attr('value', 'PATCH');
        var destination = $(form).offset().top;
        $('html').animate( {
            scrollTop: destination
        }, 1100);
        $('#cancelEditing').attr('hidden', false);
        $('#send').html('Отредактировать');
        $('#comment').html($(event.target).parents('li').siblings().children('#commentContent').text());
        $('#cancelAnswer').attr('hidden', true);
    });

    $('#cancelEditing').click(function () {
        $('form').attr('action', 'http://forum/forum/comment');
        $("input[name = '_method']").attr('value', 'POST');
        $('#cancelEditing').attr('hidden', true);
        $('#send').html('Отправить');
        $('#post_id_answer').attr('value', 0);
        $('#comment').html('');
    });

    $('#cancelAnswer').click(function () {
        $('#send').html('Отправить');
        $('#post_id_answer').attr('value', 0);
        $('#cancelAnswer').attr('hidden', true);
    });

});

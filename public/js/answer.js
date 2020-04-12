$( document ).ready(function() {
    let check = 0;
    $('.answer').click(function (event) {
        $("input[name = '_method']").attr('value', 'POST');
        $('form').attr('action', 'http://forum/forum/comment');
        $('#post_id_answer').attr('value', $(event.target).attr('value'));
        var destination = $(form).offset().top;
        $('html').animate({scrollTop: destination}, 1100);
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
        $('html').animate({scrollTop: destination}, 1100);
        $('#cancelEditing').attr('hidden', false);
        $('#send').html('Отредактировать');
        $('#comment').html((($(event.target).parents('li')).siblings('#commentContent')).html());
        $('#cancelAnswer').attr('hidden', true);
    });

    $('#cancelEditing').click(function () {
        $('form').attr('action', 'http://forum/forum/comment');
        $("input[name = '_method']").attr('value', 'POST');
        $('#cancelEditing').attr('hidden', true);
        $('#post_id_answer').attr('value', 0);
        $('#comment').html('');
    });

    $('#cancelAnswer').click(function () {
        $('#send').html('Отправить');
        $('#post_id_answer').attr('value', 0);
        $('#cancelAnswer').attr('hidden', true);
    });

});

// window.onload = function () {
//     let answer = document.getElementsByName('answer');
//     let editing = document.getElementsByName('edit');
//     let postAnswer = document.getElementById('post_id_answer');
//     let send = document.getElementById('send');
//     let cancelAnswer = document.getElementById('cancelAnswer');
//     let cancelEditing = document.getElementById('cancelEditing');
//     let form = document.getElementsByName('form');
//     let deleteComment = document.getElementsByName('delete');
//
//     for (let button of answer) {
//         button.addEventListener('click', function (event) {
//             postAnswer.setAttribute('value', button.value);
//             cancelAnswer.scrollIntoView({block: "center", behavior: "smooth"});
//             cancelAnswer.hidden = false;
//             send.innerHTML = 'Оветить';
//         })
//     }
//
//     for (let button of deleteComment) {
//         button.addEventListener('click', function (event) {
//             confirm('вы действительно хотите удалть свой комментарий ?');
//
//         })
//     }
//
//     for (let button of editing) {
//         button.addEventListener('click', function (event) {
//             form.setAttribute('value', 'dfgsdf');
//         })
//     }
//
//     cancelEditing.onclick = function() {
//         postAnswer.setAttribute('value', '');
//         send.innerHTML = 'Редактировать';
//         cancelAnswer.hidden = true;
//     };
//
//     cancelAnswer.onclick = function() {
//         postAnswer.setAttribute('value', '');
//         send.innerHTML = 'Отправить';
//         cancelAnswer.hidden = true;
//     };
// };

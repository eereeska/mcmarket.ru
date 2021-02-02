$(document).on('input', '.forum .comment__body--editable', function(e) {
    var $input = $(this);
    var $avatar = $input.parent().parent().find('.avatar').clone(false);

    var text = $input.text().trim();
    var html = $input.html().trim();
    var rows = [];

    if (text.length) {
        console.log('html befotre', html)

        // html = html.replace(/\<(.*?)\>(.*?)\<\/(.*?)\>/gi, '</p>$2<p>');
        // html = html.replace(/\*\*(.*?)\*\*/gi, '<b>$1</b>');

        // html = '<p>' + html + '</p>';

        // console.log('html after', html)

        // $(this).children().each(function() {
        //     rows.push($(this).text());
        // });

        // alert(text)

        if ($('#replies .comment_preview').length > 0) {
            $('#replies .comment_preview .comment__body').html(text);
        } else {
            var $preview = $('<div class="comment comment_preview"></div>');

            $preview.html(`
                <div class="avatar" style="${$avatar.attr('style')}"></div>
                <div class="comment__info">
                <h3 class="comment__label">Предпросмотр</h3>
                <div class="comment__body">${text}</div>`);

            $('#replies').append($preview);
        }
    } else {
        $('#replies .comment_preview').remove();
    }
});
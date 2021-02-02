// $(document).on('focusout cut', '[contenteditable]', function() {
//     if (!$(this).text().trim().length) {
//         $(this).empty();
//     }
// });

$(document).on('paste', '[contenteditable]', function(e) {
    e.preventDefault();
    document.execCommand('inserttext', false, e.originalEvent.clipboardData.getData('text/plain'));
});
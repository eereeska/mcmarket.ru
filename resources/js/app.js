window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const $ = require('jquery');

$('.tags a.tag').on('click', function(e) {
    e.preventDefault();

    $(this).hasClass('selected') ? $(this).removeClass('selected') : $(this).addClass('selected');
});

$('[data-action="form-submit"]').on('click', function(e) {
    e.preventDefault();

    $($(this).data('target')).trigger('submit');
});

// DROPDOWN

$('.dropdown > .dropdown__title').on('click', function(e) {
    e.preventDefault();

    $(this).parent().toggleClass('active');
});

$(document).on('mouseup', function(e){
    var container = $('.dropdown');
 
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.removeClass('active');
    }
});

// DROPDOWN END

$('div.rich-editor__toolbar > div').on('mousedown', function(e) {
    e.preventDefault();

    var selection = false;

    if (window.getSelection) {
        selection = window.getSelection();
    } else if (document.getSelection) {
        selection = document.getSelection();
    }

    if (selection && selection.rangeCount > 0) {
        const range = selection.getRangeAt(0);
        const rect = range.getBoundingClientRect();

        console.log(range);

        // const $selected = $(range.startContainer.parentElement);

        const $container = document.createElement('strong');

        $container.appendChild(range.extractContents());

        console.log(typeof $container);

        range.insertNode($container);

        // console.log($selected);

        // $selected.html($selected.html().replace(selection.toString(), '<strong>' + selection.toString() + '</strong>'))
    } else [
        console.log('not selected')
    ]
});
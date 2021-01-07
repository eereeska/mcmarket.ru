window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const $ = require('jquery');

$('.tags .tag').on('click', function(e) {
    e.preventDefault();
    $(this).toggleClass('active');
});

$('[data-action="form-submit"]').on('click', function(e) {
    e.preventDefault();

    var $clicked = $(this);

    $clicked.addClass('loading');

    var $form = $($(this).data('target'));

    if (!$form.length) {
        return;
    }

    var data = new FormData();

    $form.find(':input:not(button)').each(function() {
        data.append($(this).attr('name'), $(this).val());
    });

    $form.find('.tags > .tag.active').each(function() {
        data.append('tags[]', $(this).attr('class').replace('tag', '').replace('active', '').trim());
    });

    $form.find('.editor__content').each(function() {
        data.append($(this).attr('name'), $(this).html().replace(/<div(.*?)>([\w\W]*?)<\/div>/gi, '<p>$2</p>').trim());
    });

    axios.post($form.attr('action'), data).then(function(response) {
        if (response.data.success) {
            window.location = response.data.redirect;
        } else {
            alert(response.data.message);
        }

        $clicked.removeClass('loading');
    });
});

// AJAX PAGE CHANGE

// $(document).on('click', 'a[data-ajax]', function(e) {
//     e.preventDefault();

//     axios.get($(this).attr('href')).then(function(response) {
//         if (response.data.success) {
//             $('#root').html(response.data.html);
//         } else {
//             alert(response.data.message);
//         }
//     });
// });

// AJAX PAGE CHANGE END

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
const { default: axios } = require('axios');

window.$ = window.jQuery = require('jquery/dist/jquery.slim');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

require('./rte');
require('./forum');
require('./modal');

var messages = {
    requestError: 'Произошла ошибка при обработке запроса. Попробуйте позже.'
}

$(document).on('input', 'textarea.auto-resize', function() {
    $(this).css('height', $(this).[0].scrollHeight + 10);
});

$(document).on('change', 'form[data-action="search"] input, form[data-action="search"] select', function(e) {
    var $form = $(this).closest('form[data-action="search"]');

    if (!$form.length) {
        return;
    }

    var $result = $($form.data('result'));

    if (!$result) {
        return;
    }

    $result.addClass('loading');

    axios.post($form.attr('action'), $form.serialize()).then(function(response) {
        if (response.data.success) {
            $result.html(response.data.html);
            // window.history.pushState({
            //     html: response.data.html,
            //     pageTitle: 'title'
            // }, "title", $form.attr('action') + '&' + $form.serialize());
        } else {
            alert(response.data.message);
        }
    }).catch(function() {
        alert(messages.requestError);
    }).finally(function() {
        $result.removeClass('loading');
    });
});

$('[data-action="form-submit"]').on('click', function(e) {
    e.preventDefault();

    var $clicked = $(this);

    $clicked.addClass('loading');

    var $form = $($(this).data('target'));

    if (!$form.length) {
        return;
    }

    $form.trigger('submit');
    return;

    axios.post($form.attr('action'), $form.serialize()).then(function(response) {
        if (response.data.success) {
            if ($form.data('redirect')) {
                window.location = response.data.redirect;
            } else {
                setTimeout(function() {
                    $clicked.removeClass('success');
                    $clicked.text($clicked.text());
                }, 2000);

                $clicked.addClass('success');
            }
        } else {
            alert(response.data.message);
        }

        $clicked.removeClass('loading');
    }).catch(function(error) {
        alert(messages.requestError);
    });
});

$('[data-action="request"]').on('click', function(e) {
    e.preventDefault();

    var $clicked = $(this);

    $clicked.addClass('loading');

    if (!$clicked.data('url')) {
        return;
    }

    axios({
        method: $clicked.data('method') || 'post',
        url: $clicked.data('url')
    }).then(function(response) {
        if (response.data.success) {
            setTimeout(function() {
                $clicked.removeClass('success');
                $clicked.text($clicked.text());
            }, 2000);

            $clicked.addClass('success');
        } else {
            alert(response.data.message || messages.requestError);
        }
    }).catch(function() {
        alert(messages.requestError);
    }).finally(function() {
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

$(document).on('click', '.dropdown > .dropdown__title', function(e) {
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

// SELECT

$(document).on('click', '.select__trigger', function(e) {
    e.preventDefault();

    var $trigger = $(this);

    if ($trigger.find('.select__label').length) {
        $trigger.closest('.select').find('.select__options').css('left', $trigger.find('.select__label').outerWidth() + 10 - 24);
    } else {
        $trigger.closest('.select').find('.select__options').removeAttr('style');
    }

    $(this).closest('.select').toggleClass('select--open');
});

$(document).on('click', '.select__option', function(e) {
    e.preventDefault();

    var $option = $(this);

    $option.closest('.select').removeClass('select--open');

    if ($option.hasClass('select__option--selected')) {
        return;
    }

    $option.siblings('.select__option').each(function() {
        $(this).removeClass('select__option--selected');
    });

    $option.addClass('select__option--selected');
    $option.closest('.select').find('.select__selected').text($option.text().trim());
    $option.closest('.select').find('.select__original').val($option.data('value'));
    $option.closest('.select').find('.select__original').trigger('change');
});

$(document).on('mouseup', function(e) {
    var container = $('.select');
 
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.removeClass('select--open');
    }
});

// SELECT END

// TABS

$('.tabs > .tabs__tab').each(function() {
    if ($(this).hasClass('active')) {
        $($(this).attr('href')).addClass('active-tab');
    }
});

$(document).on('click', '.tabs > .tabs__tab', function(e) {
    e.preventDefault();

    $(this).siblings('.active').each(function() {
        $(this).removeClass('active');
    });

    if ($(this).hasClass('active')) {
        return;
    }

    $(this).addClass('active');

    $(this).parent().next('.tabs__content').find('> *').each(function() {
        $(this).removeClass('active-tab');
    });

    $($(this).attr('href')).addClass('active-tab');
})

// TABS END

// DRAG AND DROP

$(document).on('dragenter focus click', '.file > .file__original', function() {
    $(this).parent().addClass('is-dragenter');
});

$(document).on('dragleave blur drop', '.file > .file__original', function(e) {
    $(this).parent().removeClass('is-dragenter');

    if ($(this).hasClass('is-uploading')) {
        e.preventDefault();
        e.stopImmediatePropagation();
    }
});

$(document).on('change', '.file > .file__original', function() {
    var $container = $(this).parent('.file');
    var $label = $(this).next('.file__label');

    if (!$label.data('original-label')) {
        $label.data('original-label', $label.text().trim());
    }

    var files = $(this).prop('files');

    if ($(this).attr('multiple') && files.length > 0) {
        $label.text('Выбрано ' + files.length + ' файл(-а, -ов)');
    } else if (files.length > 0) {
        $label.text(files[0].name);
    } else {
        $label.text($label.data('original-label'));
    }

    if ($(this).data('upload-path')) {
        var data = new FormData();

        data.append($(this).attr('name'), files[0]);

        $container.addClass('is-uploading');
        
        axios.post($(this).data('upload-path'), data).then(function(response) {
            if (response.data.success) {
                if ($container.data('image-preview')) {
                    $($container.data('image-preview')).removeAttr('style').css('background-image', 'url(' + response.data.path + ')')
                }
            } else {
                alert(response.data.message || messages.requestError);
            }
        }).catch(function(error) {
            console.log(error)
        }).finally(function() {
            $container.removeClass('is-uploading');
        });
    }

    console.log(files)
});

// DRAG AND DROP END

// HIDDEN CONTENT

$(document).on('click', 'input[type="radio"]', function() {
    var $radio = $(this);

    $('[data-show-if="radio-checked"][data-target-name="' + $radio.attr('name') + '"]').each(function() {
        if ($(this).data('target-value').trim() != $radio.val().trim()) {
            $(this).removeClass('hidden--visible');
        } else {
            $(this).addClass('hidden--visible');
        }
    });
});

// HIDDEN CONTENT END
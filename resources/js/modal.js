$(document).on('click', '[data-modal]', function(e) {
    if ($(this).is('a')) {
        e.preventDefault();

        $modal = createNewModal();
        $modal.addClass('is-loading');

        axios.get($(this).attr('href')).then(function(response) {
            $modal.html(response.data.html);
            $modal.parent().addClass('is-visible');
        }).catch(function() {

        }).finally(function() {
            $modal.removeClass('is-loading');
        });
    }
});

$(document).on('click', '.modal__background', function(e) {
    e.preventDefault();
    closeModal($(this));
});

function createNewModal() {
    if (!$('.modals').length) {
        $('body').append($('<div class="modals"></div>'));
    }

    $modals = $('.modals');
    $wrapper = $('<div class="modal"><div class="modal__background"></div></div>');
    $modal = $('<div class="modal__inner"></div>');

    $wrapper.append($modal);

    $modals.append($wrapper);

    $('html, body').css({
        overflow: 'hidden',
        height: '100%'
    });

    return $modal;
}

function closeModal($target) {
    $target.closest('.modal').removeClass('is-visible');

    $('html, body').css({
        overflow: 'unset',
        height: 'unset'
    });

    if (!$('.modal.is-visible').length) {
        $('.modals').remove();
    }
}
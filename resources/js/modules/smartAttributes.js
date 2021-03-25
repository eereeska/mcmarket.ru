import mcm from "../mcm";

mcm.qsa('[data-request]').forEach(function(item) {
    mcm.on('click', item, function(e) {
        e.preventDefault();

        var $clicked = this;

        $clicked.setAttribute('data-loading', true);

        if (item.hasAttribute('data-confirm') && !confirm(item.getAttribute('data-confirm'))) {
            return;
        }

        mcm.request(item.getAttribute('data-request') || 'post', item.getAttribute('href') || item.getAttribute('data-url')).then(function(response) {
            if (response.data.success) {
                if (response.data.hasOwnProperty('redirect')) {
                    window.location.href = response.data.redirect;
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
        }).finally(function() {
            $clicked.removeAttribute('data-loading');
        });
    });
});

mcm.qsa('[data-submit]').forEach(function(item) {
    mcm.on('click', item, function(e) {
        e.preventDefault();

        var $target = mcm.qs(this.getAttribute('data-submit').trim());

        if (!$target) {
            return;
        }

        $target.dispatchEvent(new Event('submit'));
    });
});

mcm.qsa('input[data-on-change]').forEach(function(item) {
    var action = item.getAttribute('data-on-change');
    var type = item.getAttribute('type').toLowerCase();

    if (!['checkbox', 'hidden'].includes(type)) {
        mcm.on('keydown', item, function(e) {
            if (e.altKey || e.ctrlKey) {
                return;
            }

            this.dispatchEvent(new Event('change'));
        });
    }

    mcm.on('change', item, function(e) {
        e.preventDefault();

        if (action == 'submit') {
            var form = this.closest('form');

            if (!form) {
                return;
            }

            form.dispatchEvent(new Event('submit'));
        } else if (action == 'request') {
            mcm.request(item.getAttribute('data-method') || 'post', item.getAttribute('data-url'), {
                checked: item.checked
            });
        }
    });
});

mcm.qsa('form').forEach(function(item) {
    var action = item.getAttribute('data-on-submit') || null;

    
    mcm.on('submit', item, function(e) {
        if (action == 'request') {
            e.preventDefault();

            var results = mcm.qs(item.getAttribute('data-results'));

            if (!results) {
                return;
            }

            results.setAttribute('data-loading', true);

            mcm.request(item.getAttribute('method') || 'post', item.getAttribute('action') ?? item.getAttribute('data-action'), new FormData(item)).then(function(response) {
                results.innerHTML = response.data;
            }).finally(function() {
                results.removeAttribute('data-loading');
            });
        } else {
            this.submit();
        }
    });
});
import mcm from "../mcm";

mcm.qsa('[data-submit]').forEach(function(item) {
    mcm.on('click', item, function(e) {
        e.preventDefault();

        var $target = mcm.qs(this.getAttribute('data-submit').trim());

        if (!$target) {
            return;
        }

        $target.dispatchEvent(new Event('submit'));
    });
})

mcm.qsa('[data-on-change]').forEach(function(item) {
    var action = item.getAttribute('data-on-change');

    mcm.on('change', item, function(e) {
        e.preventDefault();

        if (action == 'submit') {
            var form = this.closest('form');

            if (!form) {
                return;
            }

            form.dispatchEvent(new Event('submit'));
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
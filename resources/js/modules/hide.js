import mcm from "../mcm";

mcm.on('change', 'input[type="radio"], input[type="checkbox"]', function(e) {
    var hiddenID = this.getAttribute('data-show-if-checked');
    var $target = hiddenID ? mcm.qs('[data-hidden-id="' + hiddenID + '"]') : null;

    mcm.qsa('input[type="radio"], input[type="checkbox"]').forEach(function(input) {
        if (input.checked && $target) {
            $target.classList.add('hidden_visible');
        } else {
            mcm.qsa('[data-hidden-id]').forEach(function(hidden) {
                if (hiddenID == hidden.getAttribute('data-hidden-id')) {
                    hidden.classList.add('hidden_visible');
                } else {
                    hidden.classList.remove('hidden_visible');
                }
            });
        }
    });
});

mcm.qsa('[data-hidden-id]').forEach(function(hidden) {
    if (mcm.qs('[data-show-if-checked="' + hidden.getAttribute('data-hidden-id') + '"]:checked')) {
        hidden.classList.add('hidden_visible');
    }
});
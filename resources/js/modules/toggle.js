import mcm from "../mcm";

mcm.qsa('label.toggle').forEach(function(toggle) {
    mcm.on('click', toggle, function(e) {
        e.preventDefault();

        this.classList.toggle('toggle_active');

        var $checkbox = this.querySelector('input.toggle__checkbox');

        if ($checkbox) {
            $checkbox.checked = this.classList.contains('toggle_active');
        }
    });
});
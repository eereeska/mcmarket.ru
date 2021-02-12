const { default: axios } = require("axios");

document.addEventListener('click', function(e) {
    if (e.target && e.target.dataset.action == 'load-more') {
        e.preventDefault();

        var $clicked = e.target;
        var $target = document.querySelector($clicked.dataset.target);

        if (!$target) {
            return;
        }



        $clicked.classList.add('loading');

        axios.get($clicked.tagName.toLowerCase() == 'a' ? $clicked.href : $clicked.dataset('url')).then(function(response) {
            if (response.data.success) {
                $target.innerHTML += response.data.html;
            }
        }).catch(function() {
            $clicked.classList.remove('loading');
        }).finally(function() {
        $clicked.remove();
        });
    }
});
const { default: axios } = require("axios");

document.querySelectorAll('[data-action="search"]').forEach(function(search) {
    search.addEventListener('keydown', handleSearch);
});

function handleSearch(e) {
    if (e.key != 'Enter') {
        return;
    }

    if (!e.target.hasAttribute('data-results')) {
        return;
    }

    e.preventDefault();

    var query = e.target.value.trim();
    var $results = e.target.parentNode.querySelector(e.target.getAttribute('data-results'));

    console.log($results)

    if (!$results) {
        return;
    }

    if (query.length < parseInt(e.target.getAttribute('data-min-length'))) {
        return;
    }

    var url = e.target.getAttribute('data-url') || null;

    axios.post(url, {
        query: query
    }).then(function(response) {
        $results.innerHTML = response.data.result;
    }).catch(function(err) {
        console.log(err)
    }).finally(function() {

    });
}
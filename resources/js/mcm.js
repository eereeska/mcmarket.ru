import axios from "axios";

var mcm = function() {
    this.wtf = 'Что ты тут забыл? :/';
}

mcm.prototype.qs = document.querySelector.bind(document);
mcm.prototype.qsa = document.querySelectorAll.bind(document);
mcm.prototype.cs = document.getElementsByClassName.bind(document);
mcm.prototype.ts = document.getElementsByTagName.bind(document);

mcm.prototype.each = function(selector, callback) {
    return this.qsa(selector).forEach(callback);
}

mcm.prototype.on = function(event, target, callback, timeout = 0) {
    if (typeof target == 'string' || target instanceof String) {
        document.addEventListener(event, function(e) {
            if (e.target.matches(target)) {
                callback.bind(e.target)(e);
            }
        });
    } else {
        if (timeout <= 0 && target.hasAttribute instanceof Function && target.hasAttribute('data-timeout')) {
            timeout = parseInt(target.getAttribute('data-timeout'));
        }

        if (timeout > 0) {
            target.addEventListener(event, this.debounce(callback, timeout));
        } else {
            target.addEventListener(event, callback);
        }
    }
}

mcm.prototype.request = function(method, url, data) {
    var a = axios({
        method: method,
        url: url,
        data: data,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.documentElement.dataset.csrf
        }
    });

    a.catch(function(error) {
        if (error.response) {
            if (error.response.status == 419) {
                alert('Срок действия CSRF токена истёк Пожалуйста, обновите страницу и попробуйте снова');
            }
        } else {
            alert('Произошла ошибка во время обработки запроса. Пожалуйста, попробуйте позже');
        }
    });

    return a;
}

mcm.prototype.parseHTML = function(string) {
    return new DOMParser().parseFromString(string, 'text/html');
}

mcm.prototype.ie = function(el, callback) {
    if (el) {
        callback.bind(el)();
    }
}

mcm.prototype.debounce = function(callback, timeout = 300) {
    var timer;

    return function(...args) {
        clearTimeout(timer);

        timer = setTimeout(function() {
            callback.apply(this, args);
        }, timeout);
    }
}

export default new mcm();
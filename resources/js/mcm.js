import axios from "axios";

var mcm = function() {
    this.hi = 'Что ты тут забыл? :/';
}

mcm.prototype.qs = document.querySelector.bind(document);
mcm.prototype.qsa = document.querySelectorAll.bind(document);

mcm.prototype.on = function(event, target, callback) {
    if (typeof target == 'string' || target instanceof String) {
        document.addEventListener(event, function(e) {
            if (e.target.matches(target)) {
                callback.bind(e.target)(e);
            }
        });
    } else {
        target.addEventListener(event, callback);
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

mcm.prototype.notification = function(message) {
    return new Notification(message);
}

export default new mcm();
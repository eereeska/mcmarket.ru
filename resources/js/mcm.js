import axios from "axios";

export default new function mcm() {
    this.qs = document.querySelector.bind(document);
    this.qsa = document.querySelectorAll.bind(document);
    this.on = (event, callback) => document.addEventListener(event, callback);
    this.request = (method, url, data) => {
        const a = axios({
            method,
            url,
            data,
            headers: {
                'X-CSRF-TOKEN': document.documentElement.dataset.csrf
            }
        });

        a.catch(function(error) {
            if (error.response?.status == 419) {
                alert('Срок действия CSRF токена истёк Пожалуйста, обновите страницу и попробуйте снова');
            } else {
                alert(error.response?.data.message || 'Произошла ошибка во время обработки запроса. Пожалуйста, попробуйте позже');
            }
        });

        return a;
    };
}
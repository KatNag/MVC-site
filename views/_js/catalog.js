function clearFilters() {
    // Удаление куки для каждого поля формы
    document.cookie = "genderFilterValue=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "priceRangeValue=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "sizeFilterValue=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "sortOptionsValue=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

    // Перезагрузка страницы после очистки фильтров
    window.location.href = '/pozdeev/MVC-site/catalog';
}

function saveFilters() {
    var genderFilterValue = document.getElementById('gender-filter').value;
    var priceRangeValue = document.getElementById('price-range').value;
    var sizeFilterValue = document.getElementById('size-filter').value;
    var sortOptionsValue = document.getElementById('sort-options').value;

    // Сохраняем значения полей формы в куки с помощью функции setCookie
    setCookie('genderFilterValue', genderFilterValue, {expires: 3600}); // Сохраняем на 1 час
    setCookie('priceRangeValue', priceRangeValue, {expires: 3600});
    setCookie('sizeFilterValue', sizeFilterValue, {expires: 3600});
    setCookie('sortOptionsValue', sortOptionsValue, {expires: 3600});
}

function filterPriceInput(inputElement) {
    let inputValue = inputElement.value;
    let filteredValue = inputValue.replace(/\D/g, '');
    filteredValue = filteredValue.slice(0, 5);
    inputElement.value = filteredValue;
}

function setCookie(name, value, options = {}) {
    options = {
        path: '/',
        ...options
    };

    if (options.expires instanceof Date) {
        options.expires = options.expires.toUTCString();
    }

    let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

    for (let optionKey in options) {
        updatedCookie += "; " + optionKey;
        let optionValue = options[optionKey];
        if (optionValue !== true) {
            updatedCookie += "=" + optionValue;
        }
    }

    document.cookie = updatedCookie;
}
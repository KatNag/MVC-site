function clearFilters() {
    // Удаление куки для каждого поля формы
    document.cookie = "genderFilterValue=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "priceRangeValue=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "sizeFilterValue=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "sortOptionsValue=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

    // Перезагрузка страницы после очистки фильтров
    location.reload();

    // Устанавливаем значения полей формы в их начальные значения
    document.getElementById('gender-filter').value = 'all';
    document.getElementById('price-range').value = '';
    document.getElementById('size-filter').value = 'all';
    document.getElementById('sort-options').value = 'price-low';

    return false; // Предотвращаем выполнение дальнейшего кода
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
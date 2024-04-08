function clearFilters() {
    // Удаление куки для каждого поля формы
    document.cookie = 'genderFilterValue=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
    document.cookie = 'priceRangeValue=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
    document.cookie = 'sizeFilterValue=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
    document.cookie = 'sortOptionsValue=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';

    document.getElementById('gender-filter').value = 'all';
    document.getElementById('price-range').value = '';
    document.getElementById('size-filter').value = 'all';
    document.getElementById('sort-options').value = 'price-low';
}

function filterPriceInput(inputElement) {
    let inputValue = inputElement.value;
    let filteredValue = inputValue.replace(/\D/g, '');
    filteredValue = filteredValue.slice(0, 5);
    inputElement.value = filteredValue;
}
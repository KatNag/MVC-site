function clearFilters() {
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
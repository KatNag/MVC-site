function formatZipCode(input) {
    var zipCode = input.value.replace(/\D/g, '');

    var formattedNumber = '';
    for (var i = 0; i < zipCode.length; i++) {
        if (i > 0 && i % 3 === 0) {
            formattedNumber += '-';
        }
        formattedNumber += zipCode[i];
    }

    input.value = formattedNumber;
}

function formatName(input) {
    input.value = input.value.replace(/[^а-яА-Я\s-]/g, '');
}

function formatCardNumber(input) {
    var cardNumber = input.value.replace(/\D/g, '');

    var formattedNumber = '';
    for (var i = 0; i < cardNumber.length; i++) {
        if (i > 0 && i % 4 === 0) {
            formattedNumber += '-';
        }
        formattedNumber += cardNumber[i];
    }

    input.value = formattedNumber;
}

document.addEventListener('DOMContentLoaded', function () {
    const nameInput = document.getElementById('name');
    const zipInput = document.getElementById('zip');
    const cardNumInput = document.getElementById('cardNum');
    const monthSelect = document.getElementById('month');
    const yearSelect = document.getElementById('year');

    const zipInputError = document.getElementById('zip-error');
    const cardInputError = document.getElementById('cardNum-error');
    const dateInputError = document.getElementById('date-error');

    zipInput.addEventListener('input', function () {
        formatZipCode(zipInput);
    });

    cardNumInput.addEventListener('input', function () {
        formatCardNumber(cardNumInput);
    });

    nameInput.addEventListener('input', function () {
        formatName(nameInput);
    });

    //
    const paymentForm = document.getElementById('payment-form');
    paymentForm.addEventListener('submit', function (event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });

    function validateForm() {
        const nameInput = document.getElementById('name');
        const zipInput = document.getElementById('zip');
        const cardNumInput = document.getElementById('cardNum');
        const monthSelect = document.getElementById('month');
        const yearSelect = document.getElementById('year');

        let isValid = true;

        if (zipInput.value.length < 7) {
            isValid = false;
            setValidationError(zipInputError, 'Индекс должен содержать 6 цифр');
        } else {
            resetValidationError(zipInputError);
        }

        if (cardNumInput.value.length < 19) {
            isValid = false;
            setValidationError(cardInputError, 'Номер карты должен содержать 16 цифр');
        } else {
            resetValidationError(cardInputError);
        }

        // // Проверка срока действия карты
        const dateInputError = document.getElementById('date-error');

        var selectedMonth = monthSelect.value;
        var selectedYear = yearSelect.value;

        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        var currentMonth = currentDate.getMonth() + 1;

        // Преобразуем выбранный месяц в числовой формат
        var months = [
            'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
        ];
        var selectedMonthIndex = months.indexOf(selectedMonth) + 1;

        if (parseInt(selectedYear) < currentYear ||
            (parseInt(selectedYear) === currentYear && selectedMonthIndex < currentMonth)) {
            setValidationError(dateInputError, 'Карта просрочена');
            isValid = false;
        } else {
            dateInputError.innerText = '';
        }

        return isValid;
    }

    function setValidationError(errorElement, errorMessage) {
        errorElement.innerText = errorMessage;
        errorElement.style.display = 'block';
    }

    function resetValidationError(errorElement) {
        errorElement.innerText = '';
        errorElement.style.display = 'none';
    }

});
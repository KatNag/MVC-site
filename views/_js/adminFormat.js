function formatPrice(input) {
    input.value = input.value.replace(/\D/g, '').slice(0, 6);
}


document.addEventListener('DOMContentLoaded', function () {
    const priceInput = document.getElementById('price');
    priceInput.addEventListener('input', function () {
        formatPrice(priceInput);
    });

    const addProductForm = document.getElementById('add-product-form');
    addProductForm.addEventListener('submit', function (event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });

    function validateForm() {
        let isValid = true;

        const imageInput = document.getElementById('file');
        const imageError = document.getElementById('image-error');

        const gender = document.querySelector('input[name="gender"]:checked');
        const genderError = document.getElementById('gender-error');
        if (!gender) {
            isValid = false;
            setValidationError(genderError, 'Пожалуйста, выберите ваш пол');
        } else {
            resetValidationError(genderError);
        }

        // Проверка наличия выбранного изображения
        if (!imageInput.value) {
            isValid = false;
            setValidationError(imageError, 'Пожалуйста, выберите изображение');
        } else {
            resetValidationError(imageError);
        }

        return isValid;
    }
});

function setValidationError(errorElement, errorMessage) {
    errorElement.innerText = errorMessage;
}

function resetValidationError(errorElement) {
    errorElement.innerText = '';
}
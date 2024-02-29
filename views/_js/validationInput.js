function filterUsername(event) {
    var input = event.target;
    var filteredInput = input.value.replace(/[^A-Za-zА-Яа-яЁё]/g, '');
    filteredInput = filteredInput.slice(0, 20);
    input.value = filteredInput;
}

document.addEventListener('DOMContentLoaded', function () {
    const registrationForm = document.getElementById('registration-form');
    registrationForm.addEventListener('submit', function (event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });

    function validateForm() {
        let isValid = true;

        const username = document.getElementById('username').value;
        const usernameError = document.getElementById('username-error');
        if (username.length < 2) {
            isValid = false;
            setValidationError(usernameError, 'Имя пользователя должно содержать не менее 2 букв');
        } else {
            resetValidationError(usernameError);
        }

        const birthdate = document.getElementById('birthdate').value;
        const birthdateError = document.getElementById('birthdate-error');
        const ageLimit = 14;
        const maxAge = 105;

        if (!isValidBirthdate(birthdate, ageLimit, maxAge)) {
            isValid = false;
            setValidationError(birthdateError, getBirthdateErrorMessage(birthdate, ageLimit, maxAge));
        } else {
            resetValidationError(birthdateError);
        }

        const gender = document.querySelector('input[name="gender"]:checked');
        const genderError = document.getElementById('gender-error');
        if (!gender) {
            isValid = false;
            setValidationError(genderError, 'Пожалуйста, выберите ваш пол');
        } else {
            resetValidationError(genderError);
        }

        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;
        const passwordError = document.getElementById('password-error');
        if (password !== confirmPassword) {
            isValid = false;
            setValidationError(passwordError, 'Пароли не совпадают');
        } else {
            resetValidationError(passwordError);
        }

        return isValid;
    }

    function setValidationError(errorElement, errorMessage) {
        errorElement.innerText = errorMessage;
    }

    function resetValidationError(errorElement) {
        errorElement.innerText = '';
    }

    function isValidBirthdate(birthdate, minAge, maxAge) {
        const birthdateObj = new Date(birthdate);
        const currentDate = new Date();

        return (
            birthdateObj <= currentDate &&
            currentDate.getFullYear() - birthdateObj.getFullYear() >= minAge &&
            currentDate.getFullYear() - birthdateObj.getFullYear() <= maxAge
        );
    }

    function getBirthdateErrorMessage(birthdate, minAge, maxAge) {
        const birthdateObj = new Date(birthdate);
        const currentDate = new Date();
        const age = currentDate.getFullYear() - birthdateObj.getFullYear();

        if (birthdateObj > currentDate) {
            return 'О, вы из будущего?';
        } else if (age < minAge) {
            return 'Верни банковскую карту тому, у кого ее забрал';
        } else if (age > maxAge) {
            return 'Как хорошо, что даже в таком возрасте вы хорошо ориентируетесь в современных технологиях';
        }
        return 'Пожалуйста, проверьте дату рождения';
    }
});

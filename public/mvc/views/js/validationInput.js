function filterUsername(event) {
    var input = event.target;
    var filteredInput = input.value.replace(/[^A-Za-zА-Яа-яЁё]/g, '');
    input.value = filteredInput;
}

function validateBirthdate(birthdate) {
    var currentDate = new Date();
    var inputDate = new Date(birthdate);

    if (isNaN(inputDate.getTime())) {
        return false;
    }
    var age = currentDate.getFullYear() - inputDate.getFullYear();

    return age >= 14;
}

document.addEventListener('DOMContentLoaded', function () {
    // Ждем, пока загрузится весь документ

    // Находим форму по ее ID
    var registrationForm = document.getElementById('registration-form');

    // Добавляем обработчик события на отправку формы
    registrationForm.addEventListener('submit', function (event) {
        // Получаем значение даты рождения из поля ввода
        var birthdateInput = document.getElementById('birthdate');
        var birthdateValue = birthdateInput.value;

        // Вызываем функцию проверки даты рождения
        var isValidBirthdate = validateBirthdate(birthdateValue);

        // Если дата рождения некорректная, отменяем отправку формы
        if (!isValidBirthdate) {
            event.preventDefault();
            alert('Некорректная дата рождения. Пользователь должен быть старше 14 лет и не старше 120 лет.');
        }

        // Получаем значение выбранного пола
        var genderInputs = document.getElementsByName('gender');
        var selectedGender = false;

        // Проверяем, есть ли выбранный пол
        for (var i = 0; i < 2; i++) {
            if (genderInputs[i].checked) {
                selectedGender = true;
                break;
            }
        }

    });
});

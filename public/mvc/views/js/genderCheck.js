document.addEventListener('DOMContentLoaded', function () {
    const femaleOption = document.getElementById('female');
    const maleOption = document.getElementById('male');

    const femaleImage = document.querySelector('.gender-option.female img');
    const maleImage = document.querySelector('.gender-option.male img');

    femaleImage.addEventListener('click', function () {
        femaleOption.checked = true;
        maleOption.checked = false;
    });

    maleImage.addEventListener('click', function () {
        maleOption.checked = true;
        femaleOption.checked = false;
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const registrationForm = document.getElementById('registration-form');
    const loginForm = document.getElementById('login-form');

    document.getElementById('toggle-login').addEventListener('click', function () {
        registrationForm.classList.remove('active-form');
        registrationForm.classList.add('inactive-form');
        loginForm.classList.remove('inactive-form');
        loginForm.classList.add('active-form');
    });

    document.getElementById('toggle-registration').addEventListener('click', function () {
        loginForm.classList.remove('active-form');
        loginForm.classList.add('inactive-form');
        registrationForm.classList.remove('inactive-form');
        registrationForm.classList.add('active-form');
    });
})

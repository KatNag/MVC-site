document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const togglePasswordButtons = document.querySelectorAll('.toggle-password-button');

    function togglePasswordVisibility(input, toggleButton) {
        if (input.type === 'password') {
            input.type = 'text';
            toggleButton.textContent = '👁️';
        } else {
            input.type = 'password';
            toggleButton.textContent = '🔒';
        }
    }

    togglePasswordButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            togglePasswordVisibility(button.previousElementSibling, button);
        });
    });
});

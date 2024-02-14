<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include '../../php/config.php'; ?>

    <link href="<?= BASE_URL ?>mvc/views/css/access.css" rel="stylesheet">
    <script src="<?= BASE_URL ?>mvc/vendor/jquery.js"></script>
    <script src="<?= BASE_URL ?>mvc/views/js/validationInput.js"></script>
    <script src="<?= BASE_URL ?>mvc/views/js/genderChoice.js"></script>
    <script src="<?= BASE_URL ?>mvc/views/js/toggleForm.js"></script>
    <script src="<?= BASE_URL ?>mvc/views/js/togglePasswordVisibility.js"></script>

    <title>Регистрация</title>
</head>
<body>
<section>
    <a href="<?= BASE_URL ?>index.php">
        <img src="<?= BASE_URL ?>images/logos/mainLogo.png" alt="logo">
        CrossWorld
    </a>

    <div>

        <form id="registration-form" class="active-form" action="#">
            <!--              onsubmit="return validateForm()">-->
            <h1>Регистрация</h1>
            <label for="username">Имя пользователя</label>
            <input type="text" name="username" id="username" placeholder="Введите ваше имя" required=""
                   oninput="filterUsername(event)">
            <div class="error-message" id="username-error"></div>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="name@mail.ru" required
                   pattern="[a-zA-Zа-яА-Я0-9._%+-]+@[a-zA-Zа-яА-Я0-9.-]+\.[a-zA-Zа-яА-Я]{2,}">

            <label for="birthdate">Дата рождения</label>
            <input type="date" id="birthdate" name="birthdate" required="">
            <div class="error-message" id="birthdate-error"></div>

            <div class="gender-container">
                <div class="gender-option female">
                    <input type="radio" name="gender" id="female" value="female" hidden>
                    <img src="<?= BASE_URL ?>images/photos/womanSneaker.jpg" alt="Female">
                    <p>Женский</p>
                </div>
                <div class="gender-option male">
                    <input type="radio" name="gender" id="male" value="male" hidden>
                    <img src="<?= BASE_URL ?>images/photos/manSneaker.jpg" alt="Male">
                    <p>Мужской</p>
                </div>
            </div>
            <div class="error-message" id="gender-error"></div>

            <label for="confirm-password">Пароль</label>
            <div class="password-container">
                <input type="password" name="password" id="password" placeholder="••••••••" required minlength="8">
                <button type="button" class="toggle-password-button">🔒</button>
            </div>
            <div class="error-message" id="password-error"></div>

            <label for="confirm-password">Подтверждение пароля</label>
            <div class="password-container">
                <input type="password" name="confirm-password" id="confirm-password" placeholder="••••••••" required
                       minlength="8">
                <button type="button" class="toggle-password-button">🔒</button>
            </div>

            <button type="submit" class="button create-account-button">Создать аккаунт</button>
            <p>Уже зарегистрированы? <a href="#" class="font-medium" id="toggle-login">Войти</a>
            </p>
        </form>

        <form id="login-form" class="inactive-form" action="#">
            <!--              onsubmit="return validateForm()">-->
            <h1>Вход</h1>
            <label for="email-login">Email</label>
            <input type="email" name="email-login" id="email-login" placeholder="name@mail.ru" required="">

            <label for="password">Пароль</label>
            <div class="password-container">
                <input type="password" name="password" id="password" placeholder="••••••••" required minlength="8">
                <button type="button" class="toggle-password-button">🔒</button>
            </div>

            <button type="submit" class="button signin-account-button">Войти</button>

            <p>Ещё не зарегистрированы? <a href="#" class="font-medium"
                                           id="toggle-registration">Зарегистрироваться</a></p>
        </form>
    </div>

</section>
</body>
</html>

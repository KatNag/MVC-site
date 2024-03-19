<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="/MVC-site/public/images/logos/mainLogo.png">
    <link href="/MVC-site/views/_css/access.css" rel="stylesheet">

    <script src="/MVC-site/vendor/jquery.js"></script>
    <script src="/MVC-site/views/_js/validationInput.js"></script>
    <script src="/MVC-site/views/_js/genderChoice.js"></script>
    <script src="/MVC-site/views/_js/toggleForm.js"></script>
    <script src="/MVC-site/views/_js/togglePasswordVisibility.js"></script>
</head>
<body>
<section>
    <a href="/MVC-site/">
        <img src="/MVC-site/public/images/logos/mainLogo.png" alt="logo">
        CrossWorld
    </a>

    <div>
        <?php
        if (isset($_SESSION['registration_success']) && $_SESSION['registration_success'] === true) {
            $username = $_SESSION['username'];
            echo "<script>alert('Привет, $username!💪 Спасибо за регистрацию💖. Войди с данными, чтобы их запомнить🧠');</script>";
            unset($_SESSION['registration_success']);
        }
        ?>

        <form id="registration-form" class="inactive-form" action="/MVC-site/registration" method="POST">
            <h1>Регистрация</h1>
            <label for="username">Имя пользователя</label>
            <input type="text" name="username" id="username" placeholder="Введите ваше имя" required=""
                   oninput="filterUsername(event)">
            <div class=" error-message" id="username-error">
            </div>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="name@mail.ru" required
                   pattern="[a-zA-Zа-яА-Я0-9._%+-]+@[a-zA-Zа-яА-Я0-9.-]+\.[a-zA-Zа-яА-Я]{2,}">

            <label for="birthdate">Дата рождения</label>
            <input type="date" id="birthdate" name="birthdate" required="">
            <div class="error-message" id="birthdate-error"></div>

            <div class="gender-container">
                <div class="gender-option female">
                    <input type="radio" name="gender" id="female" value="female" hidden>
                    <img src="/MVC-site/public/images/photos/womanSneaker.jpg" alt="Female">
                    <p>Женский</p>
                </div>
                <div class="gender-option male">
                    <input type="radio" name="gender" id="male" value="male" hidden>
                    <img src="/MVC-site/public/images/photos/manSneaker.jpg" alt="Male">
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

        <form id="login-form" class="active-form" action="/MVC-site/login" method="POST">
            <h1>Вход</h1>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="name@mail.ru" required="">

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

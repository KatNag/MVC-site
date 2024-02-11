<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include '../../php/config.php'; ?>
    <link href="<?= BASE_URL ?>mvc/views/css/registration.css" rel="stylesheet">

    <script src="<?= BASE_URL ?>mvc/vendor/jquery.js"></script>
    <script src="<?= BASE_URL ?>mvc/views/js/phoneValidation.js"></script>
    <script src="<?= BASE_URL ?>mvc/views/js/genderCheck.js"></script>

    <title>Регистрация</title>
</head>
<body>
<section>
    <a href="<?= BASE_URL ?>index.php">
        <img src="<?= BASE_URL ?>images/logos/mainLogo.png" alt="logo">
        CrossWorld
    </a>

    <div>
        <h1>Регистрация</h1>
        <form action="#">
            <label for="username">Имя пользователя</label>
            <input type="text" name="username" id="username" placeholder="Введите ваше имя" required="">

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="name@mail.ru" required="">

            <label for="birthdate">Дата рождения</label>
            <input type="date" id="birthdate" name="birthdate" required="">

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

            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" placeholder="••••••••" required="">

            <label for="confirm-password">Подтверждение пароля</label>
            <input type="password" name="confirm-password" id="confirm-password" placeholder="••••••••" required="">

            <button type="submit">Создать аккаунт</button>
            <p>Уже зарегистрированы? <a href="#" class="font-medium" style="color: #3B82F6;">Войти</a></p>
        </form>
    </div>
    <!--</section>-->
</body>
</html>

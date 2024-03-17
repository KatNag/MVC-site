<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Catalog</title>

    <link rel="stylesheet" href="/MVC-site/views/_css/profile.css">

    <script src="/MVC-site/vendor/jquery.js"></script>
    <script src="/MVC-site/views/_js/validationInput.js"></script>
    <script src="/MVC-site/views/_js/togglePasswordVisibility.js"></script>
</head>

<body>
<?php
if (!isset($_SESSION['user_id'])) {
// Если пользователь не авторизован, перенаправляем его на страницу входа
    header("Location: /MVC-site/access");
    exit;
}
?>
<div class="profile-container">
    <div class="information">
        <form id="registration-form" class="inactive-form" action="/MVC-site/registration" method="POST">
            <h1>Ваши данные</h1>
            <label for="username">Имя пользователя</label>
            <input type="text" name="username" id="username" placeholder="Введите ваше имя" required=""
                   oninput="filterUsername(event)">
            <div class=" error-message" id="username-error"></div>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="name@mail.ru" required
                   pattern="[a-zA-Zа-яА-Я0-9._%+-]+@[a-zA-Zа-яА-Я0-9.-]+\.[a-zA-Zа-яА-Я]{2,}">
            <div class=" error-message" id="email-error"></div>

            <label for="birthdate">Дата рождения</label>
            <input type="date" id="birthdate" name="birthdate" required="">
            <div class="error-message" id="birthdate-error"></div>

            <label for="birthdate">Пол:</label>
            <label for="birthdate">Ж</label>

            <button type="submit" class="button update-account-button">Обновить данные</button>
        </form>
    </div>
    <div class="cards-container">
        <!--        TO DO Здесь карточки товаров предыдущих заказов-->
        <?php include ROOT . '/views/product/cart.php'; ?>
    </div>
</div>
</body>
</html>

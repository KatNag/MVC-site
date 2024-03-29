<!DOCTYPE html>
<html lang="ru">


<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Catalog</title>

    <link rel="stylesheet" href="/MVC-site/views/_css/profile.css">
    <script src="/MVC-site/views/_js/genderChoice.js"></script>
</head>

<body>
<div class="profile-container">
    <div class="information">
        <form id="update-form" class="inactive-form" action='/MVC-site/updateProfile' method="POST">
            <h1>Ваши данные</h1>
            <label for="username">Имя пользователя</label>
            <input type="text" name="username" id="username" placeholder="Введите ваше имя" required=""
                   oninput="filterUsername(event)" value="<?php echo $_SESSION['username']; ?>">
            <div class="error-message" id="username-error"></div>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="name@mail.ru" required
                   pattern="[a-zA-Zа-яА-Я0-9._%+-]+@[a-zA-Zа-яА-Я0-9.-]+\.[a-zA-Zа-яА-Я]{2,}"
                   value="<?php echo $_SESSION['email']; ?>">
            <div class="error-message" id="email-error"></div>

            <label for="birthdate">Дата рождения</label>
            <input type="date" id="birthdate" name="birthdate" required=""
                   value="<?php echo $_SESSION['birthdate']; ?>">
            <div class="error-message" id="birthdate-error"></div>

            <label for="gender">Пол:</label>
            <div class="gender-container">
                <div class="gender-option female">
                    <input type="radio" name="gender" id="female"
                           value="ж"
                        <?php echo ($_SESSION['gender'] === 'ж') ? 'checked' : ''; ?>>
                    <img src="/MVC-site/public/images/photos/womanSneaker.jpg" alt="Female">
                    <p>Жен.</p>
                </div>

                <div class="gender-option male">
                    <input type="radio" name="gender" id="male"
                           value="м"
                        <?php echo ($_SESSION['gender'] === 'м') ? 'checked' : ''; ?>>
                    <img src="/MVC-site/public/images/photos/manSneaker.jpg" alt="Male">
                    <p>Муж.</p>
                </div>
            </div>

            <button type="button" class="button update-account-button">Обновить данные</button>
        </form>

        <button type="" onclick="logoutUser()" class="button logout-button">Выйти</button>

    </div>
    <div class="cards-container">
        <!--        TO DO Здесь карточки товаров предыдущих заказов-->
        <?php include ROOT . '/views/product/cart.php'; ?>
    </div>
</div>
<?php
if (isset($_SESSION['updateProfile_success']) && $_SESSION['updateProfile_success'] === true) {
    echo "<script>alert('Данные были изменены');</script>";
    unset($_SESSION['updateProfile_success']);
}
?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const genderLabels = document.querySelectorAll('.gender-option');
        document.querySelector('.update-account-button').addEventListener('click', confirmUpdate);
    });

    function logoutUser() {
        window.location.href = '/MVC-site/logout';
    }

    function confirmUpdate() {
        if (confirm("Вы уверены, что хотите обновить данные профиля?")) {
            // Если пользователь подтвердил, отправляем форму
            document.getElementById("update-form").submit();
        } else {
            // Если пользователь отменил, ничего не делаем
            return false;
        }
    }
</script>

</body>
</html>

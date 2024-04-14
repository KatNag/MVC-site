<!DOCTYPE html>
<html lang="ru">


<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Catalog</title>

    <link rel="stylesheet" href="/MVC-site/views/_css/profile.css">
    <script src="/MVC-site/views/_js/genderChoice.js"></script>
    <link href="/MVC-site/views/_css/product.css" rel="stylesheet">
    <script src="/MVC-site/vendor/jquery.js"></script>
    <link href="/MVC-site/vendor/fancybox/fancybox.css" rel="stylesheet">
    <script src="/MVC-site/vendor/fancybox/fancybox.js"></script>

    <link rel="stylesheet" href="/MVC-site/vendor/fontawesome.css">
</head>

<body>
<?php $products = array_values($products); ?>
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

        <button type="button" onclick="logoutUser()" class="button logout-button">Выйти</button>

    </div>
    <div class="cards-container">
        <h1>Ранее купленные товары</h1>
        <?php for ($i = 0; $i < count($products); $i++): ?>
            <div class="product-container">
                <div class="product-image">
                    <a data-fancybox="gallery" data-src="
                        <?php echo $products[$i]['image_path']; ?>">
                        <img alt="<?php echo $products[$i]['name']; ?>" class="image" loading="lazy"
                             src="<?php echo $products[$i]['image_path']; ?>"/>
                    </a>
                </div>
                <form class="product-details">
                    <div class="product-info">
                        <h1 class="product-title"><?php echo $products[$i]['name']; ?></h1>
                        <div class="product-price"><?php echo $products[$i]['price']; ?></div>
                    </div>
                    <p class="brand-name"><?php echo $products[$i]['brand']; ?></p>
                    <textarea class="brand-name" name="productId"
                              id="productId"><?php echo $products[$i]['id']; ?></textarea>
                    <div class="size-options">
                        <?php $sizes = array_values($products[$i]['sizes']); ?>
                        <?php for ($j = 0; $j < count($sizes); $j++): ?>
                            <div class="selected-size">
                                <input checked id="size-
                        <?php echo $products[$i]['id'] . '-' . $sizes[$j]; ?>"
                                       name="size-<?php echo $products[$i]['id']; ?>" type="radio"
                                       value="<?php echo $sizes[$j]; ?>"/>
                                <label for="size-
                        <?php echo $products[$i]['id'] . '-' . $sizes[$j]; ?>">
                                    <?php echo $sizes[$j]; ?></label>
                            </div>
                        <?php endfor; ?>
                    </div>
                </form>
            </div>
        <?php endfor; ?>
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

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <link href="/pozdeev/MVC-site/views/_css/index.css" rel="stylesheet">
</head>

<body>
<div class="header-container">
    <div class="header-content">
        <a href="index" class="logo-button">
            <img alt="" class="logo-image" src="/pozdeev/MVC-site/public/images/logos/mainLogo.png">
            <div class="header-title-links">
                <h1 class="header-title">CrossWorld</h1>
            </div>
        </a>
        <a class="header-link" href="/pozdeev/MVC-site/catalog">Каталог</a>
        <div class="header-links">
            <div class="header-icons">

                <?php
                // Проверка роли пользователя
                if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                    echo '<a href="/pozdeev/MVC-site/admin" class="icon-button rounded">';
                    echo '<img alt="Админ" class="icon-image" src="/pozdeev/MVC-site/public/images/icons/admin.png">';
                    echo '</a>';
                }
                ?>

                <!--                <button class="icon-button">-->
                <!--                    <img alt="Избранное" class="icon-image" src="-->
                <!--                --><?php //= ROOT ?><!--images/icons/favourite.png">-->
                <!--                </button>-->

                <a href="/pozdeev/MVC-site/cart" class="icon-button rounded">
                    <img alt="Корзина" class="icon-image" src="/pozdeev/MVC-site/public/images/icons/shoppingCart.png">
                </a>

                <a href="<?php echo isset($_SESSION['login_success']) && $_SESSION['login_success'] === true ? '/pozdeev/MVC-site/profile' : '/pozdeev/MVC-site/access'; ?>"
                   class="icon-button rounded">
                    <img alt="Вход" class="icon-image" src="/pozdeev/MVC-site/public/images/icons/user.png">
                </a>

            </div>
        </div>
    </div>
</div>
</body>

</html>

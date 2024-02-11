<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="css/index.css" rel="stylesheet">

    <?php include 'php/config.php'; ?>
</head>

<body>
<div class="header-container">
    <div class="header-content">
        <button class="logo-button">
            <img alt="" class="logo-image" src="<?= BASE_URL ?>images/logos/mainLogo.png">
            <div class="header-title-links">
                <h1 class="header-title">CrossWorld</h1>
            </div>
        </button>
        <a class="header-link" href="#">Каталог</a>
        <div class="header-links">
            <div class="header-icons">

                <button class="icon-button">
                    <img alt="Поиск" class="icon-image" src="<?= BASE_URL ?>images/icons/search.png">
                </button>

                <button class="icon-button">
                    <img alt="Избранное" class="icon-image" src="<?= BASE_URL ?>images/icons/favourite.png">
                </button>

                <button class="icon-button">
                    <img alt="Корзина" class="icon-image" src="<?= BASE_URL ?>images/icons/shoppingCart.png">
                </button>

                <a href="<?= BASE_URL ?>mvc/views/registration.php" class="icon-button rounded">
                    <img alt="Личный кабинет" class="icon-image" src="<?= BASE_URL ?>images/icons/user.png">
                </a>

                <!--                <button class="icon-button rounded">-->
                <!--                    <img alt="Личный кабинет" class="icon-image" src="-->
                <?php //= BASE_URL ?><!--images/icons/user.png">-->
                <!--                </button>-->
            </div>
        </div>
    </div>
</div>
</body>

</html>

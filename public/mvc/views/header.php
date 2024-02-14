<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="css/index.css" rel="stylesheet">

</head>

<body>
<div class="header-container">
    <div class="header-content">
        <a href="<?= BASE_URL ?>index.php" class="logo-button">
            <img alt="" class="logo-image" src="<?= BASE_URL ?>images/logos/mainLogo.png">
            <div class="header-title-links">
                <h1 class="header-title">CrossWorld</h1>
            </div>
        </a>
        <a class="header-link" href="<?= BASE_URL ?>catalogue.php">Каталог</a>
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

                <a href="<?= BASE_URL ?>mvc/views/access.php" class="icon-button rounded">
                    <img alt="Вход" class="icon-image" src="<?= BASE_URL ?>images/icons/user.png">
                </a>

            </div>
        </div>
    </div>
</div>
</body>

</html>

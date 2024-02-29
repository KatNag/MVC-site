<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="/MVC-site/views/_css/productCart.css" rel="stylesheet">
    <script src="/MVC-site/vendor/jquery.js"></script>
    <link href="/MVC-site/vendor/fancybox/fancybox.css" rel="stylesheet">
    <script src="/MVC-site/vendor/fancybox/fancybox.js"></script>

    <link rel="stylesheet" href="/MVC-site/vendor/fontawesome.css">
</head>

<body>
<!--        TO DO Заменить все на переменные, где будут данные из бд подтягиваться (корзина)-->
<div class="product-container">
    <div class="product-image">
        <a data-fancybox="gallery" data-src="/MVC-site/public/images/photos/testProduct.webp">
            <img alt="Utility Jacket" class="image" loading="lazy"
                 src="/MVC-site/public/images/photos/testProduct.webp"/>
        </a>
    </div>
    <form class="product-details">
        <div class="product-info">
            <h1 class="product-title">Лучшие кроссы</h1>
            <div class="product-price">₽11 000</div>
        </div>
        <p class="brand-name">Noname</p>
        <div class="selected-size">
            <input checked id="size-36" name="size" type="radio" value="36"/>
            <label for="size-36">36</label>
        </div>

        <div class="actions">
            <div class="buttons">
                <button class="delete-from-bag" type="button" title="Удалить из корзины">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
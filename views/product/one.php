<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="/pozdeev/MVC-site/views/_css/product.css" rel="stylesheet">
    <script src="/pozdeev/MVC-site/vendor/jquery.js"></script>
    <link href="/pozdeev/MVC-site/vendor/fancybox/fancybox.css" rel="stylesheet">
    <script src="/pozdeev/MVC-site/vendor/fancybox/fancybox.js"></script>
    <link rel="stylesheet" href="/pozdeev/MVC-site/vendor/fontawesome.css">
</head>

<body>
<div class="product-container" style="display: none;">
    <div class="product-image">
        <a data-fancybox="gallery" data-src="/pozdeev/MVC-site/public/images/photos/testProduct.webp">
            <img alt="Лучшие кроссы" class="image" loading="lazy"
                 src="/pozdeev/MVC-site/public/images/photos/testProduct.webp"/>
        </a>
    </div>
    <form class="product-details">
        <div class="product-info">
            <h1 class="product-title">Лучшие кроссы</h1>
            <div class="product-price">₽11 000</div>
        </div>
        <p class="brand-name">Noname</p>
        <div class="size-options">
            <div class="size-selector">
                <input checked id="size-36" name="size" type="radio" value="xs"/>
                <label for="size-36">36</label>
            </div>
            <div class="size-selector">
                <input id="size-37" name="size" type="radio" value="s"/>
                <label for="size-37">37</label>
            </div>
            <div class="size-selector">
                <input id="size-38" name="size" type="radio" value="m"/>
                <label for="size-38">38</label>
            </div>
            <div class="size-selector">
                <input id="size-39" name="size" type="radio" value="l"/>
                <label for="size-39">39</label>
            </div>
            <div class="size-selector">
                <input id="size-40" name="size" type="radio" value="xl"/>
                <label for="size-40">40</label>
            </div>
            <div class="size-selector">
                <input id="size-41" name="size" type="radio" value="xl"/>
                <label for="size-41">41</label>
            </div>
        </div>

        <div class="actions">
            <div class="buttons">
                <button class="add-to-cart" type="button" title="Добавить в корзину">
                    <i class="fas fa-shopping-cart"></i>
                </button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
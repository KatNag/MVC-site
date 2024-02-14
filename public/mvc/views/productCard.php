<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="<?= BASE_URL ?>mvc/views/css/productCard.css" rel="stylesheet">
    <script src="<?= BASE_URL ?>mvc/vendor/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <title>Product Details</title>
</head>

<body>
<div class="product-container">
    <div class="product-image">
        <a data-fancybox="gallery" data-src="<?= BASE_URL ?>images/photos/testProduct.webp">
            <img alt="Utility Jacket" class="image" loading="lazy" src="<?= BASE_URL ?>images/photos/testProduct.webp"/>
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
                <button class="add-to-bag" type="button">Add to bag</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>

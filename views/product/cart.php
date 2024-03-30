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

<div class="cards-container">
    <?php foreach ($products as $product): ?>
        <div class="product-container">
            <div class="product-image">
                <a data-fancybox="gallery" data-src="<?php echo $product['image_path']; ?>">
                    <img alt="<?php echo $product['name']; ?>" class="image" loading="lazy" src="<?php echo $product['image_path']; ?>"/>
                </a>
            </div>
            <form class="product-details">
                <div class="product-info">
                    <h1 class="product-title"><?php echo $product['name']; ?></h1>
                    <div class="product-price"><?php echo $product['price']; ?></div>
                </div>
                <p class="brand-name"><?php echo $product['brand']; ?></p>
                <div class="selected-size">
                    <?php foreach ($product['sizes'] as $size): ?>
                        <input id="size-<?php echo $size; ?>" name="size" type="radio" value="<?php echo $size; ?>"/>
                        <label for="size-<?php echo $size; ?>"><?php echo $size; ?></label>
                    <?php endforeach; ?>
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
    <?php endforeach; ?>
</div>

</body>
</html>
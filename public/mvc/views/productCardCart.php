<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="<?= BASE_URL ?>mvc/views/css/productCardCart.css" rel="stylesheet">
    <script src="<?= BASE_URL ?>mvc/vendor/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
    <script>
        function processPayment() {
            alert('Спасибо за заказ!');
        }
    </script>
</div>
</body>
</html>
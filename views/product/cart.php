<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!--    <link href="/MVC-site/views/_css/productCart.css" rel="stylesheet">-->
    <link href="/MVC-site/views/_css/product.css" rel="stylesheet">
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
                    <img alt="<?php echo $product['name']; ?>" class="image" loading="lazy"
                         src="<?php echo $product['image_path']; ?>"/>
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
                        <input id="size-<?php echo $product['id'] . '-' . $size; ?>"
                               name="size-<?php echo $product['id']; ?>" type="radio" value="<?php echo $size; ?>"/>
                        <label for="size-<?php echo $product['id'] . '-' . $size; ?>"><?php echo $size; ?></label>
                    <?php endforeach; ?>
                </div>
                <div class="actions">
                    <div class="buttons">
                        <?php if ($isCatalog): ?>
                            <?php if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true): ?>
                                <button onclick="addToCart(<?php echo $product['id']; ?>)" class="add-to-cart"
                                        type="button" title="Добавить в корзину">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            <?php else: ?>
                                <button onclick="redirectToRegistration()" class="add-to-cart" type="button"
                                        title="Добавить в корзину">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            <?php endif; ?>
                        <?php else: ?>
                            <button class="delete-from-bag" type="button" title="Удалить из корзины">
                                <i class="fas fa-trash"></i>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

                <script>
                    function redirectToRegistration() {
                        window.location.href = '/MVC-site/access';
                    }

                    function addToCart(productId) {
                        $.ajax({
                            type: 'POST',
                            url: 'MVC-site/AddToCart',
                            data: {productId: productId},
                            success: function (response) {
                                alert('Товар добавлен в корзину!');
                            },
                            error: function (xhr, status, error) {
                                alert('Ошибка при добавлении товара в корзину: ' + error);
                            }
                        });
                    }

                    function deleteFromCart(productId) {
                        // Отправка запроса на сервер для удаления товара из корзины
                        $.ajax({
                            type: 'POST',
                            url: '/MVC-site/cart',
                            data: {productId: productId},
                            success: function (response) {
                                // Обработка успешного удаления товара
                                alert('Товар удален из корзины!');
                            },
                            error: function (xhr, status, error) {
                                // Обработка ошибки удаления товара
                                alert('Ошибка при удалении товара из корзины: ' + error);
                            }
                        });
                    }

                </script>
            </form>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
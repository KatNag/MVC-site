<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="/MVC-site/views/_css/product.css" rel="stylesheet">
    <script src="/MVC-site/vendor/jquery.js"></script>
    <link href="/MVC-site/vendor/fancybox/fancybox.css" rel="stylesheet">
    <script src="/MVC-site/vendor/fancybox/fancybox.js"></script>

    <link rel="stylesheet" href="/MVC-site/vendor/fontawesome.css">
</head>

<body>

<?php $products = array_values($products); ?>
<div class="cards-container">
    <?php for ($i = 0; $i < count($products); $i++): ?>
        <div class="product-container">
            <div class="product-image">
                <a data-fancybox="gallery" data-src="<?php echo $products[$i]['image_path']; ?>">
                    <img alt="<?php echo $products[$i]['name']; ?>" class="image" loading="lazy"
                         src="<?php echo $products[$i]['image_path']; ?>"/>
                </a>
            </div>
            <form class="product-details" action="/MVC-site/addToCart" method="POST">
                <div class="product-info">
                    <h1 class="product-title"><?php echo $products[$i]['name']; ?></h1>
                    <div class="product-price"><?php echo $products[$i]['price']; ?></div>
                </div>
<<<<<<< Updated upstream
                <p class="brand-name"><?php echo $products[$i]['brand']; ?></p>
=======
                <p class="brand-name"><?php echo $product['brand']; ?></p>
                <textarea class="brand-name" name="productId" id="productId">товар: <?php echo $product['id']; ?></textarea>
>>>>>>> Stashed changes
                <div class="selected-size">
                    <?php foreach ($products[$i]['sizes'] as $size): ?>
                        <input id="size-<?php echo $products[$i]['id'] . '-' . $size; ?>"
                               name="size-<?php echo $products[$i]['id']; ?>" type="radio"
                               value="<?php echo $size; ?>"/>
                        <label for="size-<?php echo $products[$i]['id'] . '-' . $size; ?>">
                            <?php echo $size; ?></label>
                    <?php endforeach; ?>
                </div>
                <div class="actions">
                    <div class="buttons">
                        <?php if ($isCatalog): ?>
                            <?php if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true): ?>
<<<<<<< Updated upstream
                                <button onclick="addToCart(<?php echo $products[$i]['id']; ?>)" class="add-to-cart"
                                        type="button" title="Добавить в корзину">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
=======
                                <button type="submit" class="button" title="Добавить в корзину">Добавить в корзину</button>
>>>>>>> Stashed changes
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
                            url: '/MVC-site/addToCart',
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
    <?php endfor; ?>
</div>
</body>
</html>


<!DOCTYPE html>
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
            <form class="product-details"
                  action="<?php echo $isCatalog ? '/pozdeev/MVC-site/addToCart' : '/pozdeev/MVC-site/removeToCart'; ?>" method="POST">
                <div class="product-info">
                    <h1 class="product-title"><?php echo $products[$i]['name']; ?></h1>
                    <div class="product-price"><?php echo $products[$i]['price']; ?></div>
                </div>
                <p class="brand-name"><?php echo $products[$i]['brand']; ?></p>
                <textarea class="brand-name" name="productId"
                          id="productId"><?php echo $products[$i]['id']; ?></textarea>
                <div class="size-options">
                    <?php $sizes = array_values($products[$i]['sizes']); ?>
                    <?php for ($j = 0; $j < count($sizes); $j++): ?>
                        <div class="<?php echo $isCatalog ? 'size-selector' : 'selected-size'; ?>">
                            <input checked id="size-<?php echo $products[$i]['id'] . '-' . $sizes[$j]; ?>"
                                   name="size-<?php echo $products[$i]['id']; ?>" type="radio"
                                   value="<?php echo $sizes[$j]; ?>"/>
                            <label for="size-<?php echo $products[$i]['id'] . '-' . $sizes[$j]; ?>">
                                <?php echo $sizes[$j]; ?></label>
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="actions">
                    <div class="buttons">
                        <?php if ($isCatalog): ?>
                            <?php if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true): ?>
                                <button type="submit" class="add-to-cart" title="Добавить в корзину">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            <?php else: ?>
                                <button onclick="redirectToRegistration()" class="add-to-cart" type="button"
                                        title="Добавить в корзину">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="quantity-selector">
                                <button type="button" class="decrement">-</button>
                                <input type="number" class="quantity" name="quantity" value="1" min="1">
                                <button type="button" class="increment">+</button>
                            </div>
                            <button type="submit" class="delete-from-bag" title="Удалить из корзины">
                                <i class="fas fa-trash"></i>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    <?php endfor; ?>
</div>
<script>
    function redirectToRegistration() {
        window.location.href = '/pozdeev/MVC-site/access';
    }
</script>
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<script>
    $(document).ready(function () {
        $(".increment, .decrement").click(function () {
            var $quantity = $(this).siblings(".quantity");
            var currentValue = parseInt($quantity.val());
            if ($(this).hasClass("increment")) {
                $quantity.val(currentValue + 1);
            } else {
                if (currentValue > 1) {
                    $quantity.val(currentValue - 1);
                }
            }

            // Обновляем итоговую стоимость
            updateTotalPrice();

            // Обновляем количество товаров
            updateTotalItems();
        });

        // Функция для обновления итоговой стоимости
        function updateTotalPrice() {
            var totalPrice = 0;
            $(".product-container").each(function () {
                var price = parseFloat($(this).find(".product-price").text());
                var quantity = parseInt($(this).find(".quantity").val());
                totalPrice += price * quantity;
            });
            $("#total-price").text(totalPrice.toFixed(2)); // Округляем до двух знаков после запятой
        }

        // Функция для обновления количества товаров
        function updateTotalItems() {
            var totalItems = 0;
            $(".product-container").each(function () {
                var quantity = parseInt($(this).find(".quantity").val());
                totalItems += quantity;
            });
            $("#total-items").text(totalItems);
        }
    });
</script>
</body>
</html>

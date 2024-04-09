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
            <form class="product-details"
                  action="<?php echo $isCatalog ? '/MVC-site/addToCart' : '/MVC-site/removeToCart'; ?>" method="POST">
                <div class="product-info">
                    <h1 class="product-title"><?php echo $products[$i]['name']; ?></h1>
                    <div class="product-price"><?php echo $products[$i]['price']; ?></div>
                </div>
                <p class="brand-name"><?php echo $products[$i]['brand']; ?></p>
                <textarea class="brand-name" name="productId"
                          id="productId"><?php echo $products[$i]['id']; ?></textarea>
                <div class="size-options">
                    <?php foreach ($products[$i]['sizes'] as $size): ?>
                        <div class="<?php echo $isCatalog ? 'size-selector' : 'selected-size'; ?>">
                            <input checked id="size-<?php echo $products[$i]['id'] . '-' . $size; ?>"
                                   name="size-<?php echo $products[$i]['id']; ?>" type="radio"
                                   value="<?php echo $size; ?>"/>
                            <label for="size-<?php echo $products[$i]['id'] . '-' . $size; ?>">
                                <?php echo $size; ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="actions">
                    <div class="buttons">
                        <?php if ($isCatalog): ?>
                            <?php if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true): ?>
                                <button type="submit" class="add-to-cart" title="Добавить в корзину">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                                <!--                                <i class="fas fa-shopping-cart"></i>-->
                                <!--                                </button>-->
                            <?php else: ?>
                                <button onclick="redirectToRegistration()" class="add-to-cart" type="button"
                                        title="Добавить в корзину">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            <?php endif; ?>
                        <?php else: ?>
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
        window.location.href = '/MVC-site/access';
    }
</script>
</body>
</html>


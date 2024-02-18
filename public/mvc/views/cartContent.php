<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Catalog</title>

    <link rel="stylesheet" href="<?= BASE_URL ?>mvc/views/css/cart.css">
    <script src="<?= BASE_URL ?>mvc/views/js/catalog.js"></script>
</head>

<body>
<div class="catalog-container">
    <div class="information">
        <p>Число товаров: <span id="total-items">0</span></p>
        <p>Итоговая стоимость: ₽<span id="total-price">0</span></p>
        <button class="payment-button" onclick="processPayment()">Оплатить</button>
    </div>
    <div class="cards-container">
        <?php include 'productCardCart.php'; ?>
        <?php include 'productCardCart.php'; ?>
    </div>
</div>
</body>

</html>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Catalog</title>

    <link rel="stylesheet" href="/MVC-site/views/_css/cart.css">
    <script src="/MVC-site/views/_js/payment.js"></script>
</head>

<body>
<div class="catalog-container">
    <div class="information">
        <p>Число товаров: <span id="total-items">0</span></p>
        <p>Итоговая стоимость: ₽<span id="total-price">0</span></p>
        <button class="payment-button" onclick="processPayment()">Оплатить</button>
        <!--        TO DO-->
    </div>
    <div class="cards-container">
        <!--        TO DO Здесь карточки товаров корзины-->
        <!--        --><?php //include ROOT . '/views/product/cart.php'; ?>
    </div>
</div>
</body>

</html>

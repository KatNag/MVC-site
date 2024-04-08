<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link rel="stylesheet" href="/MVC-site/views/_css/cart.css">
    <link rel="stylesheet" href="/MVC-site/views/_css/payment.css">

    <script src="/MVC-site/views/_js/paymentModal.js"></script>
    <script src="/MVC-site/views/_js/paymentFormat.js"></script>
</head>

<body>
<div class="catalog-container">
    <div class="information">
        <p>Число товаров: <span id="total-items">0</span></p>
        <p>Итоговая стоимость: ₽<span id="total-price">0</span></p>

        <button class="payment-button" id="payment-button" onclick="handlePaymentButtonClick()">Оплатить</button>
    </div>
    <div class="cards-container">
        <?php include ROOT . '/views/product/cart.php'; ?>
    </div>
</div>

<!-- Модальное окно для формы оплаты -->
<div id="payment-form" class="modal">
    <div class="container">
        <form action="/MVC-site/order" method="POST">
            <span class="close close-modal" onclick="closePaymentModal()"></span>
            <div class="row">
                <div class="col">
                    <h3 class="title">Оплата</h3>
                    <div class="inputBox">
                        <label for="name"> ФИО получателя: </label>
                        <input type="text" id="name" placeholder="Введите ФИО получателя" required minlength="10"
                               maxlength="70">
                    </div>

                    <div class="inputBox">
                        <label for="email">
                            Email:
                        </label>
                        <input type="email" id="email" required
                               value="<?php if ($_SESSION['login_success'] == true) {
                                   echo $_SESSION['email'];
                               } ?>" placeholder="example@mail.ru">
                    </div>

                    <div class="inputBox">
                        <label for="address"> Адрес: </label>
                        <input type="text" id="address" placeholder="Введите адрес" maxlength="150" required>
                    </div>

                    <div class="inputBox">
                        <label for="zip"> Почтовый индекс: </label>
                        <input type="text" id="zip" placeholder="123 456" minlength="7" maxlength="7" required>
                    </div>
                    <div class="error-message" id="zip-error"></div>

                </div>
                <div class="col">
                    <h3 class="title">₽₽₽</h3>

                    <div class="inputBox">
                        <label for="cardNum">Номер карты</label>
                        <input type="text" id="cardNum"
                               placeholder="1111-2222-3333-4444" minlength="19" maxlength="19" required>
                    </div>
                    <div class="error-message" id="cardNum-error"></div>

                    <div class="inputBox">
                        <label for="">Срок действия:</label>
                        <select name="" id="month">
                            <option value="Январь">Январь</option>
                            <option value="Февраль">Февраль</option>
                            <option value="Март">Март</option>
                            <option value="Апрель">Апрель</option>
                            <option value="Май">Май</option>
                            <option value="Июнь">Июнь</option>
                            <option value="Июль">Июль</option>
                            <option value="Август">Август</option>
                            <option value="Сентябрь">Сентябрь</option>
                            <option value="Октябрь">Октябрь</option>
                            <option value="Ноябрь">Ноябрь</option>
                            <option value="Декабрь">Декабрь</option>
                        </select>
                    </div>

                    <div class="flex">
                        <div class="inputBox">
                            <label for="">Срок действия</label>
                            <select name="" id="year">
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>
                        <div class="inputBox">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv"
                                   placeholder="123" minlength="3" maxlength="3" required>
                        </div>

                        <div class="error-message" id="date-error"></div>
                    </div>

                </div>

            </div>
            <button type="submit" class="submitButton">Оплачено</button>
            </button>
            <!--            TO DO: Запись заказа в БД-->
        </form>
    </div>
</div>
</body>

<script>
    function handlePaymentButtonClick() {
        if (<?php echo isset($_SESSION['login_success']) && $_SESSION['login_success'] === true ? 'true' : 'false'; ?>) {
            openPaymentModal();
        } else {
            window.location.href = '/MVC-site/access';
        }
    }
</script>
</html>

<?php

class CartController
{
    public static function actionIndex()
    {
        $pageTitle = "Корзина";
        $pageContent = [
            'header' => ROOT . '/views/header/header.php',
            'content' => ROOT . '/views/cart/cart.php',
            'footer' => ROOT . '/views/footer/footer.php'
        ];

        include($_SERVER['DOCUMENT_ROOT'] . '/MVC-site/views/cart/index.php');
        return true;
    }
}
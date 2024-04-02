<?php

class CartController
{
    public static function actionIndex()
    {
        $userId = $_SESSION['user_id'];

        global $pdo;

        // Создаем экземпляр класса Cart для работы с корзиной
        $cart = new Cart($pdo);

        // Получаем информацию о корзине текущего пользователя
        $userCart = $cart->getUserCart($userId);

        // Если у пользователя нет корзины, создаем новую
        if (!$userCart) {
            $cart->createCart($userId);
            // Получаем информацию о только что созданной корзине
            $userCart = $cart->getUserCart($userId);
        }

        // Получаем список продуктов в корзине текущего пользователя
        $products = $cart->getProductsInCart($userCart['id']);

        // Получаем общую сумму корзины текущего пользователя
        $cartTotal = $cart->getCartTotal($userCart['id']);

        $isCatalog = false;

        // Передаем данные в представление
        $pageTitle = "Корзина";
        $pageContent = [
            'header' => ROOT . '/views/header/header.php',
            'content' => ROOT . '/views/cart/cart.php',
            'footer' => ROOT . '/views/footer/footer.php',
            'productsInCart' => $products,
            'cartTotal' => $cartTotal,
            'isCatalog' => $isCatalog
        ];

        include($_SERVER['DOCUMENT_ROOT'] . '/MVC-site/views/cart/index.php');
        return true;
    }
}
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
        $userCart = $cart->getUserCartId($userId);

        // Если у пользователя нет корзины, создаем новую
        if (!$userCart) {
            $cart->createCart($userId);
            // Получаем информацию о только что созданной корзине
            $userCart = $cart->getUserCartId($userId);
        }

        // Получаем список продуктов в корзине текущего пользователя
        $products = $cart->getProductsInCart($userCart);

        // Получаем общую сумму корзины текущего пользователя
        $cartTotal = $cart->getCartTotal($userCart);

        // Создаем экземпляр класса Product для доступа к методу findBrandNameById
        $productObj = new Product($pdo);

        // Для каждого продукта получаем имя бренда и добавляем его в массив данных
        foreach ($products as &$product) {
            $product['brand'] = $productObj->findBrandNameById($product['brand_id']);
        }

        // Для каждого продукта получаем размеры и добавляем их в массив данных о продукте
        foreach ($products as &$product) {
            $product['sizes'] = Product::getProductSizes($product['id'], $pdo);
        }

        $isCatalog = false;

        // Передаем данные в представление
        $pageTitle = "Корзина";
        $pageContent = [
            'header' => ROOT . '/views/header/header.php',
            'content' => ROOT . '/views/cart/cart.php',
            'footer' => ROOT . '/views/footer/footer.php',
            'productsInCart' => $products,
         //   'cartTotal' => $cartTotal,
            'isCatalog' => $isCatalog
        ];

        include($_SERVER['DOCUMENT_ROOT'] . '/MVC-site/views/cart/index.php');
        return true;
    }
}
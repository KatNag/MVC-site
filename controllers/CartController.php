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

    public function actionRemoveToCart()
    {
        global $pdo;

        $productId = $_POST['productId'];

        header("Location: /MVC-site/cart");

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productId'])) {
            if (!isset($_SESSION['user_id'])) {
                return;
            }

            $productId = $_POST['productId'];

            $userId = $_SESSION['user_id'];
            // Создаем экземпляр класса Cart для работы с корзиной
            $cart = new Cart($pdo);

            // Получаем информацию о корзине текущего пользователя
            $userCartId = $cart->getUserCartId($userId);

            // Если у пользователя нет корзины, создаем новую
            if (!$userCartId) {
                $cart->createCart($userId);
                // Получаем информацию о только что созданной корзине
                $userCartId = $cart->getUserCartId($userId);
            }

            // Вызовите метод addToCart, передав productId
            $result = $cart->removeFromCart($userCartId, $productId);

            // Отправьте ответ клиенту
            if ($result) {

            } else {
                echo json_encode(['success' => false, 'error' => 'Ошибка при добавлении товара в корзину']);
            }
        }
    }
}
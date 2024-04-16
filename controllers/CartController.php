<?php

class CartController
{
    public static function actionIndex()
    {
        if (isset($_SESSION['login_success'])) {
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


            $j = 0;
            $tempProductId = 1;
            foreach ($products as &$product) {

                if ($tempProductId != $product['id']) {
                    $j = 0;
                }

                $sizes = $cart->getProductSizesFromCart($userCart, $product['id']);
                $product['sizes'] = [$sizes[$j]];

                $j += 1;

                $tempProductId = $product['id'];
            }

            $countInCart = $cart->getProductCountInCart($userCart);

            $isCatalog = false;

            // Передаем данные в представление
            $pageTitle = "Корзина";
            $pageContent = [
                'header' => ROOT . '/views/header/header.php',
                'content' => ROOT . '/views/cart/cart.php',
                'footer' => ROOT . '/views/footer/footer.php',
                'productsInCart' => $products,
                'cartTotal' => $cartTotal,
                'countInCart' => $countInCart,
                'isCatalog' => $isCatalog
            ];

            include($_SERVER['DOCUMENT_ROOT'] . '/pozdeev/MVC-site/views/cart/index.php');
            return true;
        } else {
            header("Location: /pozdeev/MVC-site/access");
            echo "<script>alert('Необходимо войти');</script>";
            return false;
        }
    }

    public function actionRemoveToCart()
    {
        global $pdo;

        $productId = $_POST['productId'];

        header("Location: /pozdeev/MVC-site/cart");

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productId'])) {
            if (!isset($_SESSION['user_id'])) {
                return;
            }

            $productId = $_POST['productId'];
            $productObj = new Product($pdo);
            $sizeScale = $_POST['size-' . $productId];
            $sizeScale = intval($sizeScale);

            $sizeId = $productObj->findSizeIdByScale($sizeScale);

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
            $result = $cart->removeFromCart($userCartId, $productId, $sizeId);

            // Отправьте ответ клиенту
            if ($result) {

            } else {
                echo json_encode(['success' => false, 'error' => 'Ошибка при добавлении товара в корзину']);
            }
        }
    }
}
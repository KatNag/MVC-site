<?php

class CatalogController
{
    public static function actionIndex()
    {
        $products = Product::getProducts();

        global $pdo;

        if (!$products) {
            echo "Ошибка загрузки данных о продуктах";
            return false;
        }

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

        $isCatalog = true;

        $pageTitle = "Каталог";
        $pageContent = [
            'header' => ROOT . '/views/header/header.php',
            'content' => ROOT . '/views/catalog/catalog.php',
            'footer' => ROOT . '/views/footer/footer.php',
            'products' => $products,
            'isCatalog' => $isCatalog
        ];

        $sizes = Product::getAllSizes();

        include($_SERVER['DOCUMENT_ROOT'] . '/MVC-site/views/catalog/index.php');
        return true;
    }

    public function actionAddToCart()
    {
        global $pdo;

        $productId = $_POST['productId'];


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
            $result = $cart->addToCart($userCartId, $productId);

            header("Location: /MVC-site/cart");
            // Отправьте ответ клиенту
            if ($result) {

            } else {
                echo json_encode(['success' => false, 'error' => 'Ошибка при добавлении товара в корзину']);
            }
        }
    }

}


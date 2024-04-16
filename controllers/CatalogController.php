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

        include($_SERVER['DOCUMENT_ROOT'] . '/pozdeev/MVC-site/views/catalog/index.php');
        return true;
    }

    public static function actionSortProducts()
    {
        global $pdo;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $gender = $_POST['gender-filter'];
            $price = $_POST['price-range'];
            $size = $_POST['size-filter'];
            $sort = $_POST['sort-options'];

            if ($sort === 'price-low') {
                $sort = 1;
            } elseif ($sort === 'price-high') {
                $sort = 2;
            }

            $products = Catalog::sortProducts($gender, $price, $size, $sort);

            if (!$products) {
                echo '<script>';
                echo 'alert("Нет товаров, удовлетворяющих выбранным критериям");';
                echo 'window.location.href = "/pozdeev/MVC-site/catalog";';
                echo '</script>';
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

            include($_SERVER['DOCUMENT_ROOT'] . '/pozdeev/MVC-site/views/catalog/index.php');
            return true;
        }
        return false;
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

            $check = $cart->isProductInCart($userCartId, $productId, $sizeId);

            if  ($check)
            {
                echo 'alert("Товар уже находится в вашей корзине");';
                echo 'window.location.href = "/pozdeev/MVC-site/catalog";';
            }
            // Вызовите метод addToCart, передав productId
            $result = $cart->addToCart($userCartId, $productId, $sizeId);

            // Отправьте ответ клиенту
            if ($result) {
                echo '<script>';
                echo 'alert("Товар успешно добавлен в корзину");';
                echo 'window.location.href = "/pozdeev/MVC-site/catalog";';
                echo '</script>';
            } else {
                echo json_encode(['success' => false, 'error' => 'Ошибка при добавлении товара в корзину']);
            }
        }
    }

}


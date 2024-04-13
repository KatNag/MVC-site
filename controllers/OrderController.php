<?php

class OrderController
{
    public static function actionIndex()
    {
        if (isset($_SESSION['login_success'])) {
            $userId = $_SESSION['user_id'];

            global $pdo;

            // Создаем экземпляр класса Cart для работы с корзиной
            $order = new Profile();

            // Получаем информацию о корзине текущего пользователя
            $userOrder = $order->getUserOrderId($userId);

            // Если у пользователя нет корзины, создаем новую
            if (!$userOrder) {
                $order->createOrder($userId);
                // Получаем информацию о только что созданной корзине
                $userOrder = $order->getUserOrderId($userId);
            }

            // Получаем список продуктов в корзине текущего пользователя
            $products = $order->getProductsInOrder($userOrder);

            // Создаем экземпляр класса Product для доступа к методу findBrandNameById
            $productObj = new Product($pdo);

            // Для каждого продукта получаем имя бренда и добавляем его в массив данных
            foreach ($products as &$product) {
                $product['brand'] = $productObj->findBrandNameById($product['brand_id']);
            }

            // to dol: Для каждого продукта получаем размеры и добавляем их в массив данных о продукте
            $j = 0;
            $tempProductId = 1;
            foreach ($products as &$product) {

                if ($tempProductId != $product['id']) {
                    $j = 0;
                }

                $sizes = $order->getProductSizesFromOrder($userOrder, $product['id']);
                $product['sizes'] = [$sizes[$j]];

                $j += 1;

                $tempProductId = $product['id'];
            }

            $countInOrder = $order->getProductCountInOrder($userOrder);

            // Передаем данные в представление
            $pageTitle = "Профиль";
            $pageContent = [
                'header' => ROOT . '/views/header/header.php',
                'content' => ROOT . '/views/profile/profile.php',
                'footer' => ROOT . '/views/footer/footer.php',
                'productsInOrder' => $products
                /*'countInOrder' => $countInOrder*/
            ];

            include($_SERVER['DOCUMENT_ROOT'] . '/MVC-site/views/profile/index.php');
            #header("Location: /MVC-site/profile");
            return true;
        } else {
            header("Location: /MVC-site/access");
        }
        exit;
    }

    public static function actionCreateOrder()
    {
        $userId = $_SESSION['user_id'];

        global $pdo;

        // Создаем экземпляр класса Cart для работы с корзиной
        $order = new Profile();

        // Получаем информацию о корзине текущего пользователя
        $userOrder = $order->getUserOrderId($userId);

        // Если у пользователя нет корзины, создаем новую
        if (!$userOrder) {
            $order->createOrder($userId);
            // Получаем информацию о только что созданной корзине
            $userOrder = $order->getUserOrderId($userId);
        }

        // Получаем список продуктов в корзине текущего пользователя
        $products = $order->getProductsInOrder($userOrder);

        // Создаем экземпляр класса Product для доступа к методу findBrandNameById
        $productObj = new Product($pdo);

        // Для каждого продукта получаем имя бренда и добавляем его в массив данных
        foreach ($products as &$product) {
            $product['brand'] = $productObj->findBrandNameById($product['brand_id']);
        }

        // to dol: Для каждого продукта получаем размеры и добавляем их в массив данных о продукте
        $j = 0;
        $tempProductId = 1;
        foreach ($products as &$product) {

            if ($tempProductId != $product['id']) {
                $j = 0;
            }

            $sizes = $order->getProductSizesFromOrder($userOrder, $product['id']);
            $product['sizes'] = [$sizes[$j]];

            $j += 1;

            $tempProductId = $product['id'];
        }

        $countInOrder = $order->getProductCountInOrder($userOrder);

        // Передаем данные в представление
        $pageTitle = "Профиль";
        $pageContent = [
            'header' => ROOT . '/views/header/header.php',
            'content' => ROOT . '/views/profile/profile.php',
            'footer' => ROOT . '/views/footer/footer.php',
            'productsInOrder' => $products,
            'countInOrder' => $countInOrder
        ];

        include($_SERVER['DOCUMENT_ROOT'] . '/MVC-site/views/profile/index.php');
        return true;
    }
}

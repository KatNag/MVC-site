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

        $pageTitle = "Каталог";
        $pageContent = [
            'header' => ROOT . '/views/header/header.php',
            'content' => ROOT . '/views/catalog/catalog.php',
            'footer' => ROOT . '/views/footer/footer.php',
            'products' => $products
        ];

        $sizes = Product::getAllSizes();

        include($_SERVER['DOCUMENT_ROOT'] . '/MVC-site/views/catalog/index.php');
        return true;
    }
}


<?php

class ProductController
{
    public function actionAddProduct()
    {
        $uploadDirectory = ROOT . '/public/images/photos/';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $fileName = preg_replace('/[^\w\-\.]/', '_', $fileName); // Заменяем недопустимые символы на подчеркивание

            if (!move_uploaded_file($_FILES["file"]["tmp_name"], $uploadDirectory . $fileName)) {
                echo 'Ошибка при загрузке файла.';
            }
        } else {
            echo 'Ошибка при загрузке файла.';
        } else {
            echo 'Файл не был загружен или произошла ошибка.';
        }
    }

//        // Получение данных из POST-запроса
//        $name = $_POST['name'];
//        $price = $_POST['price'];
//        $brandId = $_POST['brand'];
//        $gender = $_POST['gender'];
//        $sizes = $_POST['sizes'];
//        $imagePath = 'путь/к/изображению';
//
//        // Добавление нового товара в базу данных
//        $productModel = new ProductModel();
//        $productId = $productModel->addProduct($name, $price, $brandId, $gender, $imagePath);
//
//        // Добавление связей товара с размерами в таблицу product_sizes
//        foreach ($sizes as $sizeId) {
//            $productModel->addProductSize($productId, $sizeId);
//        }
//
//        // Возвращение соответствующего ответа
//        // Например, перенаправление на страницу со списком товаров
//        header('Location: /products');

}
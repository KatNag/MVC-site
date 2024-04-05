<?php

class ProductController
{
    public function actionAddProduct()
    {
        global $pdo;

        $uploadDirectory = ROOT . '/public/images/photos/';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fileName = $_FILES['file']['name'];
            $fileName = preg_replace('/[^\w\-\.]/', '_', $fileName); // Заменяем недопустимые символы на подчеркивание

            if (!move_uploaded_file($_FILES["file"]["tmp_name"], $uploadDirectory . $fileName)) {
                echo 'Ошибка при загрузке файла.';
                return false;
            } else {
                $imagePath = $uploadDirectory . $fileName;
            }
        } else {
            echo 'Ошибка при загрузке файла.';
            return false;
        } else {
            echo 'Файл не был загружен или произошла ошибка.';
            return false;
        }

        $imagePath = '/MVC-site/public/images/photos/' . $fileName;

        $name = $_POST['name'];
        $price = $_POST['price'];
        $brandId = intval($_POST['brand']);
        $gender = $_POST['gender'];
        $type = gettype($brandId);

        if ($gender === 'female') {
            $gender = 'ж';
        } else {
            $gender = 'м';
        }

        // Добавление нового товара в базу данных
        $productModel = new Product($pdo);
        $productId = $productModel->addProduct($name, $price, $gender, $brandId, $imagePath);

        // Добавление связей товара с размерами в таблицу product_sizes
        foreach ($_POST['sizes'] as $selectedSize) {
            $productModel->addProductSize($productId, $selectedSize);
        }

        header('Location: /MVC-site/admin');
    }
}
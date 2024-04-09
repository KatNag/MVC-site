<?php

class AdminController
{
    public static function actionIndex()
    {
        if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
            $pageTitle = "Панель администратора";
            $pageContent = [
                'content' => ROOT . '/views/admin/admin.php',
            ];

            $brands = Product::getAllBrands();
            $sizes = Product::getAllSizes();

            include($_SERVER['DOCUMENT_ROOT'] . '/MVC-site/views/admin/index.php');
            return true;
        } else {
            header("Location: /MVC-site/catalog");
            echo "<script>alert('Доступ запрещен.');</script>";
            return false;
        }

    }

}
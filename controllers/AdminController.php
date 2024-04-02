<?php

class AdminController
{
    public static function actionIndex()
    {
        $pageTitle = "Панель администратора";
        $pageContent = [
            'content' => ROOT . '/views/admin/admin.php',
        ];

        $brands = Product::getAllBrands();
        $sizes = Product::getAllSizes();

        include($_SERVER['DOCUMENT_ROOT'] . '/MVC-site/views/admin/index.php');
        return true;
    }

}
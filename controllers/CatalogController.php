<?php

class CatalogController
{
    public static function actionIndex()
    {
        $pageTitle = "Каталог";
        $pageContent = [
            'header' => ROOT . '/views/header/header.php',
            'content' => ROOT . '/views/catalog/catalog.php',
            'footer' => ROOT . '/views/footer/footer.php'
        ];

        include($_SERVER['DOCUMENT_ROOT'] . '/MVC-site/views/catalog/index.php');
        return true;
    }
}


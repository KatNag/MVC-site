<?php

class MainController
{
    public static function actionIndex()
    {
        $pageTitle = "Главная страница";
        $pageContent = [
            'header' => ROOT . '/views/header/header.php',
            'content' => ROOT . '/views/main/main.php',
            'footer' => ROOT . '/views/footer/footer.php'
        ];

        include($_SERVER['DOCUMENT_ROOT'] . '/MVC-site/views/main/index.php');
        return true;
    }
}


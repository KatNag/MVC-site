<?php

class AccessController
{
    public static function actionIndex()
    {
        $pageTitle = "Вход";
        $pageContent = [
            'content' => ROOT . '/views/access/access.php',
        ];

        include($_SERVER['DOCUMENT_ROOT'] . '/MVC-site/views/access/index.php');
        return true;
    }
}
<?php

class ProfileController
{
    public static function actionIndex()
    {
        $pageTitle = "Профиль";
        $pageContent = [
            'header' => ROOT . '/views/header/header.php',
            'content' => ROOT . '/views/profile/profile.php',
            'footer' => ROOT . '/views/footer/footer.php'
        ];

        include($_SERVER['DOCUMENT_ROOT'] . '/MVC-site/views/profile/index.php');
        return true;
    }

    public static function actionUpdate()
    {

    }
}
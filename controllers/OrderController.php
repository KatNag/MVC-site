<?php

class OrderController
{
    public static function actionIndex()
    {
        if ($_SESSION['login_success'] === false) {
            header("Location: /MVC-site/access");
        } else {
            header("Location: /MVC-site/profile");
        }
        exit;
    }
}

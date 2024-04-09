<?php

class OrderController
{
    public static function actionIndex()
    {
        if (isset($_SESSION['login_success'])) {
            header("Location: /MVC-site/profile");
        } else {
            header("Location: /MVC-site/access");
        }
        exit;
    }
}

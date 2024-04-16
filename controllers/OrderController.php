<?php

class OrderController
{
    public static function actionCreateOrder()
    {
        if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true) {
            $userId = $_SESSION['user_id'];

            global $pdo;

            $order = new Profile();
            $userOrder = $order->getUserOrderId($userId);

            if (!$userOrder) {
                $order->createOrder($userId);
                $userOrder = $order->getUserOrderId($userId);
            }

            $order->addToOrder($userId);

            header("Location: /pozdeev/MVC-site/profile");
            return true;
        } else {
            echo "Необходимо войти";
            header("Location: /pozdeev/MVC-site/access");
            return false;
        }
    }
}

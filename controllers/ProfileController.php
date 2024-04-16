<?php

class ProfileController
{
    public static function actionIndex()
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

            $products = $order->getProductsInOrder($userOrder);

            $productObj = new Product($pdo);

            foreach ($products as &$product) {
                $product['brand'] = $productObj->findBrandNameById($product['brand_id']);
            }

            $j = 0;
            $tempProductId = 1;
            foreach ($products as &$product) {

                if ($tempProductId != $product['id']) {
                    $j = 0;
                }

                $sizes = $order->getProductSizesFromOrder($userOrder, $product['id']);
                $product['sizes'] = [$sizes[$j]];

                $j += 1;

                $tempProductId = $product['id'];
            }

            $countInOrder = $order->getProductCountInOrder($userOrder);

            $pageTitle = "Профиль";
            $pageContent = [
                'header' => ROOT . '/views/header/header.php',
                'content' => ROOT . '/views/profile/profile.php',
                'footer' => ROOT . '/views/footer/footer.php',
                'products' => $products,
            ];

            include($_SERVER['DOCUMENT_ROOT'] . '/pozdeev/MVC-site/views/profile/index.php');
            return true;
        } else {
            echo "Необходимо войти";
            header("Location: /pozdeev/MVC-site/access");
            return false;
        }
    }

    public static function actionUpdateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $birthdate = $_POST['birthdate'];
            $gender = $_POST['gender'];

            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['gender'] = $gender;
            $_SESSION['birthdate'] = $birthdate;

            // Пытаемся обновить данные пользователя
            $result = (new Profile())->update($_SESSION['user_id'], $username, $email, $birthdate, $gender);

            if ($result) {
                $_SESSION['updateProfile_success'] = true;
                header("Location: /pozdeev/MVC-site/profile");
                exit;
            } else {
                echo "Ошибка при обновлении профиля";
            }
        }
    }

}

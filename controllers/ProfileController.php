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

            // Пытаемся зарегистрировать пользователя
            $result = (new Profile())->update($_SESSION['user_id'], $username, $email, $birthdate, $gender);

            if ($result) {
                $_SESSION['updateProfile_success'] = true;
                header("Location: /MVC-site/profile");
                exit;
            } else {
                echo "Ошибка при обновлении профиля";
            }
        }
    }

}

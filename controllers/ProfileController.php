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
//    function actionUpdateProfile()
//    {
//        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//            // Обновляем данные профиля
//            $profile = $this->getProfile();
//
//            echo "ауф";
//
//            $profile->username = $_POST['username'];
//            $profile->email = $_POST['email'];
//            $profile->birthdate = $_POST['birthdate'];
//            $profile->gender = $_POST['gender'];
//
//            // Вызываем метод update для обновления данных в базе данных
//            $result = $profile->update($profile);
//
//            // Проверяем успешность обновления профиля
//            if ($result) {
//                // Обновление прошло успешно, перенаправляем пользователя на страницу профиля
//                $_SESSION['profile'] = $profile;
//                header("Location: /MVC-site/profile.php");
//                exit;
//            } else {
//                // Обработка ошибки обновления профиля
//                echo "Ошибка обновления профиля";
//            }
//        }
//    }

}
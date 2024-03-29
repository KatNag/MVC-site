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

    public static function actionLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $user = (new Access)->getByEmail($email); // Возвращает данные вощедшего пользователя

            if ($user && password_verify($password, $user->password)) {
                // Если пользователь существует и пароль совпадает, аутентифицируем пользователя
                $_SESSION['user_id'] = $user->id;
                $_SESSION['username'] = $user->username;
                $_SESSION['email'] = $user->email;
                $_SESSION['gender'] = $user->gender;
                $_SESSION['birthdate'] = $user->birthdate;
                $_SESSION['login_success'] = true;

//                // Создаем объект профиля и заносим его в сессию
//                $profile = new Profile();
//                $profile->id = $user->id;
//                $profile->username = $user->username;
//                $profile->email = $user->email;
//                $profile->gender = $user->gender;
//                $profile->birthdate = $user->birthdate;
//                $_SESSION['profile'] = $profile;

                header("Location: /MVC-site/profile");
                exit;
            } else {
                echo "Неправильное имя пользователя или пароль";
            }
        }

    }

    public static function actionRegistration()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $birthdate = $_POST['birthdate'];
            $gender = $_POST['gender'];
            $password = $_POST['password'];

            if ($gender === 'female') {
                $gender = 'ж';
            } else {
                $gender = 'м';
            }

            // Хэшируем пароль
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // Пытаемся зарегистрировать пользователя
            $result = (new Access)->register($username, $email, $birthdate, $gender, $hashed_password);

            if ($result) {
                $_SESSION['registration_success'] = true;
                $_SESSION['username'] = $username;
                header("Location: /MVC-site/access");
                exit;
            } else {
                echo "Ошибка при регистрации пользователя";
            }
        }
    }

    public function actionLogout()
    {
        session_unset();
        session_destroy();
        header("Location: /MVC-site/access");
    }


}
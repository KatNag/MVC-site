<?php

class AccessController
{
    public static function actionIndex()
    {
        if (isset($_SESSION['login_success']) && $_SESSION['role_id'] == 1) {
            header("Location: /pozdeev/MVC-site/catalog");
            echo "<script>alert('Вы уже вошли');</script>";
        } else {
            $pageTitle = "Вход";
            $pageContent = [
                'content' => ROOT . '/views/access/access.php',
            ];

            include($_SERVER['DOCUMENT_ROOT'] . '/pozdeev/MVC-site/views/access/index.php');
            return true;
        }
    }

    public static function actionLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $user = (new Access)->getByEmail($email); // Возвращает данные вошедшего пользователя

            if ($user && password_verify($password, $user->password)) {
                // Если пользователь существует и пароль совпадает, аутентифицируем пользователя
                $_SESSION['user_id'] = $user->id;
                $_SESSION['username'] = $user->username;
                $_SESSION['email'] = $user->email;
                $_SESSION['role_id'] = $user->role_id;
                $_SESSION['gender'] = $user->gender;
                $_SESSION['birthdate'] = $user->birthdate;
                $_SESSION['login_success'] = true;

                header("Location: /pozdeev/MVC-site/profile");
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
                header("Location: /pozdeev/MVC-site/access");
                exit;
            } else {
                echo "Ошибка при регистрации пользователя";
                echo '<script>';
                echo 'alert("Пользователь с таким email уже зарегистрирован");';
                echo 'window.location.href = "/pozdeev/MVC-site/access";';
                echo '</script>';
            }
        }
    }

    public function actionLogout()
    {
        session_unset();
        session_destroy();
        header("Location: /pozdeev/MVC-site/access");
    }

}
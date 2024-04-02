<?php


class Access
{
    public static $table = 'users';

    public function register($username, $email, $birthdate, $gender, $password)
    {
        global $pdo;
        $success = false;
        if (empty($pdo)) {
            echo "Нет подключения к БД";
        }

        $user_data = [
            'username' => $username,
            'email' => $email,
            'birthdate' => $birthdate,
            'gender' => $gender,
            'password' => $password,
            'role_id' => 2
        ];

        if (isset($user_data) && !empty($user_data)) {
            $query = "INSERT INTO " . self::$table . " SET ";

            foreach ($user_data as $field => $value) {
                $query .= $field . ' = :' . $field . ', ';
            }

            $query = substr($query, 0, -2);
            $query .= ";";

            $q = $pdo->prepare($query);

            foreach ($user_data as $field => $value) {
                $q->bindValue(':' . $field, $value);
            }

            if ($q->execute()) {
                // Если регистрация пользователя прошла успешно, создаем для него корзину
                $userId = $pdo->lastInsertId(); // Получаем ID только что зарегистрированного пользователя
                $cart = new Cart($pdo); // Создаем экземпляр класса Cart
                $cart->createCart($userId); // Создаем корзину для пользователя
                $success = true;
            } else {
                echo "Ошибка при выполнении запроса";
            }
        } else {
            echo "Пустые пользовательские данные";
        }
        return $success;
    }

    public function login($email, $password)
    {
        global $pdo;
        $user = self::getByEmail($email);
        if (!empty($user)) {
            $auth = password_verify($password, $user['password_hash']);
        } else {
            $auth = false;
        }

        if ($auth === true) {
            return $user;
        } else {
            return false;
        }
    }

    public static function getByEmail($email)
    {
        global $pdo;
        try {
            $query = "SELECT * FROM " . self::$table . " WHERE email = :email";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            return $stmt->fetchObject(); // Возвращаем данные пользователя
        } catch (PDOException $e) {
            return false;
        }
    }
}

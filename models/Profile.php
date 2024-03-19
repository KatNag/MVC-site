<?php

class Profile
{
    public static $table = 'users';

    public function update($id, $username, $email, $birthdate, $gender)
    {
        global $pdo;
        $success = false;
        if (empty($pdo)) {
            echo "Нет подключения к БД";
        }

        try {
            $query = "UPDATE " . self::$table . " SET username = :username, email = :email, birthdate = :birthdate, gender = :gender WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':birthdate', $birthdate);
            $stmt->bindValue(':gender', $gender);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Обработка ошибки запроса
            error_log("Ошибка обновления данных: " . $e->getMessage(), 0);
            return false;
        }

    }
}

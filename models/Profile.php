<?php

class Profile
{
    public static $table = 'users';
    public $id;
    public $username;
    public $email;
    public $birthdate;

    public function update()
    {
        global $pdo;
        $success = false;
        if (empty($pdo)) {
            echo "Нет подключения к БД";
        }

        try {
            $query = "SELECT * FROM " . self::$table . " WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $stmt->fetchObject(); // Возвращаем данные пользователя
        } catch (PDOException $e) {
            return null;
        }


    }
}
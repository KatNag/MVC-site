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

    public function createOrder($userId)
    {
        global $pdo;
        try {
            // Создаем новую корзину для пользователя
            $query = "CALL CREATE_ORDERS(:userId)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();

            // Получаем идентификатор созданной корзины
            $orderId = $pdo->lastInsertId();

            return $orderId;
        } catch (PDOException $e) {
            // Обработка ошибки создания корзины
            error_log("Ошибка создания заказов: " . $e->getMessage(), 0);
            return false;
        }
    }

    public function addToOrder($userId): bool
    {
        global $pdo;
        try {
            // Добавляем продукт в корзину
            $query = "CALL CREATE_ORDERS(:userId)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            // Обработка ошибки добавления продукта в корзину
            error_log("Ошибка добавления продукта в заказы: " . $e->getMessage(), 0);
            return false;
        }
    }

    // Метод в классе Cart для получения списка продуктов в корзине по ее ID
    public function getProductsInOrder($orderId)
    {
        global $pdo;
        try {
            // Подготавливаем SQL-запрос для получения списка продуктов в корзине по ее ID
            $query = "SELECT * FROM products INNER JOIN order_has_products ON products.id = order_has_products.product_id WHERE order_has_products.order_id = :order_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
            $stmt->execute();

            // Возвращаем массив с данными о продуктах
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Обработка ошибки получения списка продуктов в корзине
            error_log("Ошибка получения списка продуктов в заказах" . $e->getMessage(), 0);
            return [];
        }
    }

    // Метод для получения корзины пользователя по его ID

    public function getUserOrderId($userId)
    {
        global $pdo;
        try {
            $query = "SELECT id FROM orders WHERE user_id = :user_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $order = $stmt->fetch(PDO::FETCH_ASSOC);
            return $order ? $order['id'] : null;
        } catch (PDOException $e) {
            error_log("Ошибка при получении идентификатора заказов пользователя: " . $e->getMessage());
            return null;
        }
    }

    public function getProductSizesFromOrder($orderId, $productId)
    {
        global $pdo;
        try {
            // Получаем все размеры продукта из таблицы cart_has_products
            $query = "SELECT size_id FROM order_has_products WHERE order_id = :order_id AND product_id = :product_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':order_id', $orderId);
            $stmt->bindValue(':product_id', $productId);
            $stmt->execute();
            $sizeIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Получаем размеры по size_id из таблицы sizes
            $sizes = [];
            foreach ($sizeIds as $sizeId) {
                $query = "SELECT scale FROM sizes WHERE id = :size_id";
                $stmt = $pdo->prepare($query);
                $stmt->bindValue(':size_id', $sizeId);
                $stmt->execute();
                $size = $stmt->fetch(PDO::FETCH_COLUMN);
                if ($size !== false) {
                    $sizes[] = $size;
                }
            }

            return $sizes;
        } catch (PDOException $e) {
            // Обработка ошибок, например, логирование и вывод сообщения об ошибке
            error_log("Ошибка получения размеров продукта из заказов: " . $e->getMessage(), 0);
            return [];
        }
    }

    public function getProductCountInOrder($orderId)
    {
        global $pdo;
        try {
            // Подготовка запроса для получения общего количества товаров в корзине cart_id
            $query = "SELECT COUNT(*) AS count FROM order_has_products WHERE order_id = :order_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
            $stmt->execute();

            // Получение результата запроса
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Возвращаем общее количество товаров или 0, если ничего не найдено
            return $result['count'] ?? 0;
        } catch (PDOException $e) {
            // Обработка ошибки, например, логирование и вывод сообщения об ошибке
            error_log("Ошибка при получении общего количества товаров в заказах: " . $e->getMessage(), 0);
            return 0;
        }
    }
}

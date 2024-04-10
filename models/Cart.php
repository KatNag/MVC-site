<?php

class Cart
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createCart($userId)
    {
        try {
            // Создаем новую корзину для пользователя
            $query = "INSERT INTO carts (user_id) VALUES (:user_id)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();

            // Получаем идентификатор созданной корзины
            $cartId = $this->pdo->lastInsertId();

            return $cartId;
        } catch (PDOException $e) {
            // Обработка ошибки создания корзины
            error_log("Ошибка создания корзины: " . $e->getMessage(), 0);
            return false;
        }
    }

    public function addToCart($cartId, $productId, $sizeId): bool
    {
        try {
            // Добавляем продукт в корзину
            $query = "INSERT INTO cart_has_products (cart_id, product_id, size_id) VALUES (:cart_id, :product_id, :size_id)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':cart_id', $cartId, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $stmt->bindParam(':size_id', $sizeId, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            // Обработка ошибки добавления продукта в корзину
            error_log("Ошибка добавления продукта в корзину: " . $e->getMessage(), 0);
            return false;
        }
    }

    public function removeFromCart($cartId, $productId, $sizeId): bool
    {
        try {
            // Удаляем продукт из корзины по его product_id и size_id
            $query = "DELETE FROM cart_has_products WHERE cart_id = :cart_id AND product_id = :product_id AND size_id = :size_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':cart_id', $cartId, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $stmt->bindParam(':size_id', $sizeId, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            // Обработка ошибки удаления продукта из корзины
            error_log("Ошибка удаления продукта из корзины: " . $e->getMessage(), 0);
            return false;
        }
    }


    public function removeProductFromCart($cartId, $productId)
    {
        try {
            // Удаляем продукт из корзины
            $query = "DELETE FROM cart_has_products WHERE cart_id = :cart_id AND product_id = :product_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':cart_id', $cartId, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            // Обработка ошибки удаления продукта из корзины
            error_log("Ошибка удаления продукта из корзины: " . $e->getMessage(), 0);
            return false;
        }
    }

    // Метод в классе Cart для получения списка продуктов в корзине по ее ID
    public function getProductsInCart($cartId)
    {
        try {
            // Подготавливаем SQL-запрос для получения списка продуктов в корзине по ее ID
            $query = "SELECT p.* FROM products p INNER JOIN cart_has_products chp ON p.id = chp.product_id WHERE chp.cart_id = :cart_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':cart_id', $cartId, PDO::PARAM_INT);
            $stmt->execute();

            // Возвращаем массив с данными о продуктах
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Обработка ошибки получения списка продуктов в корзине
            error_log("Ошибка получения списка продуктов в корзине: " . $e->getMessage(), 0);
            return [];
        }
    }

    public function getProductById($productId)
    {
        try {
            // Подготавливаем SQL-запрос для получения данных о продукте по его ID
            $query = "SELECT * FROM products WHERE id = :product_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $stmt->execute();

            // Возвращаем ассоциативный массив с данными о продукте
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Обработка ошибки получения данных о продукте
            error_log("Ошибка получения данных о продукте: " . $e->getMessage(), 0);
            return [];
        }
    }

    public function clearCart($cartId)
    {
        try {
            // Удаляем все продукты из корзины по её ID
            $query = "DELETE FROM cart_has_products WHERE cart_id = :cart_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':cart_id', $cartId, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            // Обработка ошибки очистки корзины
            error_log("Ошибка очистки корзины: " . $e->getMessage(), 0);
            return false;
        }
    }

    public function getCartTotal($cartId)
    {
        try {
            // Получаем общую сумму продуктов в корзине по её ID
            $query = "SELECT SUM(price) AS total FROM products WHERE id IN (SELECT product_id FROM cart_has_products WHERE cart_id = :cart_id)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':cart_id', $cartId, PDO::PARAM_INT);
            $stmt->execute();

            // Извлекаем значение общей суммы из результата запроса
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['total'] ?? 0; // Возвращаем общую сумму или 0, если результат не найден
        } catch (PDOException $e) {
            // Обработка ошибки получения общей суммы корзины
            error_log("Ошибка получения общей суммы корзины: " . $e->getMessage(), 0);
            return 0;
        }
    }

    public function deleteCart($cartId)
    {
        try {
            // Удаляем корзину по её ID
            $query = "DELETE FROM carts WHERE id = :cart_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':cart_id', $cartId, PDO::PARAM_INT);
            $stmt->execute();

            // Удаляем также все продукты из связанной таблицы carts_has_products
            $this->clearCart($cartId);

            return true;
        } catch (PDOException $e) {
            // Обработка ошибки удаления корзины
            error_log("Ошибка удаления корзины: " . $e->getMessage(), 0);
            return false;
        }
    }

    // Метод для получения корзины пользователя по его ID
    public function getUserCart($userId)
    {
        try {
            $query = "SELECT * FROM carts WHERE user_id = :user_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Ошибка при получении корзины пользователя: " . $e->getMessage());
            return false;
        }
    }

    public function getUserCartId($userId)
    {
        try {
            $query = "SELECT id FROM carts WHERE user_id = :user_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $cart = $stmt->fetch(PDO::FETCH_ASSOC);
            return $cart ? $cart['id'] : null;
        } catch (PDOException $e) {
            error_log("Ошибка при получении идентификатора корзины пользователя: " . $e->getMessage());
            return null;
        }
    }

    public function getProductSizesFromCart($cartId, $productId)
    {
        try {
            // Получаем все размеры продукта из таблицы cart_has_products
            $query = "SELECT size_id FROM cart_has_products WHERE cart_id = :cart_id AND product_id = :product_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':cart_id', $cartId);
            $stmt->bindValue(':product_id', $productId);
            $stmt->execute();
            $sizeIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Получаем размеры по size_id из таблицы sizes
            $sizes = [];
            foreach ($sizeIds as $sizeId) {
                $query = "SELECT scale FROM sizes WHERE id = :size_id";
                $stmt = $this->pdo->prepare($query);
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
            error_log("Ошибка получения размеров продукта из корзины: " . $e->getMessage(), 0);
            return [];
        }
    }

    public function getProductCountInCart($cartId)
    {
        try {
            // Подготовка запроса для получения общего количества товаров в корзине cart_id
            $query = "SELECT COUNT(*) AS count FROM cart_has_products WHERE cart_id = :cart_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':cart_id', $cartId, PDO::PARAM_INT);
            $stmt->execute();

            // Получение результата запроса
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Возвращаем общее количество товаров или 0, если ничего не найдено
            return $result['count'] ?? 0;
        } catch (PDOException $e) {
            // Обработка ошибки, например, логирование и вывод сообщения об ошибке
            error_log("Ошибка при получении общего количества товаров в корзине: " . $e->getMessage(), 0);
            return 0;
        }
    }


}
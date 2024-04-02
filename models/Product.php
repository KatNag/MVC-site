<?php

class Product
{
    // Подключение к базе данных
    private $db;

    // Конструктор класса
    public function __construct($db)
    {
        $this->db = $db;
    }

    // Функция для поиска имени бренда по его ID

    public static function addProduct($name, $price, $gender, $brand_id, $image_path)
    {
        global $pdo;

        try {
            $query = "INSERT INTO products (name, price, gender, brand_id, image_path) VALUES (:name, :price, :gender, :brand_id, :image_path)";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':price', $price);
            $stmt->bindValue(':gender', $gender);
            $stmt->bindValue(':brand_id', $brand_id);
            $stmt->bindValue(':image_path', $image_path);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Ошибка добавления товара: " . $e->getMessage(), 0);
            return false;
        }
    }

    public static function addBrand($name)
    {
        global $pdo;

        try {
            $query = "INSERT INTO brands (name) VALUES (:name)";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':name', $name);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Ошибка добавления бренда: " . $e->getMessage(), 0);
            return false;
        }
    }

    public static function getProducts()
    {
        global $pdo;

        try {
            $query = "SELECT * FROM products";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Ошибка получения списка товаров: " . $e->getMessage(), 0);
            return [];
        }
    }

    public static function getProductSizes($productId, $pdo)
    {
        global $pdo;

        try {
            $query = "SELECT sizes.scale FROM product_sizes 
                      INNER JOIN sizes ON product_sizes.size_id = sizes.id 
                      WHERE product_sizes.product_id = :product_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':product_id', $productId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            // Обработка ошибок, например, логирование и вывод сообщения об ошибке
            error_log("Ошибка получения размеров продукта: " . $e->getMessage(), 0);
            return [];
        }
    }

    public static function getAllBrands()
    {
        global $pdo;

        try {
            $query = "SELECT * FROM brands";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Ошибка получения списка брендов: " . $e->getMessage(), 0);
            return [];
        }
    }

    public static function getAllSizes()
    {
        global $pdo;

        try {
            $query = "SELECT * FROM sizes";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Ошибка получения списка размеров: " . $e->getMessage(), 0);
            return [];
        }
    }


    public function findBrandNameById($brandId)
    {
        // Выполняем SQL запрос для получения имени бренда по его ID
        $sql = "SELECT name FROM brands WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $brandId, PDO::PARAM_INT);
        $stmt->execute();

        // Получаем результат запроса
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Возвращаем имя бренда, если оно найдено
        if ($result) {
            return $result['name'];
        } else {
            return null; // Если бренд не найден
        }
    }

}

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
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Ошибка добавления товара: " . $e->getMessage(), 0);
            return false;
        }
    }

    public static function addProductSize($product_id, $size_id)
    {
        global $pdo;

        try {
            $query = "INSERT INTO product_sizes (product_id, size_id) VALUES (:product_id, :size_id)";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':product_id', $product_id);
            $stmt->bindValue(':size_id', $size_id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Ошибка добавления размера: " . $e->getMessage(), 0);
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

    /*public static function sortProducts($gender, $price, $size)
    {
        global $pdo;

        try {
/*            $querySize = "SELECT sizes.id FROM sizes WHERE sizes.scale = :size";
            $stmtSize = $pdo->prepare($querySize);
            $stmtSize->execute();
            $size_id = $stmtSize->fetchAll(PDO::FETCH_ASSOC);*/
            /*$query = "SELECT * FROM products WHERE
                           (products.gender = :gender
                                AND products.price < :price
                               AND products.id IN (SELECT product_sizes.product_id FROM product_sizes where product_sizes.size_id = :size_id)) 
                       ORDER BY price :sort";
            $query = "CALL FILTER_SORT(:gender, :price, :size, 1)";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Ошибка получения списка товаров: " . $e->getMessage(), 0);
            return [];
        }
    }*/

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

    public static function findSizeIdByScale($sizeScale)
    {
        global $pdo;

        try {
            // Выполняем SQL запрос для получения id размера по его размеру
            $sql = "SELECT id FROM sizes WHERE scale = :sizeScale";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':sizeScale', $sizeScale, PDO::PARAM_INT);
            $stmt->execute();

            // Получаем результат запроса
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Возвращаем id размера, если оно найдено
            if ($result) {
                return $result['id'];
            } else {
                return null; // Если размер не найден
            }
        } catch (PDOException $e) {
            error_log("Ошибка получения id размера" . $e->getMessage(), 0);
            return [];
        }
    }
}

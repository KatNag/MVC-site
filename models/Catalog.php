<?php

class Catalog
{
    public static function sortProducts($gender, $price, $size, $sort)
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
                       ORDER BY price :sort";*/
            $query = "CALL FILTER_SORT(:gender, :price, :size, :sort)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':size', $size);
            $stmt->bindParam(':sort', $sort);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Ошибка получения списка товаров: " . $e->getMessage(), 0);
            return [];
        }
    }

}
<?php

class Catalog
{
    public static function sortProducts($gender, $price, $size, $sort)
    {
        global $pdo;

        try {
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
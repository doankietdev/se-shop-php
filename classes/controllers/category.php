<?php
require_once dirname(__DIR__) . "/services/message.php";
class Category extends Message
{

    public $id;
    public $name;
    public $description;
    public $createdAt;
    public $updatedAt;

    public function __construct($id, $name, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    public static function createCategory($conn, $categoryData)
    {
        /**
         * Write your code here
         */
    }

    public static function updateCategory($conn, $categoryData)
    {
        /**
         * Write your code here
         */
    }

    public static function deleteCategory($conn, $categoryId)
    {
        /**
         * Write your code here
         */
    }

    public static function getAllCategories($conn)
    {
        $query = "SELECT * FROM categories";
        try {
            $stmt = $conn->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Category");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return Message::message(false, "Can not get all categories" . $e->getMessage());
        }
    }
}

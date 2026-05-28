<?php

require_once __DIR__ . "/BaseModel.php";

class CategoryModel extends BaseModel
{
    protected $table = "categories";

    public function getAll()
    {
        $sql = "
            SELECT *
            FROM categories
            ORDER BY id DESC
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $sql = "
            SELECT *
            FROM categories
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name)
    {
        $sql = "
            INSERT INTO categories(name)
            VALUES(?)
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$name]);
    }

    public function updateCategory($id, $name)
    {
        $sql = "
            UPDATE categories
            SET name = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$name, $id]);
    }

    public function hasProducts($id)
    {
        $sql = "
            SELECT COUNT(*)
            FROM products
            WHERE category_id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetchColumn() > 0;
    }

    public function deleteCategory($id)
    {
        $sql = "
            DELETE FROM categories
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$id]);
    }
}
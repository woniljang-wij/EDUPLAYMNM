<?php

require_once "./app/config/database.php";

class ProfileController
{
    private $db;

    public function __construct()
    {
        if (!isset($_SESSION["user"])) {

            header(
                "Location: /NguyenNhatTruong_2393/Auth/login"
            );

            exit;
        }

        $database = new Database();

        $this->db = $database->connect();
    }

    // ================= PROFILE =================

    public function index()
    {
        $user = $_SESSION["user"];

        $query = "
            SELECT *
            FROM orders
            WHERE user_id = :user_id
            ORDER BY created_at DESC
        ";

        $stmt = $this->db->prepare($query);

        $stmt->execute([
            ":user_id" => $user["id"]
        ]);

        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require "./app/views/profile/index.php";
    }
}
?>
<?php

require_once "./app/models/UserModel.php";

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // ================= LOGIN =================
    public function login()
    {
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $email = trim($_POST["email"]);

            $password = md5($_POST["password"]);

            $user = $this->userModel->login(
                $email,
                $password
            );

            if ($user) {

                $_SESSION["user"] = $user;

                // ===== ROLE =====
                if ($user["role"] === "admin") {

                    header(
                        "Location: /NguyenNhatTruong_2393/Admin/dashboard"
                    );

                } else {

                    header(
                        "Location: /NguyenNhatTruong_2393/Product/list"
                    );
                }

                exit;

            } else {

                $_SESSION["login_error"] =
                    "Sai email hoặc mật khẩu";

                header(
                    "Location: /NguyenNhatTruong_2393/Product/list"
                );

                exit;
            }
        }

        require "./app/views/auth/login.php";
    }

    // ================= REGISTER =================
    public function register()
    {
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $username = trim($_POST["username"]);

            $email = trim($_POST["email"]);

            $password = trim($_POST["password"]);

            // ===== VALIDATE =====

            if (empty($username)) {

                $errors[] = "Tên người dùng là bắt buộc";
            }

            if (empty($email)) {

                $errors[] = "Email là bắt buộc";
            }

            if (empty($password)) {

                $errors[] = "Mật khẩu là bắt buộc";
            }

            // ===== CHECK EMAIL =====

            $checkEmail = $this->userModel->findByEmail($email);

            if ($checkEmail) {

                $errors[] = "Email đã tồn tại";
            }

            // ===== CREATE =====

            if (empty($errors)) {

                $password = md5($password);

                $this->userModel->createUser(
                    $username,
                    $email,
                    $password
                );

                $_SESSION["toast"] = [
                    "message" => "Đăng ký thành công",
                    "type" => "success"
                ];

                header(
                    "Location: /NguyenNhatTruong_2393/Auth/login"
                );

                exit;
            }
        }

        require "./app/views/auth/register.php";
    }

    // ================= LOGOUT =================
    public function logout()
    {
        session_destroy();

        header(
            "Location: /NguyenNhatTruong_2393/Auth/login"
        );

        exit;
    }
}
?>
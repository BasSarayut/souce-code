<?php
session_start();
require_once 'connection/connect.php';

if (isset($_POST['signin'])) {

    $email_account = $_POST['email_account'];
    $password_account = $_POST['password_account'];


    if (empty($email_account)) {
        $_SESSION['error'] = 'กรอกชื้อ email';
        header("location: signin.php");
    } else if (!filter_var($email_account, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'รูปแบบ email ผิด';
        header("location: signin.php");
    } else if (empty($password_account)) {
        $_SESSION['error'] = 'กรอกชื้อ';
        header("location: signin.php");
    } else if (strlen($_POST['password_account']) > 20 || strlen($_POST['password_account']) < 5) {
        $_SESSION['error'] = 'รหัสผ่านไม่ถูกต้อง';
        header("location: signin.php");
    } else {


        try {

            $check_data = $conn->prepare("SELECT email_account FROM account WHERE email_account = :email_account");
            $check_data->bindParam(":email_account", $email_account);
            $check_data->execute();
            $row = $check_data->fetch(PDO::FETCH_ASSOC);

            if ($check_data->rowCount() > 0) {

                if ($email_account == $row['email_account']) {
                    if (password_verify($password_account, $row['password_account'])) {
                        $_SESSION['error'] = 'รหัสผ่านผิด';
                        header("location: signin.php");
                    } else {
                        $_SESSION['success']= 'ถูกต้อง';
                        die(header("location: home.php"));
                    }
                } else {
                    $_SESSION['error'] = 'email ผิด';
                    header("location: signin.php");
                }
            } else {
                $_SESSION['error'] = 'ไม่มีข้อมูลในระบบ';
                    header("location: signin.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

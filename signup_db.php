<?php
session_start();
require_once 'connection/connect.php';
if (isset($_POST['signup'])) {
    $username_account = $_POST['username_account'];
    $email_account = $_POST['email_account'];
    $password_account = $_POST['password_account'];
    $confirm_account = $_POST['confirm_account'];

    if (empty($username_account)) {
        $_SESSION['error'] = 'กรอกชื้อ username';
        header("location: index.php");
    } else if (empty($email_account)) {
        $_SESSION['error'] = 'กรอกชื้อ email';
        header("location: index.php");
    } else if (!filter_var($email_account, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'รูปแบบ email ผิด';
        header("location: index.php");
    } else if (empty($password_account)) {
        $_SESSION['error'] = 'กรอกรหัสผิด';
        header("location: index.php");
    } else if (strlen($_POST['password_account']) > 20 || strlen($_POST['password_account']) < 5) {
        $_SESSION['error'] = 'รหัสผ่านไม่ถูกต้อง';
        header("location: index.php");
    } else if (empty($confirm_account)) {
        $_SESSION['error'] = 'ยืนยันรหัสผ่าน';
        header("location: index.php");
    } else if ($password_account != $confirm_account) {
        $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
        header("location: index.php");
    } else {


        try {

            $check_email = $conn->prepare("SELECT email_account FROM account WHERE email_account = :email_account");
            $check_email->bindParam(":email_account", $email_account);
            $check_email->execute();
            $row = $check_email->fetch(PDO::FETCH_ASSOC);

            if ($row['email_account'] == $email_account) {
                $_SESSION['warning'] = "มี email นี้อยู่ในระบบแล้ว <a href ='signin.php'>LOGIN</a>";
                header("location: index.php");
            } elseif (!isset($_SESSION['error'])) {
                $passwordHash = password_hash($password_account, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO account(username_account, email_account, password_account) VALUES(:username_account, :email_account, :password_account)");

                $stmt->bindParam(":username_account", $username_account);
                $stmt->bindParam(":email_account", $email_account);
                $stmt->bindParam(":password_account", $passwordHash);

                $stmt->execute();
                $_SESSION['success'] = "สมัครเรียบร้อยแล้ว <a  href ='signin.php' class='alert-link'>คลิกที่นี้เพื่อเข้าสู้ระบบ</a>";
                die(header("location: index.php"));
            } else {
                $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                header("location: index.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

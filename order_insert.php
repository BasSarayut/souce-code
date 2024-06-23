<?php

session_start();
require_once("C:/xampp/htdocs/Proj3k/connection/connect.php");

if (isset($_POST['submit'])) {
    $details = $_POST['details'];
    $types = $_POST['types'];
    $order_date = $_POST['order_date'];
    $price = $_POST['price'];




    $sql = $conn->prepare("INSERT INTO orders (details, types, order_date, price) VALUES (:details, :types, :order_date, :price)");
    $sql->bindParam(":details", $details);
    $sql->bindParam(":types", $types);
    $sql->bindParam(":order_date", $order_date);
    $sql->bindParam(":price", $price);
    $sql->execute();

    if ($sql) {
        $_SESSION['success'] = "Data has been inserted succesfully ";
        header("Location: order_index.php");
    } else {
        $_SESSION['error'] = "Data has  not been inserted succesfully";
        header("Location: order_index.php");
    }
}

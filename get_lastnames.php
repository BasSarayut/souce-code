<?php
// เลือกfirstname แล้ว จะเลือกlastname ให้อัตโนมัติ
session_start();
require_once("C:/xampp/htdocs/Proj3k/connection/connect.php");

if (isset($_GET['firstname'])) {
    $selectedFirstName = $_GET['firstname'];
    $stmt = $conn->prepare("SELECT DISTINCT lastname FROM customer WHERE firstname = :firstname");
    $stmt->bindParam(":firstname", $selectedFirstName);
    $stmt->execute();
    $lastnames = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    echo json_encode($lastnames);
}
?>

<?php

session_start();
require_once("C:/xampp/htdocs/Proj3k/connection/connect.php");

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $details = $_POST['details'];
    $types = $_POST['types'];
    $order_date = $_POST['order_date'];
    $price = $_POST['price'];


    $sql = $conn->prepare("UPDATE orders SET details = :details, types = :types, order_date = :order_date, price = :price WHERE task_id = :id");
    $sql->bindParam(":id", $id);
    $sql->bindParam(":details", $details);
    $sql->bindParam(":types", $types);
    $sql->bindParam(":order_date", $order_date);
    $sql->bindParam(":price", $price);
    $sql->execute();

    if ($sql) {
        $_SESSION['success'] = "Data has been updated succesfully ";
        header("Location: order_index.php");
    } else {
        $_SESSION['error'] = "Data has  not been updated succesfully";
        header("Location: order_index.php");
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <h1>Edit</h1>
        <hr>
        <form action="order_edit.php" method="post">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $stmt = $conn->prepare("SELECT customer.id, customer.firstname, customer.lastname, orders.details, orders.types, orders.order_date, orders.price FROM customer INNER JOIN orders ON customer.id = orders.task_id WHERE customer.id = :id");
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                $data = $stmt->fetch();
            }


            ?>
            <input type="text" hidden value="<?= $data['id']; ?>" required class="form-control" name="id">
            <label for="firstname" class="col-form-label">ชื่อ:</label>
            <input type="text" value="<?= $data['firstname']; ?>" required class="form-control" name="firstname" disabled>
            <label for="lastname" class="col-form-label">สกุล:</label>
            <input type="text" value="<?= $data['lastname']; ?>" required class="form-control" name="lastname" disabled>
            <label for="details" class="col-form-label">รายละเอียด:</label>
            <input type="text" value="<?= $data['details']; ?>" required class="form-control" name="details">
            <label for="types" class="col-form-label">ประเภทงาน:</label>
            <input type="text" value="<?= $data['types']; ?>" required class="form-control" name="types">
            <label for="order_date" class="col-form-label">วันที่:</label>
            <input type="date" value="<?= $data['order_date']; ?>" required class="form-control" name="order_date">
            <label for="price" class="col-form-label">ราคา:</label>
            <input type="text" value="<?= $data['price']; ?>" required class="form-control" name="price">


            <div class="modal-footer">
                <a class="btn btn-secondary" href="order_index.php">ย้อนกลับ</a>
                <button type="submit" name="update" class="btn btn-primary">อัพเดท</button>
            </div>
        </form>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
<?php

session_start();
require_once("C:/xampp/htdocs/Proj3k/connection/connect.php");
// ลบข้อมูล
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $deletestmt = $conn->prepare("DELETE FROM orders WHERE task_id = :task_id");
    $deletestmt->bindParam(":task_id", $delete_id);
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('Data has been deleted successfully');</script>";
        $_SESSION['success'] = "Data has been deleted succesfully";
        header("refresh:1; url=order_index.php");
    }
}


if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    // เพิ่มข้อมูลลูกค้าไปยังฐานข้อมูล
    $insertstmt = $conn->prepare("INSERT INTO customer (firstname, lastname) VALUES (:firstname, :lastname)");
    $insertstmt->bindParam(":firstname", $firstname);
    $insertstmt->bindParam(":lastname", $lastname);
    $insertstmt->execute();

    if ($insertstmt) {
        $_SESSION['success'] = "Data has been inserted successfully";
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Data has not been inserted successfully";
        header("Location: index.php");
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .sidebar ul {
      list-style: none;
      padding: 0;
    }

    .sidebar li {
      padding: 10px 0;
    }

    .sidebar a {
      color: #fff;
      text-decoration: none;
    }
    .sidebar {
        background-color: #333; /* สีพื้นหลัง */
        color: #fff; /* สีตัวอักษร */
        width: 200px; /* ความกว้างของ sidebar */
        position: fixed;
        height: 100%;
        overflow: auto; /* เพื่อให้มีการสกอลขึ้นลง */
    }

    .sidebar h2 {
        text-align: center;
        padding: 20px 0;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
    }

    .sidebar li {
        padding: 10px 0;
    }

    .sidebar a {
        color: #fff;
        text-decoration: none;
    }

    .sidebar a:hover {
        color: #00f; /* เปลี่ยนสีเมื่อนำเมาส์มาวางเหนือลิงค์ */
    }

    .btn-primary {
            background-color: #17a2b8;
            border: none;
        }

        .btn-primary:hover {
            background-color: #117a8b;
        }

        .modal-content {
            border-radius: 0;
        }

        .modal-header {
            background-color: #17a2b8;
            color: #fff;
        }

        .modal-body {
            background-color: #f8f9fa;
        }

        /* Add your custom styles for the main content */
        .container {
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            margin-bottom: 20px;
            color: #333;
        }

        .alert {
            margin-bottom: 20px;
        }

        .table {
            background-color: #fff;
        }

        th {
            background-color: #17a2b8;
            color: #fff;
        }

        .btn-warning, .btn-danger {
            margin-right: 5px;
        }
</style>
</head>

<body>
    <div class="sidebar">
        <h2 style="text-align: center;">จัดการงาน</h2>
        <ul>
            <li><a href="./layout_home.php"><i class="fas fa-home"></i>หน้าหลัก</a></li>
            <li><a href="./customer_index.php"><i class="fas fa-user"></i>ลูกค้า</a></li>
            <li><a href="./order_index.php"><i class="fas fa-shopping-cart"></i>จัดการงาน</a></li>
        </ul>
        <div class="social_media">

        </div>
    </div>
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มงาน</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="order_insert.php" method="post">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h2 class="mb-4">ข้อมูลงาน</h2>
                                <!-- ชื่อ -->
                                <div class="mb-3">
                                    <label for="firstname" class="form-label">ชื่อ:</label>
                                    <select class="form-select" name="firstname" id="firstname" required>
                                        <?php
                                        $stmt = $conn->query("SELECT DISTINCT firstname FROM customer");
                                        $stmt->execute();
                                        $firstnames = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
                                        foreach ($firstnames as $fn) {
                                            echo "<option value=\"$fn\">$fn</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- สกุล -->
                                <div class="mb-3">
                                    <label for="lastname" class="form-label">สกุล:</label>
                                    <select class="form-select" name="lastname" id="lastname" required>
                                        <?php
                                        $stmt = $conn->query("SELECT DISTINCT lastname FROM customer");
                                        $stmt->execute();
                                        $lastnames = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
                                        foreach ($lastnames as $ln) {
                                            echo "<option value=\"$ln\">$ln</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- รายละเอียด -->
                                <div class="mb-3">
                                    <label for="details" class="form-label">รายละเอียด:</label>
                                    <input type="text" required class="form-control" name="details">
                                </div>
                                <!-- ประเภทงาน -->
                                <div class="mb-3">
                                    <label for="types" class="form-label">ประเภทงาน:</label>
                                    <input type="text" required class="form-control" name="types">
                                </div>
                                <!-- วันที่ -->
                                <div class="mb-3">
                                    <label for="order_date" class="form-label">วันที่:</label>
                                    <input type="date" required class="form-control" name="order_date">
                                </div>
                                <!-- ราคา -->
                                <div class="mb-3">
                                    <label for="price" class="form-label">ราคา:</label>
                                    <input type="text" required class="form-control" name="price">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="submit" name="submit" class="btn btn-primary">ยืนยัน</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1>จัดการงาน</h1>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">เพิ่มงาน</button>
            </div>
        </div>
        <hr>
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php } ?>

        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php } ?>
        <!-- ตารางแสดงชื่อลูกค้า -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ชื่อ</th>
                    <th scope="col">สกุล</th>
                    <th scope="col">รายละเอียด</th>
                    <th scope="col">ประเภทงาน</th>
                    <th scope="col">วันที่</th>
                    <th scope="col">ราคา</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->query("SELECT customer.id, customer.firstname, customer.lastname, orders.details, orders.types, orders.order_date, orders.price FROM customer INNER JOIN orders ON customer.id = orders.task_id");


                $stmt->execute();
                $data = $stmt->fetchAll();

                if (!$data) {
                    echo "<tr><td colspan='8' class='text-center'> No data found </td></tr>";
                } else {
                    foreach ($data as $row) {
                ?>
                        <tr>
                            <th scope="row"><?= $row['id']; ?></th>
                            <td><?= $row['firstname']; ?></td>
                            <td><?= $row['lastname']; ?></td>
                            <td><?= $row['details']; ?></td>
                            <td><?= $row['types']; ?></td>
                            <td><?= $row['order_date']; ?></td>
                            <td><?= $row['price']; ?></td>
                            <td>
                                <a href="order_edit.php?id=<?= $row['id']; ?>" class="btn btn-warning">แก้ไข</a>
                                <a href="?delete=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?');">ลบ</a>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>


    </div>
    <script>
        document.getElementById('firstname').addEventListener('change', function() {
            var selectedFirstName = this.value;
            var lastnameDropdown = document.getElementById('lastname');

            // Clear previous options
            lastnameDropdown.innerHTML = '';

            // Request to the server to get matching lastnames for the selected firstname
            fetch('get_lastnames.php?firstname=' + selectedFirstName)
                .then(response => response.json())
                .then(data => {
                    data.forEach(lastname => {
                        var option = document.createElement('option');
                        option.text = lastname;
                        option.value = lastname;
                        lastnameDropdown.add(option);
                    });
                });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
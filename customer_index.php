<?php

session_start();
require_once("C:/xampp/htdocs/Proj3k/connection/connect.php");
// ลบข้อมูล
if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  $deletestmt = $conn->query("DELETE FROM customer WHERE id = $delete_id");
  $deletestmt->execute();

  if ($deletestmt) {
    echo "<script>alert('Data has been deleted successfully');</script>";
    $_SESSION['success'] = "Data has been deleted succesfully";
    header("refresh:1; url=customer_index.php");
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
      background-color: #333;
      /* สีพื้นหลัง */
      color: #fff;
      /* สีตัวอักษร */
      width: 200px;
      /* ความกว้างของ sidebar */
      position: fixed;
      height: 100%;
      overflow: auto;
      /* เพื่อให้มีการสกอลขึ้นลง */
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
      color: #00f;
      /* เปลี่ยนสีเมื่อนำเมาส์มาวางเหนือลิงค์ */
    }

    /* Style the modal content */
    .modal-content {
      background-color: #fff;
      /* Background color */
      border: 2px solid #007bff;
      /* Border color */
      border-radius: 10px;
      /* Border radius */
    }

    /* Style the modal header */
    .modal-header {
      background-color: #007bff;
      /* Header background color */
      color: #fff;
      /* Header text color */
      border-bottom: 1px solid #ddd;
      /* Header border color */
    }

    /* Style the modal body */
    .modal-body {
      padding: 20px;
      /* Add padding to the body */
    }

    /* Style the modal footer */
    .modal-footer {
      border-top: 1px solid #ddd;
      /* Footer border color */
    }

    .modal-dialog {
      max-width: 800px;
      /* Adjust the maximum width as needed */
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

    .btn-warning,.btn-danger {
      margin-right: 5px;
    }
  </style>
</head>

<body>
  <div class="sidebar">
    <h2 style="text-align: center;">ลูกค้า</h2>
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
          <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มลูกค้า</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="insert.php" method="post">
            <div class="row mb-3">
              <div class="col-md-6">
                <h2 class="mb-4">ข้อมูลส่วนตัว</h2>
                <!-- ชื่อ -->
                <div class="mb-3">
                  <label for="firstname" class="form-label">ชื่อ:</label>
                  <input type="text" required class="form-control" name="firstname">
                </div>
                <!-- สกุล -->
                <div class="mb-3">
                  <label for="lastname" class="form-label">สกุล:</label>
                  <input type="text" required class="form-control" name="lastname">
                </div>
                <!-- เบอร์โทร -->
                <div class="mb-3">
                  <label for="phonenumber" class="form-label">เบอร์โทร:</label>
                  <input type="text" required class="form-control" name="phonenumber">
                </div>
                <!-- ไลน์ -->
                <div class="mb-3">
                  <label for="line_id" class="form-label">ไลน์:</label>
                  <input type="text" required class="form-control" name="line_id">
                </div>
              </div>
              <div class="col-md-6">
                <h2 class="mb-4">ข้อมูลสัดส่วน</h2>
                <!-- ยาวหน้า -->
                <div class="mb-3">
                  <label for="frontlength" class="form-label">ยาวหน้า:</label>
                  <input type="text" required class="form-control" name="frontlength">
                </div>
                <!-- ไหล่ -->
                <div class="mb-3">
                  <label for="shoulder" class="form-label">ไหล่:</label>
                  <input type="text" required class="form-control" name="shoulder">
                </div>
                <!-- บ่าหน้า -->
                <div class="mb-3">
                  <label for="front_shoulder" class="form-label">บ่าหน้า:</label>
                  <input type="text" required class="form-control" name="front_shoulder">
                </div>
                <!-- บ่าหลัง -->
                <div class="mb-3">
                  <label for="back_shoulder" class="form-label">บ่าหลัง:</label>
                  <input type="text" required class="form-control" name="back_shoulder">
                </div>
                <!-- คอ -->
                <div class="mb-3">
                  <label for="neck" class="form-label">คอ:</label>
                  <input type="text" required class="form-control" name="neck">
                </div>
                <!-- รอบอก -->
                <div class="mb-3">
                  <label for="chest" class="form-label">รอบอก:</label>
                  <input type="text" required class="form-control" name="chest">
                </div>
                <!-- อกห่าง -->
                <div class="mb-3">
                  <label for="apart_chest" class="form-label">อกห่าง:</label>
                  <input type="text" required class="form-control" name="apart_chest">
                </div>
                <!-- อกสูง -->
                <div class="mb-3">
                  <label for="height_chest" class="form-label">อกสูง:</label>
                  <input type="text" required class="form-control" name="height_chest">
                </div>
                <!-- รอบเอว -->
                <div class="mb-3">
                  <label for="waist" class="form-label">รอบเอว:</label>
                  <input type="text" required class="form-control" name="waist">
                </div>
                <!-- สะโพก -->
                <div class="mb-3">
                  <label for="hip" class="form-label">สะโพก:</label>
                  <input type="text" required class="form-control" name="hip">
                </div>
                <!-- กระโปรงยาว -->
                <div class="mb-3">
                  <label for="long_skirt" class="form-label">กระโปรงยาว:</label>
                  <input type="text" required class="form-control" name="long_skirt">
                </div>
                <!-- แขนยาว -->
                <div class="mb-3">
                  <label for="long_sleeve" class="form-label">แขนยาว:</label>
                  <input type="text" required class="form-control" name="long_sleeve">
                </div>
                <!-- แขนกว้าง -->
                <div class="mb-3">
                  <label for="wide_arms" class="form-label">แขนกว้าง:</label>
                  <input type="text" required class="form-control" name="wide_arms">
                </div>
                <!-- เสื้อยาว -->
                <div class="mb-3">
                  <label for="long_shirt" class="form-label">เสื้อยาว:</label>
                  <input type="text" required class="form-control" name="long_shirt">
                </div>
                <!-- ตัวยาว -->
                <div class="mb-3">
                  <label for="long_body" class="form-label">ตัวยาว:</label>
                  <input type="text" required class="form-control" name="long_body">
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
        <h1>ลูกค้า</h1>
      </div>
      <div class="col-md-6 d-flex justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">เพิ่มลูกค้า</button>
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
        echo $_SESSION['errors'];
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
          <th scope="col">เบอร์โทร</th>
          <th scope="col">ไลน์</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $stmt = $conn->query("SELECT * FROM customer");
        $stmt->execute();
        $users = $stmt->fetchAll();

        if (!$users) {
          echo "<tr><td colspan='6' class='text-center'> ไม่พบผู้ใช้ </td></tr>";
        } else {
          foreach ($users as $user) {


        ?>
            <tr>
              <th scope="row"><?= $user['id']; ?></th>
              <th scope="row"><?= $user['firstname']; ?></th>
              <th scope="row"><?= $user['lastname']; ?></th>
              <th scope="row"><?= $user['phonenumber']; ?></th>
              <th scope="row"><?= $user['line_id']; ?></th>
              <td>
                <a href="edit.php?id=<?= $user['id']; ?>" class="btn btn-warning">แก้ไข</a>
                <a href="?delete=<?= $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?');">ลบ</a>

              </td>
            </tr>
        <?php }
        } ?>
      </tbody>
    </table>


  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
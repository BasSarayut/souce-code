<?php

session_start();
require_once("C:/xampp/htdocs/Proj3k/connection/connect.php");

if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $phonenumber = $_POST['phonenumber'];
  $line_id = $_POST['line_id'];
  $frontlength = $_POST['frontlength'];
  $shoulder = $_POST['shoulder'];
  $front_shoulder = $_POST['front_shoulder'];
  $back_shoulder = $_POST['back_shoulder'];
  $neck = $_POST['neck'];
  $chest = $_POST['chest'];
  $apart_chest = $_POST['apart_chest'];
  $height_chest = $_POST['height_chest'];
  $waist = $_POST['waist'];
  $hip = $_POST['hip'];
  $long_skirt = $_POST['long_skirt'];
  $long_sleeve = $_POST['long_sleeve'];
  $wide_arms = $_POST['wide_arms'];
  $long_shirt = $_POST['long_shirt'];
  $long_body = $_POST['long_body'];



  $sql = $conn->prepare("UPDATE customer SET firstname = :firstname, lastname = :lastname, phonenumber = :phonenumber, line_id = :line_id, frontlength = :frontlength, shoulder = :shoulder, front_shoulder = :front_shoulder, back_shoulder = :back_shoulder, neck = :neck, chest = :chest, apart_chest = :apart_chest, height_chest = :height_chest, waist = :waist, hip = :hip, long_skirt = :long_skirt, long_sleeve = :long_sleeve, wide_arms = :wide_arms, long_shirt = :long_shirt, long_body = :long_body WHERE id = :id");
  $sql->bindParam(":id", $id);
  $sql->bindParam(":firstname", $firstname);
  $sql->bindParam(":lastname", $lastname);
  $sql->bindParam(":phonenumber", $phonenumber);
  $sql->bindParam(":line_id", $line_id);
  $sql->bindParam(":frontlength", $frontlength);
  $sql->bindParam(":shoulder", $shoulder);
  $sql->bindParam(":front_shoulder", $front_shoulder);
  $sql->bindParam(":back_shoulder", $back_shoulder);
  $sql->bindParam(":neck", $neck);
  $sql->bindParam(":chest", $chest);
  $sql->bindParam(":apart_chest", $apart_chest);
  $sql->bindParam(":height_chest", $height_chest);
  $sql->bindParam(":waist", $waist);
  $sql->bindParam(":hip", $hip);
  $sql->bindParam(":long_skirt", $long_skirt);
  $sql->bindParam(":long_sleeve", $long_sleeve);
  $sql->bindParam(":wide_arms", $wide_arms);
  $sql->bindParam(":long_shirt", $long_shirt);
  $sql->bindParam(":long_body", $long_body);
  $sql->execute();

  if ($sql) {
    $_SESSION['success'] = "Data has been updated succesfully ";
    header("Location: customer_index.php");
  } else {
    $_SESSION['error'] = "Data has  not been updated succesfully";
    header("Location: customer_index.php");
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
    <form action="edit.php" method="post">
      <?php
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $conn->query("SELECT * FROM customer Where id = $id ");
        $stmt->execute();
        $data = $stmt->fetch();
      }

      ?>
      <div class="row mb-3">
      <div class="col-md-6">
        <h2 class="mb-4">ข้อมูลส่วนตัว</h2>
        <!-- ชื่อ -->
        <div class="mb-3">
          <input type="text" hidden value="<?= $data['id']; ?>" required class="form-control" name="id">
          <label for="firstname" class="form-label">ชื่อ:</label>
          <input type="text" value="<?= $data['firstname']; ?>" required class="form-control" name="firstname">
        </div>
        <!-- สกุล -->
        <div class="mb-3">
          <label for="lastname" class="form-label">สกุล:</label>
          <input type="text" value="<?= $data['lastname']; ?>" required class="form-control" name="lastname">
        </div>
        <!-- เบอร์โทร -->
        <div class="mb-3">
          <label for="phonenumber" class="form-label">เบอร์โทร:</label>
          <input type="text" value="<?= $data['phonenumber']; ?>" required class="form-control" name="phonenumber">
        </div>
        <!-- ไลน์ -->
        <div class="mb-3">
          <label for="line_id" class="form-label">ไลน์:</label>
          <input type="text" value="<?= $data['line_id']; ?>" required class="form-control" name="line_id">
        </div>
      </div>
      <div class="col-md-6">
        <h2 class="mb-4">ข้อมูลสัดส่วน</h2>
        <!-- ยาวหน้า -->
        <div class="mb-3">
          <label for="frontlength" class="form-label">ยาวหน้า:</label>
          <input type="text" value="<?= $data['frontlength']; ?>" required class="form-control" name="frontlength">
        </div>
        <!-- ไหล่ -->
        <div class="mb-3">
          <label for="shoulder" class="form-label">ไหล่:</label>
          <input type="text" value="<?= $data['shoulder']; ?>" required class="form-control" name="shoulder">
        </div>
        <!-- บ่าหน้า -->
        <div class="mb-3">
          <label for="front_shoulder" class="form-label">บ่าหน้า:</label>
          <input type="text" value="<?= $data['front_shoulder']; ?>" required class="form-control" name="front_shoulder">
        </div>
        <!-- บ่าหลัง -->
        <div class="mb-3">
          <label for="back_shoulder" class="form-label">บ่าหลัง:</label>
          <input type="text" value="<?= $data['back_shoulder']; ?>" required class="form-control" name="back_shoulder">
        </div>
        <!-- คอ -->
        <div class="mb-3">
          <label for="neck" class="form-label">คอ:</label>
          <input type="text" value="<?= $data['neck']; ?>" required class="form-control" name="neck">
        </div>
        <!-- รอบอก -->
        <div class="mb-3">
          <label for="chest" class="form-label">รอบอก:</label>
          <input type="text" value="<?= $data['chest']; ?>" required class="form-control" name="chest">
        </div>
        <!-- อกห่าง -->
        <div class="mb-3">
          <label for="apart_chest" class="form-label">อกห่าง:</label>
          <input type="text" value="<?= $data['apart_chest']; ?>" required class="form-control" name="apart_chest">
        </div>
        <!-- อกสูง -->
        <div class="mb-3">
          <label for="height_chest" class="form-label">อกสูง:</label>
          <input type="text" value="<?= $data['height_chest']; ?>" required class="form-control" name="height_chest">
        </div>
        <!-- รอบเอว -->
        <div class="mb-3">
          <label for="waist" class="form-label">รอบเอว:</label>
          <input type="text" value="<?= $data['waist']; ?>" required class="form-control" name="waist">
        </div>
        <!-- สะโพก -->
        <div class="mb-3">
          <label for="hip" class="form-label">สะโพก:</label>
          <input type="text" value="<?= $data['hip']; ?>" required class="form-control" name="hip">
        </div>
        <!-- กระโปรงยาว -->
        <div class="mb-3">
          <label for="long_skirt" class="form-label">กระโปรงยาว:</label>
          <input type="text" value="<?= $data['long_skirt']; ?>" required class="form-control" name="long_skirt">
        </div>
        <!-- แขนยาว -->
        <div class="mb-3">
          <label for="long_sleeve" class="form-label">แขนยาว:</label>
          <input type="text" value="<?= $data['long_sleeve']; ?>" required class="form-control" name="long_sleeve">
        </div>
        <!-- แขนกว้าง -->
        <div class="mb-3">
          <label for="wide_arms" class="form-label">แขนกว้าง:</label>
          <input type="text" value="<?= $data['wide_arms']; ?>" required class="form-control" name="wide_arms">
        </div>
        <!-- เสื้อยาว -->
        <div class="mb-3">
          <label for="long_shirt" class="form-label">เสื้อยาว:</label>
          <input type="text" value="<?= $data['long_shirt']; ?>" required class="form-control" name="long_shirt">
        </div>
        <!-- ตัวยาว -->
        <div class="mb-3">
          <label for="long_body" class="form-label">ตัวยาว:</label>
          <input type="text" value="<?= $data['long_body']; ?>" required class="form-control" name="long_body">
        </div>
      </div>
  </div>


  <div class="modal-footer">
    <a class="btn btn-secondary" href="customer_index.php">ย้อนกลับ</a>
    <button type="submit" name="update" class="btn btn-primary">อัพเดท</button>
  </div>
  </form>


  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
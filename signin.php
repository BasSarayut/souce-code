<?php
session_start();
include("connection/connect.php");
include("layout.php");

?>
<style>
    .card {
        background-color:whitesmokes ;
    }
    body{
        background-color: blanchedalmond;
    }
</style>


<div class="card text-center my-4 popup-re">
    <div class="card-header">
        <h3>เข้าสู่ระบบ</h3>
    </div>
    <div class="container">
        <form action="signin_db.php" method="post">

            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">

                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error'])
                    ?>
                </div>

            <?php } ?>

            <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success'])
                    ?>
                </div>

            <?php } ?>


            <div class="mb-3">
                <label for="email_account" class="form-label">อีเมล</label>
                <input type="email" class="form-control" name="email_account" placeholder="อีเมล" required>
            </div>
            <div class="mb-3">
                <label for="password_account" class="form-label">รหัสผ่าน</label>
                <input type="password" class="form-control" name="password_account" placeholder="รหัสผ่าน" required>
            </div>
            <button type="submit" name="signin" class="btn btn-primary">เข้าสู่ระบบ</button>
        </form>

        <p>คุณยังไม่มีบัญชีใช่ไหม? <a href="index.php">สมัครสมาชิก</a></p>
    </div>
</div>
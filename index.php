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
            <h3 class="">สมัครสมาชิก</h3>
        </div>
        <div class="card-body">
            <form action="signup_db.php" method="post">
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

                <?php if (isset($_SESSION['warning'])) { ?>
                    <div class="alert alert-warning" role="alert">
                        <?php
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning'])
                        ?>
                    </div>

                <?php } ?>

                <div class="mb-3">
                    <label for="username_account" class="form-label">ชื่อผู้ใช้</label>
                    <input type="text" class="form-control" name="username_account" placeholder="ชื่อผู้ใช้" required>
                </div>
                <div class="mb-3">
                    <label for="email_account" class="form-label">อีเมล</label>
                    <input type="email" class="form-control" name="email_account" placeholder="อีเมล" required>
                </div>
                <div class="mb-3">
                    <label for="password_account" class="form-label">รหัสผ่าน</label>
                    <input type="password" class="form-control" name="password_account" placeholder="รหัสผ่าน" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_account" class="form-label">ยืนยันรหัสผ่าน</label>
                    <input type="password" class="form-control" name="confirm_account" placeholder="ยืนยันรหัสผ่าน" required>
                </div>
                <button type="submit" name="signup" class="btn btn-primary">ยืนยัน</button>
            </form>
            <p>คุณมีบัญชีอยู่แล้ว? <a href="signin.php">เข้าสู่ระบบ</a></p>
        </div>
    </div>

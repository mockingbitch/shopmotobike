<?php
include('../classes/taikhoan.php');
?>
<?php
$class = new taikhoan();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
    $taikhoan = $_POST['taikhoan'];
    $matkhau = md5($_POST['matkhau']);
    $dangnhap = $class->dangnhap($taikhoan, $matkhau);
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <!-- <h2 class="heading-section">Login #09</h2> -->
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap py-5">
                    <div class="img d-flex align-items-center justify-content-center" style="background-image: url(images/bg.jpg);"></div>
                    <h3 class="text-center mb-0">Welcome</h3>
                    <p class="text-center"></p>
                    <form action="" method="POST"  class="login-form">
                        <div class="form-group">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-user"></span></div>
                            <input type="text" name="taikhoan" class="form-control" placeholder="Tài khoản" required>
                        </div>
                        <div class="form-group">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
                            <input type="password" name="matkhau" class="form-control" placeholder="Mật khẩu" required>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-100 text-md-right">
                                <a href="#">Quên mật khẩu</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="login" class="btn form-control btn-primary rounded submit px-3" value="Đăng nhập">
                        </div>
                    </form>
                    <div class="w-100 text-center mt-4 text">
                        <p class="mb-0">Chưa có tài khoản?</p>
                        <a href="#">Đăng ký</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>


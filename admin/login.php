<?php
session_start();
if (isset($_SESSION['user']) and strlen($_SESSION['user']) > 0) {
    header('location: /admin/index.php');
}
if (isset($_POST['submit'])) {
    if (isset($_POST['email']) and isset($_POST['password'])) {
        if ($_POST['email'] == 'admin@gulfmcq.pro' and $_POST['password'] == 'gulfmcqpro#admin#12345') {
            $_SESSION['user'] = 'admin@gulfmcq.pro';
            header('location: /admin/index.php');
        } else {
            header('location: /');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(__DIR__ . '/../comp/head.php'); ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 offset-md-3 offset-lg-4 text-center">
                <div class="shadow p-5 my-5">
                    <div class="fs-2 fw-bold text-danger mb-5">Login</div>
                    <form action="/admin/login.php" method="post">
                        <input type="text" class="form-control mb-2" name="email" type="email" placeholder="Email">
                        <input type="password" class="form-control mb-4" name="password" placeholder="Password">
                        <button name="submit" type="submit" class="btn btn-lg btn-danger w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
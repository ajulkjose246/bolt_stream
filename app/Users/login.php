<!DOCTYPE html>
<html>
<?php
error_reporting(E_ERROR | E_PARSE);
if ($_SESSION['userData'] == null) {
    require __DIR__ . '/../Connection/db_connect.php';
?>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>User Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="/app/assets/login/login.css">
        <script src="/app/assets/validation/validation.js"></script>
    </head>

    <body className="snippet-body">
        <div class="section">
            <div class="container">
                <div class="row full-height justify-content-center">
                    <div class="col-12 text-center align-self-center py-5">
                        <div class="section pb-5 pt-5 pt-sm-2 text-center">
                            <h6 class="mb-0 pb-3">
                                <span>Log In </span><span>Sign Up</span>
                            </h6>
                            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                            <label for="reg-log"> </label>
                            <div class="card-3d-wrap mx-auto">
                                <div class="card-3d-wrapper">
                                    <div class="card-front">
                                        <div class="center-wrap">
                                            <div class="section text-center">
                                                <h4 class="mb-4 pb-3">Log In</h4>
                                                <form action="#" method="post">
                                                    <div class="form-group">
                                                        <input type="email" name="logemail" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off" required>
                                                        <i class="input-icon uil uil-at"></i>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <input type="password" name="logpass" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off" required>
                                                        <i class="input-icon uil uil-lock-alt"></i>
                                                    </div>
                                                    <input type="submit" name="logBtn" class="btn mt-3">
                                                    <p class="mb-0 mt-4 text-center">
                                                        <a href="#0" class="link">Forgot your password?</a>
                                                    </p>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-back" id="card-back">
                                        <div class="center-wrap">
                                            <div class="section text-center">
                                                <h4 class="mb-4 pb-3">Sign Up</h4>
                                                <form action="/reguser" class="akjFval" method="post">
                                                    <div class="form-group">
                                                        <input type="text" name="regname" class="form-style akjval" RegExp="^[a-zA-Z ]+$" ErrMsg="Enter a Valid name" placeholder="Your Full Name" id="logname" autocomplete="off" required>
                                                        <i class="input-icon uil uil-user"></i>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <input type="email" name="regmail" class="form-style akjval" RegExp="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$" ErrMsg="Enter a Valid Email" placeholder="Your Email" id="regmail" autocomplete="off" required>
                                                        <i class="input-icon uil uil-at"></i>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <input type="password" name="regpass" class="form-style akjval" RegExp="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$" ErrMsg="Enter a Valid Password" placeholder="Your Password" id="regpass" autocomplete="off" required>
                                                        <i class="input-icon uil uil-lock-alt"></i>
                                                    </div>
                                                    <input type="submit" name="logSubBtn" class="btn mt-3">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['logBtn'])) {
            $logemail = $_POST['logemail'];
            $logpass = $_POST['logpass'];
            $result = crud("SELECT * FROM `tbl_register` WHERE `usrEmail` = '$logemail' AND `usrPassword` = '$logpass'");
            $num = mysqli_num_rows($result);
            $row = mysqli_fetch_array($result);
            if ($num > 0) {
                $_SESSION['userData'] = $row;
                echo ("<script>location.href='/'</script>");
            } else {
                echo ("<script>location.href='/register'</script>");
            }
        }
        ?>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/login/login.js"></script>
    </body>

<?php } else {
    echo ("<script>location.href='/'</script>");
} ?>
<script>
    var $target = $('[alt*="000webhost"]');
    if ($target.length > 0) {
        var $div = $target.parent().closest('div').remove();
    }
</script>

</html>
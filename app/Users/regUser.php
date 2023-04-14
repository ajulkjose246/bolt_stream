<?php
// error_reporting(E_ERROR | E_PARSE);
require __DIR__ . '/../Connection/db_connect.php';
$regname = $_POST['regname'];
$regmail = $_POST['regmail'];
$regpass = $_POST['regpass'];
$result = crud("SELECT * FROM `tbl_register` WHERE `usrEmail` = '$regmail'");
$num = mysqli_num_rows($result);
if ($num > 0) {
    echo ("<script>alert('Email id Alredy exist')</script>");
    echo ("<script>location.href='/register'</script>");
} else {
    crud("INSERT INTO `tbl_register`(`usrEmail`, `usrName`, `usrPassword`) VALUES ('$regmail','$regname','$regpass')");
    echo ("<script>alert('Registration Success')</script>");
    echo ("<script>location.href='/register'</script>");
}

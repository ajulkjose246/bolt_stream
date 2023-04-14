<?php
session_start();
require('../Connection/db_connect.php');
$usrId=$_SESSION['userData']['usrId'];
$movId = $_GET['imdb'];
crud("DELETE FROM `tbl_bookmark` WHERE `bmUsrid` = '$usrId' AND `bmMov`= '$movId'");
echo("<script>location.href='/bookmark'</script>");
?>
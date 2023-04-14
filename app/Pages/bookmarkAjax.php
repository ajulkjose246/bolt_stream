<?php
require('../Connection/db_connect.php');
if (isset($_POST['movId']) && isset($_POST['usrId']) && isset($_POST['condition'])) {
    $movId = $_POST['movId'];
    $usrId = $_POST['usrId'];
    $condition = $_POST['condition'];
    if ($condition == 0) {
        $result = crud("SELECT * FROM `tbl_bookmark` WHERE `bmUsrid` = '$usrId' AND `bmMov`= '$movId'");
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            echo (2);
        } else {
            echo (3);
        }
    } else {
        $result = crud("SELECT * FROM `tbl_bookmark` WHERE `bmUsrid` = '$usrId' AND `bmMov`= '$movId'");
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            crud("DELETE FROM `tbl_bookmark` WHERE `bmUsrid` = '$usrId' AND `bmMov`= '$movId'");
            echo (0);
        } else {
            crud("INSERT INTO `tbl_bookmark`(`bmUsrid`, `bmMov`) VALUES ('$usrId','$movId')");
            echo (1);
        }
    }
}

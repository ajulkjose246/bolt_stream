<?php
session_destroy();
unset($_SESSION['userData']);
echo ("<script>location.href='/'</script>");
?>
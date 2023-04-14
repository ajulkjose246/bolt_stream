<?php
require_once "router.php";
require_once "web.php";
$action = $_SERVER['REQUEST_URI'];
dispatch($action);
?>
<script src="/api_services/apiScripts.js"></script>
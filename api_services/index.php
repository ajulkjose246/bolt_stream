<?php
    define("DEBUG",true);
    define("PAGE_HOME",'/');
    define("PAGE_DASH",'/console');
    define("KEY_AUTH",'login_role');
    if(DEBUG){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }
    function clog($msg){
        if(DEBUG){
            $backtrace = debug_backtrace();
            $root = $_SERVER['DOCUMENT_ROOT'];
            $line=str_replace($root,"",$backtrace[0]['file'])."/".$backtrace[0]['line']." : ".$msg;
            ?><script>console.log('<?= $line ?>');</script><?php
        }
    }
    require("APIMethods.php");
    $methods=new APIMethods();
    if(isset($_POST['method'])){
        global $methods;
        $fn=$_POST['method']; 
    	if(method_exists($methods,$fn)){
    	    echo json_encode($methods->$fn($_POST));
    	}else{
    		echo json_encode(array("status"=>"false","message"=>"Method $fn does not exists"));
    	}
    }
    function mCall($fn,$params=null){
        global $methods;
        if(method_exists($methods,$fn)){
            return $methods->$fn($params);
    	}else{
    		return "Method not exists!";
    	}
    }
    define('__authUser',$methods->authUser());
    define('__isAuth',isset(__authUser[KEY_AUTH]));
    function __isRole($reqRole = "=0"){
        $role_no = preg_replace('/[^0-9]/', '', $reqRole);
        $role_cond = preg_replace('/[^<>=]/', '', $reqRole);
        $role_cond = $role_cond == "="?"==":$role_cond;
        return eval("return __authUser[KEY_AUTH] $role_cond $role_no;");
    }
?>
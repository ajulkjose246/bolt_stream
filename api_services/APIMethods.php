<?php
    class APIMethods{
        public $pdo;
        public function __construct(){
            try{
                $host="localhost"; $uname="id20552783_akj"; $pword="Ajul@2023@BoltStream"; $db="id20552783_db_boltstream";
                $this->pdo = new PDO("mysql:host=$host;dbname=$db",$uname,$pword);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if (session_status() == PHP_SESSION_NONE && !isset($_SESSION)) {
                    session_start();
                }
            } catch (PDOException $e) {
                echo 'connection failed: '.$e->getMessage();
                die();
            }
        }
        
        function insert($table, $data) {
            $data['created_by'] = $this->authUser()['login_id'];
            $columns = implode(', ', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
            $stmt = $this->pdo->prepare("INSERT INTO $table ($columns) VALUES ($placeholders)");
            $stmt->execute($data);
            return array("status" => $stmt->rowCount() > 0,"id"=>$this->pdo->lastInsertId());
        }
        
        function insertorupdate($table, $data, $key) {
            $data['created_by'] = $data['updated_by'] = $this->authUser()['login_id'];
            $columns = implode(', ', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
            $set = [];
            foreach ($data as $column => $value) {
              $set[] = "$column = :$column";
            }  
            $set = implode(', ', $set);
            $stmt = $this->pdo->prepare("INSERT INTO $table ($columns) VALUES ($placeholders) ON DUPLICATE KEY UPDATE $set");
            $stmt->execute($data);
            return array("status" => $stmt->rowCount() > 0,"id"=>$this->pdo->lastInsertId());
        }
        
        function update($table, $data, $conditions = '1') {
            $data['updated_by'] = $this->authUser()['login_id'];
            $set = [];
            foreach ($data as $column => $value) {
              $set[] = "$column = :$column";
            }
            $set = implode(', ', $set);
            $stmt = $this->pdo->prepare("UPDATE $table SET $set WHERE $conditions AND `status`=1");
            $stmt->execute($data);
            return array("status" => $stmt->rowCount() > 0);
        }
        
        function select($table, $columns, $conditions = '1',$orderby = 'status') {
            $stmt = $this->pdo->prepare("SELECT $columns FROM $table WHERE $conditions AND `status` = 1 ORDER BY $orderby");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        function selectOne($table, $columns, $conditions = '1') {
            $stmt = $this->pdo->prepare("SELECT $columns FROM $table WHERE $conditions AND `status` = 1");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
        function delete($table, $conditions = '1') {
            $stmt = $this->pdo->prepare("UPDATE $table SET `status` = 0,`updated_by` = :updby WHERE $conditions AND `status` = 1");
            $stmt->execute([':updby'=>$this->authUser()['login_id']]);
            return array("status" => $stmt->rowCount() > 0);
        }
        
        function forcedelete($table, $conditions = '1') {
            $stmt = $this->pdo->prepare("DELETE FROM $table WHERE $conditions AND `status` = 1");
            $stmt->execute();
            return array("status" => $stmt->rowCount() > 0);
        }
        
        
        
        function authUser(){
            return isset($_SESSION['auth_user'])?$_SESSION['auth_user']:array("status"=>false);
        }
        
        function refreshAuthUser(){
            $sel_stmt =  $this->pdo->prepare("SELECT * FROM `view_users` WHERE `login_id`=:lid");
            $sel_stmt->execute([':lid' => $this->authUser()['login_id']]);
            if($sel_stmt->rowCount() > 0){
                $_SESSION['auth_user'] = $sel_stmt->fetch();
            }
        }
        
        function doLogout($params){
            session_destroy();
            return array("status"=>true);
        } 
        function doLogin($params){
            $email = trim($params['email']);
            $name = strtoupper(trim($params['name']));
            $photo = trim($params['photo']);
            $stmt =  $this->pdo->prepare("INSERT INTO `tbl_login`(`login_email`,`login_name`,`login_photo`) SELECT :uemail,:uname,:uphoto WHERE NOT EXISTS (SELECT `login_email` FROM `tbl_login` WHERE `login_email` = :uemail)");
            $stmt->execute([':uemail' => $email,':uname'=>$name,':uphoto'=>$photo ]);
            if($stmt->rowCount() > 0){
                $in_stmt =  $this->pdo->prepare("INSERT INTO `tbl_profiles` (`profile_login_id`) VALUES(:lid)");
                $in_stmt->execute([':lid'=>$this->pdo->lastInsertId()]);
            }
            $sel_stmt =  $this->pdo->prepare("SELECT * FROM `view_users` WHERE `login_email`=:uemail");
            $sel_stmt->execute([':uemail' => $email]);
            if($sel_stmt->rowCount() > 0){
                $upd_stmt =  $this->pdo->prepare("UPDATE `tbl_login` SET `login_lastlogined` = NOW() WHERE `login_email`=:uemail");
                $upd_stmt->execute([':uemail' => $email]);
                $sel_data = $sel_stmt->fetch();
                $_uMob = $sel_data['login_mobile'];
                if(is_null($_uMob) || $_uMob == ''){
                    $_SESSION['auth_user_temp'] = $sel_data;
                    return array("status"=>true,"mob"=>false,"data"=>$_SESSION['auth_user_temp']);
                }else{
                    $_SESSION['auth_user'] = $sel_data;
                    return array("status" => true,"mob"=>true);
                }
            }else{
                return array("status" => false);
            }
        }
        

        // function getDepartments($params){
        //     $did = $params['id'];
        //     return $this->select("tbl_departments","dept_id as id ,dept_name as name","dept_stream_id = $did","dept_name");
        // }
        
        // function addProgram($params){
        //     return $this->insert('tbl_departments', $params['data']);
        // }        
    }
?>
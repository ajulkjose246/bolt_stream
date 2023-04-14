<?php
// local connection details

// $host = "localhost";
// $username = "root";
// $password = "";
// $database = "bolt_stream";

// 000webhost connection details



function crud($query)
{
    $host="localhost";
    $username="id20552783_akj";
    $password="Ajul@2023@BoltStream";
    $database="id20552783_db_boltstream";
    
    $con = mysqli_connect($host,$username,$password,$database);
    // global $con;
    $result = mysqli_query($con, $query);
    return $result;
}


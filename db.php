<?php
$servername="localhost";
$username="root";
$pass="";
$database="attendance_management_system";

$str="mysql:host=$servername;dbname=$database";

try
{
    $con=new PDO($str,$username,$pass);
    //echo "Database connected";
}
catch(PDOException $e)
{
    echo "Error :".$e->getMessage();
}
?>
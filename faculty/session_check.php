<?php
session_start();
if(!isset($_SESSION['fid']))
{
    header("Location:../index.php");
    exit;
}
?>
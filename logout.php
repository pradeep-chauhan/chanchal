<?php
require_once("classes/database.php");
if(empty($_SESSION['logged_in'])){
    header('location:index.php');
}

session_destroy();
header('location:index.php');
?>
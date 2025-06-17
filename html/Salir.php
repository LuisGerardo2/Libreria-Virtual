<?php
session_start();


if (!isset($_SESSION['user'])) { 
    header("Location:../index.html");
    exit();
}
else{
    session_destroy();
    header("Location:../index.html");
}
?>

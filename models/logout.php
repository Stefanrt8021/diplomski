<?php
session_start();

if(isset($_SESSION['user'])) {
    session_destroy();
    header("location: ../index.php?page=landing");
}
else{
    header('location: ../index.php?page=login');
}

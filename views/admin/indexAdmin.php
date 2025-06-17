<?php
session_start();
include "../../config/connection.php";
global $conn;
if(isset($_GET['page'])){
    switch($_GET['page']){

        case 'admin':
            include "admin.php";
            break;
        case 'table':
            include "table2.php";
            break;

}
    }

?>


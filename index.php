<?php
session_start();
include "config/connection.php";
global $conn;

include "views/fixed/head.php";
include "views/fixed/header.php";

if(isset($_GET['page'])){
    switch($_GET['page']){
        case 'landing':
            include "views/pages/landing.php";
            break;
        case 'manage':
            include "views/manage/manager.php";
            break;
        case 'login':
            include "views/pages/login.php";
            break;
        case 'register':
        include "views/pages/register.php";
            break;
        case 'logout':
            include "views/pages/logout.php";
            break;
        case 'profile':
            include "views/pages/profile.php";
            break;
        case 'shop':
            include "views/pages/shop.php";
            break;
        case 'contactus':
            include "views/pages/contact.php";
            break;
        case 'about':
            include "views/pages/about.php";
            break;
        case 'single':
            include "views/pages/single.php";
            break;
        case 'checkout':
            include "views/pages/checkout.php";
            break;





    }
}else{
    include "views/pages/landing.php";
}





include "views/fixed/footer.php";





?>

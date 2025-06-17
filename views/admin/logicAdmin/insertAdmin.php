<?php
include "../../../config/connection.php";
global $conn;
if(isset($_POST['insertBtnI'])) {
    $table = $_POST['tableI'];
    $sql= "show columns FROM $table";
    $priprema= $conn->prepare($sql);
    try {
        $priprema->execute();
        $rezultat = $priprema->fetchAll();
        $kolone= [];
        foreach($rezultat as $r){
            if($r->Field != "id"){
                array_push($kolone, $r->Field);
            }
        }
        echo json_encode($kolone);


    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}
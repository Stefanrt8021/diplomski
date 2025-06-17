<?php
include "../../../config/connection.php";
global $conn;
if(isset($_POST['updateBtnU'])) {
    $id = $_POST['idU'];
    $table = $_POST['tableU'];
    $sql= "SELECT * FROM $table WHERE id = :id";
    $priprema= $conn->prepare($sql);
    $priprema->bindParam(":id", $id);
    try {
        $priprema->execute();
        $rezultat = $priprema->fetch();
        echo json_encode($rezultat);


    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}

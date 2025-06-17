<?php
include "../../../config/connection.php";
global $conn;
if(isset($_POST['deleteBtn'])){
    $id= $_POST['id'];
    $table= $_POST['table'];
    $sql= "DELETE FROM $table WHERE id = :id";
    $priprema= $conn->prepare($sql);
    $priprema->bindParam(":id", $id);
    try {
        $priprema->execute();
        echo "Uspesno ste obrisali";
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }

}
<?php
include "../../../config/connection.php";
global $conn;
if(isset($_POST['returnOptions'])) {
    $table = $_POST['table'];
    $sql= "select * FROM $table";
    $rezultat = $conn->query($sql)->fetchAll();
    echo json_encode($rezultat);


}
<?php
include "../../../config/connection.php";
global $conn;

if(isset($_POST['updateBtnUpdate']))
{
    $data=$_POST['data'];
    $id=$_POST['id'];
    $table=$_POST['table'];

    $json = json_decode($data, true);

    $query = "UPDATE $table SET ";
    foreach ($json as $key => $value) {
        $query .= "$key = '$value', ";
    }
    $query = rtrim($query, ", ");


    $first_key = array_key_first($json);
    $query .= " WHERE $first_key = $id";
    var_dump($query);

    try {
        $conn->exec($query);
        echo "Uspesno ste izmenili";
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }


}
<?php
include "../../../config/connection.php";
include "functions.php";
global $conn;


    if (isset($_POST['insertBtnInsert'])) {
        $table = $_POST['tableI'];
        $data = $_POST['dataI'];

        $json = json_decode($data, true);


        $sql = "INSERT INTO $table VALUES (";
        $sql .= "null,";
        foreach ($json as $key => $value) {
            if ($value != "") {
                $sql .= "'" . $value . "',";
            } else {
                $sql .= "null,";
            }
        }

        $sql = rtrim($sql, ",");
        $sql .= ")";
        try {
            $conn->exec($sql);
            echo "Uspesno ste dodali novi red u tabelu $table";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

?>

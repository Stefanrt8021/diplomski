<?php
    require_once __DIR__ . "/../config/connection.php";

    if(isset($_POST['managerTrue'])){
        $id = $_POST['id'];
        $status = $_POST['status'];

        $upit = "UPDATE porudzbine SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($upit);
        $stmt->execute([$status, $id]);

        echo "Uspešno ste promenili status posiljke!";
    }
?>
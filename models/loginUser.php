<?php

session_start();
include "../config/connection.php";
header('Content-Type: application/json');
global $conn;

if(isset($_POST['loginBtn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM korisnik WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch();
    if ($user) {  // Ako korisnik postoji
        if (password_verify($password, $user->password)) {  // Ako je lozinka tačna
            if ($user->is_verified == 1) {  // Ako je profil verifikovan
                $_SESSION['user'] = $user;
                echo json_encode(["status" => "success", "user" => $_SESSION['user']]);
            } else {  // Ako profil nije verifikovan
                echo json_encode(["status" => "not_activated"]);
            }
        } else {  // Ako lozinka nije tačna
            echo json_encode(["status" => "error", "message" => "Pogrešna lozinka!"]);
        }
    } else {  // Ako korisnik ne postoji
        echo json_encode(["status" => "error", "message" => "Korisnik ne postoji!"]);
    }
    

}
else{
    header("Location: ../index.php");
}
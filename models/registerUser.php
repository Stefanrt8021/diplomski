<?php
include "../config/connection.php";

global $conn;
if(isset($_POST['registerbtn']) ){
    require "../send_activation_mail.php";

    $username = $_POST['username'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $picture = "images/profileImg.jpg";
    $token = bin2hex(random_bytes(16));
    $is_verified = 0;
    $sql = "INSERT INTO korisnik(username, prezime, password, email,role_id,naziv_src, verification_token, is_verified) VALUES (:username, :lastname, :password, :email,2,:picture, :ver_token, :verified)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":password", $hashedpassword);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":picture", $picture);
    $stmt->bindParam(":ver_token", $token);
    $stmt->bindParam(":verified", $is_verified);


    try{
        $stmt->execute();
        http_response_code(201);
        echo "You have successfully registered!";

        if (sendActivationMail($email, $token)) {
            echo "Verifikacioni mejl je poslat!";
        } else {
            echo "Greška prilikom slanja verifikacionog mejla!";
        }
        
    }
    catch(PDOException $ex){
        http_response_code(500);
        echo "Error: " . $ex->getMessage();
    }

}
else{
    header("Location: ../index.php");
}
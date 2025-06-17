
<?php
session_start();
include "../config/connection.php";
global $conn;
if(isset($_POST['changePasswordBtn']))
{
    $id = $_SESSION['user']->id;
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $sql ="select * from korisnik where id = $id";
    $user=$conn->query($sql)->fetch();
    $oldPasswordBP = $user->password;
    $newPassword= password_hash($newPassword, PASSWORD_DEFAULT);
    if(password_verify($oldPassword, $oldPasswordBP))
    {
        $sql= "UPDATE korisnik SET password = :newPassword WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":newPassword", $newPassword);
        try
        {
            $stmt->execute();
            
            echo "Uspesno ste promenili sifru";
        
            exit;
        }
        catch(PDOException $e)
        {
         
            echo "Greška pri promeni šifre.";
            exit;
        }
    }else{
  
        echo "Stara lozinka nije tačna.";
        exit;
    }
}
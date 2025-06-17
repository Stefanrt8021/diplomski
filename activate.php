<?php
include "config/connection.php";

global $conn;
if (isset($_GET['code'])) {
    $token = $_GET['code'];

    // Provera tokena u bazi podataka
    $query = "SELECT * FROM korisnik WHERE verification_token = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        // Aktiviraj nalog
        $update_query = "UPDATE korisnik SET is_verified = 1, verification_token = NULL WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->execute([$user->id]);
        if (isset($_GET['activated']) && $_GET['activated'] === 'true') {
            echo "
            <!DOCTYPE html>
            <html>
            <head>
                <title>Nalog aktiviran</title>
                <script>
                    setTimeout(function() {
                        window.close();
                    }, 3000);
                </script>
            </head>
            <body style='font-family: Arial, sans-serif; text-align: center; padding-top: 50px;'>
                <h2 style='color: green;'>✅ Vaš nalog je uspešno aktiviran.</h2>
                <p>Možete zatvoriti ovaj prozor i ulogovati se.</p>
            </body>
            </html>";
            exit;
        }
        //header("Location: index.php?page=login");
    } 
} 
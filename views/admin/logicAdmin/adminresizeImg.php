<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];

        // Provera da li je došlo do greške prilikom slanja fajla
        if ($file['error'] === UPLOAD_ERR_OK) {
            $tempFilePath = $file['tmp_name'];
            $originalFileName = $file['name'];

            // Putanja do direktorijuma za čuvanje slike
            $uploadPath = '../../../assets/images/';

            // Odredišna putanja za originalnu sliku
            $destinationOriginal = $uploadPath . $originalFileName;

            // Čuvanje originalne slike na serveru
            move_uploaded_file($tempFilePath, $destinationOriginal);

            // Putanja do direktorijuma za čuvanje resize-ovane slike
            $resizePath = '../../../assets/images/img-resize/';

            // Promenljive za dimenzije resize-ovane slike
            $resizeWidth = 200;
            $resizeHeight = 200;

            // Generisanje imena za resize-ovanu sliku
            $resizeFileName = 'resized_' . $originalFileName;

            // Odredišna putanja za resize-ovanu sliku
            $destinationResized = $resizePath . $resizeFileName;

            // Resize slike na 200x200 piksela
            list($originalWidth, $originalHeight) = getimagesize($destinationOriginal);
            $resizedImage = imagecreatetruecolor($resizeWidth, $resizeHeight);
            $sourceImage = imagecreatefromjpeg($destinationOriginal);
            imagecopyresampled($resizedImage, $sourceImage, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $originalWidth, $originalHeight);
            imagejpeg($resizedImage, $destinationResized);

            // Oslobađanje memorije
            imagedestroy($resizedImage);
            imagedestroy($sourceImage);

            // Vraćanje odgovora na klijentsku stranu
            echo $resizeFileName;
        } else {
            // Greška prilikom slanja slike
            $response = "Došlo je do greške prilikom slanja slike.";
            echo $response;
        }
    } else {
        // Slika nije poslata
        $response = "Slika nije poslata.";
        echo $response;
    }
}
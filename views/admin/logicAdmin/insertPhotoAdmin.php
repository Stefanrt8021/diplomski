<?php
session_start();
include "../config/connection.php";
global $conn;

if (isset($_FILES['photo'])) {
    $errors = array();
    $file_name = $_FILES['photo']['name'];
    $file_size = $_FILES['photo']['size'];
    $file_tmp = $_FILES['photo']['tmp_name'];
    $file_type = $_FILES['photo']['type'];
    $file_ext_array = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext_array));

    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be at most 2MB';
    }

    if (empty($errors)) {
        // Destination folder path
        $destinationFolder = '../assets/images/userprofilephotos/';

        // Resize image to 200x200
        $image = imagecreatefromstring(file_get_contents($file_tmp));
        $newImage = imagecreatetruecolor(200, 200);
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, 200, 200, imagesx($image), imagesy($image));

        // Save the resized image
        $resizedFileName = uniqid('resized_') . '.' . $file_ext;
        $resizedFilePath = $destinationFolder  . $resizedFileName;

        if ($file_ext == "jpeg" || $file_ext == "jpg") {
            if (imagejpeg($newImage, $resizedFilePath, 80)) { // Adjust the quality as needed
                // Return the file path
                $picturePath = "images/userprofilephotos/" . $resizedFileName;
                echo $picturePath;
            } else {
                $errors[] = "Failed to save the resized image.";
            }
        } elseif ($file_ext == "png") {
            if (imagepng($newImage, $resizedFilePath, 8)) { // Adjust the quality as needed
                // Return the file path
                $picturePath = "images/userprofilephotos/" . $resizedFileName;
                echo $picturePath;
            } else {
                $errors[] = "Failed to save the resized image.";
            }
        } else {
            $errors[] = "Unsupported file format.";
        }

        imagedestroy($image);
        imagedestroy($newImage);
    } else {
        print_r($errors);
    }
}
?>

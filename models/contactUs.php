<?php
if(isset($_POST['sendMessage'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['message'];
    $subject=$_POST['subject'];
    $phone=$_POST['phone'];
    $string=$email."__".$name."__".$phone."__".$subject."__".$message."__1"."\n";
    $file=fopen("../data/contactUs.txt","a");

    fwrite($file,$string);
    if(fclose($file)){
        echo "Uspesno ste poslali poruku!";
    }
    else{
        echo "Greska";
    }

}
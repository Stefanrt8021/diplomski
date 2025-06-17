<?php
function GetMessages(){
    $messages=file("../../data/contactUs.txt");
    $objekat = [];
    if(is_array($messages)){
    foreach ($messages as $key=>$m){
    list($email,$name,$phone,$subject,$message,$status)= explode("__", $m);
        $objekat[$key]["email"]=$email;
        $objekat[$key]["name"]=$name;
        $objekat[$key]["phone"]=$phone;
        $objekat[$key]["subject"]=$subject;
        $objekat[$key]["message"]=$message;
        $objekat[$key]["status"]=$status;
    }
    return $objekat;   
    }
}


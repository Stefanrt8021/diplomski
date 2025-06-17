<?php
if(isset($_POST['brisiPoruku'])){
    $id=$_POST['id'];
    $file=file("../../../data/contactUs.txt");
    $noviNiz=[];
    foreach($file as $key=>$red){
        if($key==$id){
            continue;
        }
        else{
            array_push($noviNiz,$red);
        }
    }
    $upis=implode("",$noviNiz);
    var_dump($upis);
    $fajl=fopen("../../../data/contactUs.txt","w");
    $upis=fwrite($fajl,$upis);
    if(fclose($fajl)){
        echo "Uspesno ste obrisali poruku";
    }
    else{
        echo "Doslo je do greske";
    }


}
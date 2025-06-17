<?php
if(isset($_POST['arhivirajPoruku'])){
    $id=$_POST['id'];
    $file=file("../../../data/contactUs.txt");
    $noviNiz=[];
    $red=$file[$id];
    $red=explode("__",$red);
    trim($red[5]);
    $red[5]=2;
    $string=implode("__",$red);
    $string.="\n";
    $file[$id]=$string;

    $file=implode("",$file);
    $fajl=fopen("../../../data/contactUs.txt","w");
    $upis=fwrite($fajl,$file);
    if(fclose($fajl)){
        echo "Uspesno ste arhivirali poruku";
    }
    else{
        echo "Doslo je do greske";
    }


}

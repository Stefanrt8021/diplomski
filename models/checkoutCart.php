<?php
session_start();
include_once "../config/connection.php";
global $conn;
if(isset($_POST['checkout'])){

    //$korpa = $_POST['korpa'];
    $korpa = $_POST['korpa'];

    $korisnik_id = $_SESSION['user']->id;
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $adresa = $_POST['adresa'];
    $grad = $_POST['grad'];
    $postBroj = $_POST['postBroj'];
    $telefon = $_POST['telefon'];
    $napomena = $_POST['napomena'];

    var_dump($korpa);
    $upit = "INSERT INTO korpa VALUES (null, :korisnik_id)";
    $priprema = $conn->prepare($upit);
    $priprema->bindParam(":korisnik_id", $korisnik_id);
    try{
        $priprema->execute();
        $cart_id = $conn->lastInsertId();
        $upitPorudzbina = "INSERT INTO porudzbine (korpa_id, korisnik_id, ime_prezime, telefon, adresa, grad, postanski_broj, napomena, datum_porudzbine)
         VALUES(:korpa_id, :korisnik_id, :ime_i_prezime, :telefon, :adresa, :grad, :postBroj, :napomena, now())";
        $pripremaPorudzbina = $conn->prepare($upitPorudzbina);
        $pripremaPorudzbina->bindParam(":korpa_id", $cart_id);
        $pripremaPorudzbina->bindParam(":korisnik_id", $korisnik_id);
        $imePrezime = $ime." ".$prezime;
        $pripremaPorudzbina->bindParam(":ime_i_prezime", $imePrezime);
        $pripremaPorudzbina->bindParam(":telefon", $telefon);
        $pripremaPorudzbina->bindParam(":adresa", $adresa);
        $pripremaPorudzbina->bindParam(":grad", $grad);
        $pripremaPorudzbina->bindParam(":postBroj", $postBroj);
        $pripremaPorudzbina->bindParam(":napomena", $napomena);

        $pripremaPorudzbina->execute();


        $upit = "INSERT INTO proizvodkorpa VALUES (null, :kolicina, now(), :korpa_id, :proizvod_id, :cena_finalna)";//(null, :korpa_id, :proizvod_id, :kolicina, now())";
        $priprema = $conn->prepare($upit);
        foreach($korpa as $proizvod){
            $priprema->bindParam(":korpa_id", $cart_id);
            $priprema->bindParam(":proizvod_id", $proizvod['id']);
            $priprema->bindParam(":kolicina", $proizvod['quantity']);

            $upitPriprema = "select c.cena, po.naziv as popust from proizvod p inner join
             popust po on po.id = p.popust_id 
             inner join cena c on p.id = c.proizvod_id 
             where p.id = :proizvod_id";
            $priprema2 = $conn->prepare($upitPriprema);
            $priprema2->bindParam(":proizvod_id", $proizvod['id']);
            $priprema2->execute();

            $rez2 = $priprema2->fetch();

            $cena = $rez2->cena;
            $popust = $rez2->popust;
            
            $cenaPopust = $cena - ($cena*$popust/100);
            
            $priprema->bindValue(":cena_finalna", $cenaPopust);
            
            $priprema->execute();
        }
        http_response_code(201);
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

}

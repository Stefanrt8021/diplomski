<?php
    require_once "../../config/connection.php";
    global $conn;


    $sql = "select sum(kolicina * cena_finalna) as ukupno
            from proizvodkorpa";

    $priprema = $conn->prepare($sql);
    $priprema->execute();
    $rez = $priprema->fetch();


    $ukupnaZarada = $rez ? $rez->ukupno : 0;

    $sql = "select sum(kolicina * cena_finalna) as ukupno
            from proizvodkorpa
            where date(date_order) = curdate()";

    $priprema = $conn->prepare($sql);
    $priprema->execute();
    $rez = $priprema->fetch();

    $ukupnaZaradaDanas = $rez->ukupno  ? $rez->ukupno : 0;
    

    $sql = "select count(distinct korpa_id) as ukupno_porudzba 
    from proizvodkorpa";

    $priprema = $conn->prepare($sql);
    $priprema->execute();
    $rez = $priprema->fetch();

    $ukupnoPorudzbina = $rez->ukupno_porudzba ? $rez->ukupno_porudzba : 0;


    $sql = "select count(distinct korpa_id) as ukupno_porudzba 
    from proizvodkorpa
     where date(date_order) = curdate()";

    $priprema = $conn->prepare($sql);
    $priprema->execute();
    $rez = $priprema->fetch();

    $ukupnoPorudzbinaDanas = $rez->ukupno_porudzba ? $rez->ukupno_porudzba : 0;
?>
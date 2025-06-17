<?php
include "../config/connection.php";
global $conn;
$sql="SELECT p.*, c.*, s.*, (c.cena - (c.cena * po.naziv /100 )) as cena_popust FROM proizvod p inner join popust po ON p.popust_id = po.id inner join cena c on p.id=c.proizvod_id inner join slika s on p.id=s.proizvod_id";
$rezultat=$conn->query($sql)->fetchAll();
echo json_encode($rezultat);
?>

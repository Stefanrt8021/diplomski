<?php
include "../config/connection.php";
global $conn;

if (isset($_POST['getProductsFilter'])) {
    $kategorija = $_POST['cat'];
    

    $discount = isset($_POST['discount'])?$_POST['discount']:null;
   
  
    $query = "SELECT p.id, p.naziv, s.naziv_src, c.cena FROM proizvod p 
              INNER JOIN robnagrupa r ON p.robnagrupa_id = r.id 
              INNER JOIN boja b ON p.boja_id = b.id 
              INNER JOIN cena c ON p.id = c.proizvod_id
              INNER JOIN slika s ON p.id = s.proizvod_id
              inner join popust po on p.popust_id = po.id";
    
    if($discount){
        $query.= " AND po.naziv = :popust";
    }

    if (isset($_POST['size'])) {
        $query .= " INNER JOIN proizvodvelicina pv ON p.id = pv.proizvod_id ";
        if($_POST['cat'] != "all"){
            $query .= " WHERE p.kategorija_id = :kategorija";
        }
        $niz = implode("','", $_POST['size']);
        $query .= " AND pv.velicina_id IN ('$niz')";
    } else {
        if($_POST['cat'] != "all"){
            $query .= " WHERE p.kategorija_id = :kategorija";
        }
    }

    if (isset($_POST['category1'])) {
        $niz = implode("','", $_POST['category1']);
        $query .= " AND p.robnagrupa_id IN ('$niz')";
    }

    if (isset($_POST['color'])) {
        $niz = implode("','", $_POST['color']);
        $query .= " AND p.boja_id IN ('$niz')";
    }

    if (isset($_POST['sort'])) {
        $sort = $_POST['sort'];
        switch ($sort) {
            case "1":
                $query .= " ORDER BY c.cena ASC";
                break;
            case "2":
                $query .= " ORDER BY c.cena DESC";
                break;
            case "3":
                $query .= " ORDER BY p.naziv ASC";
                break;
            case "4":
                $query .= " ORDER BY p.naziv DESC";
                break;
            default:
                $query .= "";
        }
    }

    $stmt = $conn->prepare($query);
    if($_POST['cat']!="all"){
        $stmt->bindParam(':kategorija', $kategorija);
    }
    if($discount){
        $stmt->bindParam(":popust", $discount);
    }
    $stmt->execute();
    $rezultat = $stmt->rowCount();

    if (isset($_POST['page'])) {
        $page = (int)$_POST['page'];
    } else {
        $page = 1;
    }

    $num_per_page = 9;
    $start = ($page - 1) * $num_per_page;
    if($start < 0){
        $start = 0;
    }
    $query_with_limit = $query . " LIMIT " . $start . "," . $num_per_page;
    $stmt = $conn->prepare($query_with_limit);
    if($_POST['cat']!="all"){
        $stmt->bindParam(':kategorija', $kategorija);
    }
    if($discount){
        $stmt->bindParam(":popust", $discount);
    }
    $stmt->execute();
    $rezultat1 = $stmt->fetchAll();

    $total_pages = ceil($rezultat / $num_per_page);

    $rezultat1[] = [
        'broj' => $total_pages
    ];

    echo json_encode($rezultat1);
}
?>

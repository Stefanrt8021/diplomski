
<?php

function GetCategories(){
    global $conn;
    
    $query= "SELECT * FROM kategorija";
    $result= $conn->query($query)->fetchAll();
    return $result;
}
function GetSubCategories(){
    global $conn;
    if(isset($_GET['category']) && $_GET['category']!="all"){
        $id = $_GET['category'];
    }
    $query= "SELECT * FROM robnagrupa where kategorija_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->fetchAll();
}
// function GetSubCategories(){
//     global $conn;
//     if (!isset($_GET['category'])) {
//         return []; // ili baci grešku ako je to očekivano
//     }
//     $id=$_GET['category'];
//     $query= "SELECT * FROM kategorija inner join robnagrupa on kategorija.id=robnagrupa.kategorija_id where kategorija.id=$id";
//     $result= $conn->query($query)->fetchAll();
//     return $result;
// }

function GetNavItems(){
    global $conn;
    $query= "SELECT * FROM nav";
    $result= $conn->query($query)->fetchAll();
    return $result;
}
function GetProducts($id){
    global $conn;
    if ($id == "all") {
        // Ako je više ID-eva (npr. "1,2")
        $query = "SELECT * FROM proizvod p 
                  INNER JOIN slika s ON p.id = s.proizvod_id";
    } else {
        // Ako je samo jedan ID
        $query = "SELECT * FROM proizvod p 
                  INNER JOIN slika s ON p.id = s.proizvod_id 
                  WHERE p.kategorija_id = $id";
    }
    //$query= "SELECT * FROM proizvod p inner join slika s on p.id=s.proizvod_id where p.kategorija_id=$id";
    $result= $conn->query($query)->fetchAll();
    return $result;
}
// function GetProductByDiscount($popust, $kategorija) {
//     global $conn;

//     $kategorijaNiz = array_map("trim", explode(",", $kategorija));

//     $placeholders = implode(",", array_fill(0, count($kategorijaNiz),"?"));

//     $query = "SELECT p.* FROM proizvod p inner join popust po on p.popust_id=po.id WHERE po.naziv = ? and
//                 p.kategorija_id in ($placeholders)";
//     $params = array_merge([$popust], $kategorijaNiz);

//     $stmt = $conn->prepare($query);
//     $stmt->execute($params);
//     return $stmt->fetchAll();
// }
function GetColors(){
    global $conn;
    $query= "SELECT * FROM boja";
    $result= $conn->query($query)->fetchAll();
    return $result;
}
function GetSizes(){
    global $conn;
    $query= "SELECT * FROM velicina";
    $result= $conn->query($query)->fetchAll();
    return $result;
}

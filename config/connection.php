<?php
    include "config.php";
    PamcenjeStranice();

    try {
        $conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);

        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $ex){
        echo $ex->getMessage();
    }


    function PamcenjeStranice() {
        $trenutni_url = $_SERVER['REQUEST_URI'];
        $index_php_url = '/diplomski/index.php';
    
        if (strpos($trenutni_url, $index_php_url) === 0) {
            $parsed_url = parse_url($trenutni_url);
            if(isset($parsed_url['query'])){
                $stranica_koja_je_posecena = $parsed_url['path'] . '?' . $parsed_url['query'];
            
        
                $datum_vreme = date("d. m. Y. H:i:s");
                $ip_adresa = $_SERVER['REMOTE_ADDR'];
                $sadrzaj_za_upis = "$stranica_koja_je_posecena\t$datum_vreme\t$ip_adresa\n";
        
                $fajl_pokazivac = fopen(LOG_FAJL, "a");
                $upis = fwrite($fajl_pokazivac, $sadrzaj_za_upis);
                if ($upis) {
                    fclose($fajl_pokazivac);
                }
            }
            
        }
    }
    
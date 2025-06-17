<?php
    define("envPath",__DIR__."/.env");
define("BASE_URL",$_SERVER['DOCUMENT_ROOT']."/diplomski/");
    
    define("SERVER", env("SERVER"));
    define("DATABASE", env("DATABASE"));
    define("USERNAME", env("USERNAME"));
    define("PASSWORD", env("PASSWORD"));
define("LOG_FAJL",BASE_URL."data/log.txt");
    function env($marker){
        $niz = file(envPath);
        $trazenaVrednost = "";
    
        foreach($niz as $red){
            $red = trim($red);
    
            list($identifikator, $vrednost) = explode("=", $red);
    
            if($identifikator == $marker){
                $trazenaVrednost = $vrednost;
                break;
            }
        }
    
        return $trazenaVrednost;
    }
?>
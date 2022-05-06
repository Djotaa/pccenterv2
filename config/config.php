<?php
define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"]."/prakphpsajt");
//ovo je absolute path u lokalu, na hostingu je drugacije
define("ENV_FAJL", ABSOLUTE_PATH."/config/.env");

define("SERVER", env("SERVER"));
define("DATABASE", env("DATABASE"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

function env($marker){
    $niz = file(ENV_FAJL);
    $trazenaVrednost="";

    foreach($niz as $red){
        $red = trim($red);

        list($identifikator,$vrednost) = explode("=",$red);
        if($identifikator == $marker){
            $trazenaVrednost=$vrednost;
            break;
        }
    }
    return $trazenaVrednost;
}
?>
<?php
session_start();
include "../../config/connection.php";
include "../functions.php";
if(!isset($_SESSION['user'])){
    echo 'login';
}
elseif(isset($_SESSION['user']) && $_SESSION['user']->naziv == 'admin'){
    echo 'admin';
}
else{
    
    $user_id = $_SESSION['user']->id_korisnik;
    $product_id=$_GET['id'];
    $sql = "SELECT kolicina FROM korpa WHERE id_korisnik=$user_id AND id_proizvod = $product_id";
    $exists=dohvatiJedan($sql);
    if($exists){
        $prodsql = "SELECT cena FROM proizvod WHERE id_proizvod = $product_id";
        $kolicina = ($exists->kolicina)+1;
        if(isset($_GET['qty'])){
            $kolicina=$_GET['qty'];
            if($kolicina == 0){
                header("Location: ../../index.php?page=cart");
                exit;
            }
        }
        $price = (dohvatiJedan($prodsql)->cena)*$kolicina;
        $isUpdated = updateKorpa($user_id,$product_id,$kolicina,$price);
        if($isUpdated){
            if(isset($_GET['qty'])){
                header("Location: ../../index.php?page=cart");
            }
            echo 'success';
        }
    }
    else{
        $prodsql = "SELECT cena FROM proizvod WHERE id_proizvod = $product_id";
        $price = dohvatiJedan($prodsql)->cena;
        $isInserted = insertKorpa($user_id,$product_id,1,$price);
        if($isInserted){
            echo 'success';
        }
    }
}
?>
<?php
if(isset($_POST['btnReg'])){
    include "../../config/connection.php";
    include "../functions.php";
    $email = addslashes($_POST['tbEmail']);
    $pass = $_POST['tbPass'];
    $cryptedpass = md5($pass);

    $taken = dohvatiJedan("SELECT email FROM korisnik WHERE email = '{$email}'");
    if($taken){
        header("Location: ../../index.php?page=register&msg=taken");
    }

    try{
        $insert = dodajKorisnika($email,$cryptedpass);
        if($insert){
            header("Location: ../../index.php?page=register&msg=success");
        }
        else{
            header("Location: ../../index.php?page=register&msg=else");
        }
    }
    catch(PDOException $ex){
        echo $ex->getMessage();
    }
}
else{
    header("Location : ../../index.php");
}
?>
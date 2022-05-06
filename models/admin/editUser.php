<?php
if(!isset($_POST['btnEdit'])){
    header("Location: ../../index.php");
    exit;
}
include "../../config/connection.php";
$email = $_POST['tbMail'];
$pass = $_POST['tbPass'];
$id = $_POST['id'];
if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
    header("Location: ../../index.php?page=editUser&msg=email&id=$id");
    exit;
}
elseif(empty($pass) || strlen($pass)<7){
    header("Location: ../../index.php?page=editUser&msg=pass&id=$id");
    exit;
}
else{
    $cryptedpass=md5($pass);
    $sql = "UPDATE korisnik SET email=?,pass=? WHERE id_korisnik=?";
    $priprema = $conn->prepare($sql);
    $isUpdated = $priprema->execute([$email,$cryptedpass,$id]);
    if($isUpdated){
        header("Location: ../../index.php?page=adminUsers&msg=okUpd");
        exit;
    }
    else{
        header("Location: ../../index.php?page=editUser&msg=err&id=$id");
        exit;
    }
}
?>
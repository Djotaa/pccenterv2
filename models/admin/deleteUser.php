<?php
session_start();
    if(!isset($_SESSION['user'])){
      header('Location: ../../index.php');
      exit;
    }
    else{
        $korisnik = $_SESSION['user'];
        if($korisnik->naziv != "admin"){
            header('Location: ../../index.php');
            exit;
        }
        else{
            include "../../config/connection.php";
            $id = $_GET['id'];
            $sql = "DELETE FROM korisnik WHERE id_korisnik = :id";
            $priprema = $conn->prepare($sql);
            $priprema->bindParam(":id",$id);
            $isDeleted = $priprema->execute();
            if($isDeleted){
                header("Location: ../../index.php?page=adminUsers&msg=okDel");
            }
            else{
                header("Location: ../../index.php?page=adminUsers&msg=noDel");
            }
        }
    }
?>
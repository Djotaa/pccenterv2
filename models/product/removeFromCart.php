<?php
session_start();
include "../../config/connection.php";
$userID=$_SESSION['user']->id_korisnik;
$productID=$_GET['id'];
$sql = "DELETE FROM korpa WHERE id_korisnik = $userID AND id_proizvod = $productID";
$priprema = $conn->prepare($sql);
$priprema->execute();
header("Location: ../../index.php?page=cart");
?>
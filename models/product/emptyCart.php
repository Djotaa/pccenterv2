<?php
include "../../config/connection.php";
$id=$_GET['id'];
$sql = "DELETE FROM korpa WHERE id_korisnik = $id";
$priprema = $conn->prepare($sql);
$priprema->execute();
header("Location: ../../index.php?page=cart");
?>
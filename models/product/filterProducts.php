<?php
include "../../config/connection.php";
include "../functions.php";

$searchVal = $_POST['search'];
$sortVal = $_POST['sort'];
$catArray = json_decode($_POST['catArr']);
// var_dump();
$sqlWhere = "WHERE p.naziv_proizvod LIKE '%$searchVal%'";

foreach ($catArray as $category) {
    if (!$category) break;
    $sqlWhere = $sqlWhere . " AND " . "p.id_kategorija = $category";
}

$sqlWhere = $sqlWhere . " ORDER BY p.cena $sortVal";

$sql = "SELECT p.id_proizvod AS id, p.naziv_proizvod AS p_naziv, p.cena AS cena, k.naziv_kat AS k_naziv, sp.slika AS slika, sp.slika_thumb AS thumb FROM proizvod p INNER JOIN kategorija k ON p.id_kategorija = k.id_kategorija INNER JOIN slike_proizvod sp ON p.id_proizvod = sp.id_proizvod ";
$sql = $sql . $sqlWhere;
echo json_encode(dohvatiSve($sql));
?>
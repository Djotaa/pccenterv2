<?php
require "../../config/connection.php";
require "../functions.php";
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=kategorije.xls");
$kategorije = dohvatiSve("SELECT * FROM kategorija");
$output = "";
$output .= "
<table class—'excelTable'>
<thead>
 <tr>
 <td>ID kategorije</td>
 <td>Naziv kategorije</td>
 </tr>
</thead>
<tbody>";
foreach ($kategorije as $kat) {
 $output .= "
 <tr>
 <td>" . $kat->id_kategorija . "</td>
 <td>" . $kat->naziv_kat . "</td>
 </tr>
 ";
}
echo $output;
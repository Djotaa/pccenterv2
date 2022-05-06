<?php
include "../../config/connection.php";
include "../functions.php";
$sql = "SELECT * FROM kategorija";
echo json_encode(dohvatiSve($sql));
?>
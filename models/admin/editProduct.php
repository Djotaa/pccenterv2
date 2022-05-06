<?php
if(!isset($_POST['btnEdit'])){
    header("Location: ../../index.php");
    exit;
}
include "../../config/connection.php";
$productID = $_POST['id'];
$categoryID = $_POST['selCat'];
$name = $_POST['tbName'];
$price = $_POST['tbCena'];
$fileSize = $_FILES['fSlika']['size'];

if(empty($name)){
    header("Location: ../../index.php?page=editProduct&id=$productID&msg=name");
    exit;
}
if($price == 0){
    header("Location: ../../index.php?page=editProduct&id=$productID&msg=price");
    exit;
}

$sql = "UPDATE proizvod SET naziv_proizvod = :ime, cena = :cena, id_kategorija = :kategorija WHERE id_proizvod = :id";
$priprema = $conn -> prepare($sql);
$priprema -> bindParam(":ime", $name);
$priprema -> bindParam(":cena", $price);
$priprema -> bindParam(":kategorija", $categoryID);
$priprema -> bindParam(":id", $productID);
try{
$priprema -> execute();
if($fileSize==0){
    header("Location: ../../index.php?page=adminProducts&msg=okUpd");
}
}
catch(Exception $e) {
    header("Location: ../../index.php?page=editProduct&id=$productID&msg=err");
    exit;
}



if($fileSize>0){
    $image = $_FILES["fSlika"];
    $filename = $image["name"];
    $tmp_name = $image["tmp_name"];
    $size = $image["size"];
    list($width, $height) = getimagesize($tmp_name);
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    switch($ext){
        case 'jpeg':case 'jpg':
            $image_obj = imagecreatefromjpeg($tmp_name);
            break;
        case 'png':
            $image_obj = imagecreatefrompng($tmp_name);
            break;
        default:
            header("Location: ../../index.php?page=editProduct&id=$productID&msg=badExt");
            exit;
    }
    if ($size > 3 * 1024 * 1024) {
        header("Location: ../../index.php?page=editProduct&id=$productID&msg=imgSize");
        exit;
    }
    $new_width = 200;
    $new_height = (int)(200 * $height / $width);
    $image_thumb = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($image_thumb, $image_obj, 0, 0, 0, 0, $new_height, $new_width, $width, $height);

    $time = time();
    $image_name = $time . $filename;
    $thumbnail_name = "thumb_" . $time . $filename;
    imagejpeg($image_obj, "../../assets/img/$image_name");
    imagejpeg($image_thumb, "../../assets/img/$thumbnail_name");

    $imgsql = "UPDATE slike_proizvod SET slika = :slika, slika_thumb = :thumb WHERE id_proizvod = :id";
    $stmt = $conn->prepare($imgsql);
    $stmt->bindParam(":slika",$image_name);
    $stmt->bindParam(":thumb",$thumbnail_name);
    $stmt->bindParam(":id",$productID);

    try{
        $stmt->execute();
        header("Location: ../../index.php?page=adminProducts&msg=okUpd");
    }
    catch(Exception $e){
        header("Location: ../../index.php?page=editProduct&id=$productID&msg=err");
        exit;
    }
    
}


?>
<?php
if(!isset($_POST['btnAdd'])){
    header("Location: ../../index.php");
    exit;
}
include "../../config/connection.php";
include "../functions.php";
$categoryID = $_POST['selCat'];
$name = $_POST['tbName'];
$price = $_POST['tbCena'];
$fileSize = $_FILES['fSlika']['size'];

if($fileSize == 0){
    header("Location: ../../index.php?page=addProduct&msg=noImg");
    exit;
}
elseif(empty($name)){
    header("Location: ../../index.php?page=addProduct&msg=name");
    exit;
}
elseif($price == 0){
    header("Location: ../../index.php?page=addProduct&msg=price");
    exit;
}
elseif($categoryID == "Izaberite"){
    header("Location: ../../index.php?page=addProduct&msg=noCat");
    exit;
}
else{
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
            header("Location: ../../index.php?page=addProduct&msg=badExt");
            exit;
    }
    if ($size > 3 * 1024 * 1024) {
        header("Location: ../../index.php?page=addProduct&msg=imgSize");
        exit;
    }

    $new_width = 200;
    $new_height = (int)(200 * $height / $width);
    $image_thumb = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($image_thumb, $image_obj, 0, 0, 0, 0, $new_height, $new_width, $width, $height);

    $sql = "INSERT INTO proizvod VALUES (null,:ime,:cena,:kategorija)";
    $priprema = $conn->prepare($sql);
    $priprema -> bindParam(":ime", $name);
    $priprema -> bindParam(":cena", $price);
    $priprema -> bindParam(":kategorija", $categoryID);
    $isInserted = $priprema->execute();

    if($isInserted){
        $time = time();
        $image_name = $time . $filename;
        $thumbnail_name = "thumb_" . $time . $filename;
        imagejpeg($image_obj, "../../assets/img/$image_name");
        imagejpeg($image_thumb, "../../assets/img/$thumbnail_name");

        $productID = dohvatiJedan("SELECT id_proizvod AS id FROM proizvod WHERE id_proizvod=(SELECT MAX(id_proizvod) FROM proizvod)")->id;

        $imgsql = "INSERT INTO slike_proizvod VALUES(null,:slika,:thumb,:id)";
        $stmt = $conn->prepare($imgsql);
        $stmt->bindParam(":slika",$image_name);
        $stmt->bindParam(":thumb",$thumbnail_name);
        $stmt->bindParam(":id",$productID);

        $imgInserted = $stmt->execute();
        if($imgInserted){
            header("Location: ../../index.php?page=adminProducts&msg=okAdd");
            exit;
        }
        else{
            header("Location: ../../index.php?page=addProduct&msg=err");
            exit;
        }
    }
    else{
        header("Location: ../../index.php?page=addProduct&msg=err");
        exit;
    }
}
?>
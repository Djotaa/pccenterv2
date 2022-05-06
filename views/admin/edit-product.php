<?php
    if(!isset($_SESSION['user'])){
      header('Location: index.php');  
    }
    else{
        $korisnik = $_SESSION['user'];
        if($korisnik->naziv != "admin"){
            header('Location: index.php');
        }
        else{
            $productID = $_GET['id'];
            $product = dohvatiJedan("SELECT * FROM proizvod WHERE id_proizvod=$productID");
            if(isset($_GET['msg'])){
                $msg = $_GET['msg'];
                switch($msg){
                    case 'badExt':
                        echo "<p class='alert alert-danger'>Slika mora biti jpg,jpeg ili png.</p>";
                        break;
                    case 'imgSize':
                        echo "<p class='alert alert-danger'>Slika ne sme biti veca od 3MB.</p>";
                        break;
                    case 'name':
                        echo "<p class='alert alert-danger'>Ime ne sme biti prazno.</p>";
                        break;
                    case 'price':
                        echo "<p class='alert alert-danger'>Cena ne sme biti prazna, 0 ili tekst.</p>";
                        break;
                    case 'err':
                        echo "<p class='alert alert-danger'>Došlo je do greške.</p>";
                        break;
                }
            }
?>
<h1 class="text-center">Izmena proizvoda</h1>
<div class="container prostor d-flex justify-content-center w-50">
    <form action="models/admin/editProduct.php" name="editForm" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="tbName">Ime proizvoda</label>
            <input type="text" name="tbName" class="form-control" value="<?=$product->naziv_proizvod?>"/>
        </div>
        <div class="form-group">
            <label for="tbCena">Cena</label>
            <input type="text" name="tbCena" class="form-control" value="<?=$product->cena?>"/>
        </div>
        <div class="form-group">
            <label for="fSlika">Slika</label>
            <input type="file" name="fSlika"/>
        </div>
        <div class="form-group text-center">
        <label for="selCat">Kategorija</label>
            <select name="selCat">
                <?php
                    $kategorije = dohvatiSve("SELECT * FROM kategorija");
                    foreach($kategorije as $kat){
                ?>
                    <option value="<?=$kat->id_kategorija?>" <?php if($kat->id_kategorija == $product->id_kategorija) echo "selected";?>><?=$kat->naziv_kat?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <div class="form-group text-center">
            <input type="hidden" name="id" value="<?=$productID?>">
            <input type="submit" name="btnEdit" class="btn btn-primary" value="Izmeni" />
        </div>
    </form>
</div>
<?php 
        }
    }
?>
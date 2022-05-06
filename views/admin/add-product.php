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
                    case'noImg':
                        echo "<p class='alert alert-danger'>Dodajte sliku.</p>";
                        break;
                    case'noCat':
                        echo "<p class='alert alert-danger'>Izaberite kategoriju.</p>";
                        break;
                    case 'err':
                        echo "<p class='alert alert-danger'>Došlo je do greške.</p>";
                        break;
                }
            }
?>
<h1 class="text-center">Dodavanje novog proizvoda</h1>
<div class="container prostor d-flex justify-content-center w-50">
    <form action="models/admin/addProduct.php" name="addForm" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="tbName">Ime proizvoda</label>
            <input type="text" name="tbName" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="tbCena">Cena</label>
            <input type="text" name="tbCena" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="fSlika">Slika</label>
            <input type="file" name="fSlika"/>
        </div>
        <div class="form-group text-center">
            <label for="selCat">Kategorija</label>
            <select name="selCat">
                <option value="Izaberite">Choose</option>
                <?php
                    $kategorije = dohvatiSve("SELECT * FROM kategorija");
                    foreach($kategorije as $kat){
                ?>
                    <option value="<?=$kat->id_kategorija?>"?><?=$kat->naziv_kat?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <div class="form-group text-center">
            <input type="submit" name="btnAdd" class="btn btn-primary" value="Dodaj"/>
        </div>
    </form>
</div>
<?php 
        }
    }
?>
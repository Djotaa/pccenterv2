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
            $userID = $_GET['id'];
            $user = dohvatiJedan("SELECT * FROM korisnik WHERE id_korisnik=$userID");
            if(isset($_GET['msg'])){
                $msg = $_GET['msg'];
                switch($msg){
                    case 'email':
                        echo "<p class='alert alert-danger'>Unesite email u pravilnoj formi(npr. vaseime@gmail.com)</p>";
                        break;
                    case 'pass':
                        echo "<p class='alert alert-danger'>Lozinka mora imati bar 7 karaktera.</p>";
                        break;
                    case 'err':
                        echo "<p class='alert alert-danger'>Došlo je do greške.</p>";
                        break;
                }
            }
?>
<h1 class="text-center mt">Izmena korisnika</h1>
<div class="container prostor d-flex justify-content-center w-50">
    <form action="models/admin/editUser.php" name="editForm" method="post">
        <div class="form-group">
            <label for="tbMail">Email</label>
            <input type="text" name="tbMail" class="form-control" value="<?=$user->email?>"/>
        </div>
        <div class="form-group">
            <label for="tbPass">Lozinka</label>
            <input type="password" name="tbPass" class="form-control"/>
        </div>
        <div class="form-group text-center">
            <input type="hidden" name="id" value="<?=$userID?>">
            <input type="submit" name="btnEdit" class="btn btn-primary" value="Izmeni" />
        </div>
    </form>
</div>
<?php 
        }
    }
?>
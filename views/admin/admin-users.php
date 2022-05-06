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
?>
<div class="prostor">
    <?php
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
        switch($msg){
            case 'okDel':
                echo "<p class='alert alert-success'>Korisnik obrisan.</p>";
                break;
            case 'okUpd':
                echo "<p class='alert alert-success'>Korisnik izmenjen.</p>";
                break;
            case 'noDel':
                echo "<p class='alert alert-danger'>Došlo je do greške prilikom brisanja.</p>";
                break;
        }
    }
    ?>
    <h1 class="text-center">Korisnici</h1>
<table class="table table-responsive container">
  <thead class="thead-light">
    <tr>
      <th>RB</th>
      <th>Email</th>
      <th>Lozinka</th>
      <th>Datum reg.</th>
      <th>Izmeni</th>
      <th>Obriši</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $korisnici = dohvatiSve("SELECT * FROM korisnik");
        $rb=1;
        foreach($korisnici as $korisnik){
            if($korisnik->id_uloga != 1){
        ?>
        <tr>
            <th><?=$rb?></th>
            <td><?=$korisnik->email?></td>
            <td><?=$korisnik->pass?></td>
            <td><?=$korisnik->datum_reg?></td>
            <td><a href="index.php?page=editUser&id=<?=$korisnik->id_korisnik?>" class="btn btn-warning">Izmeni</a></td>
            <td><a href="models/admin/deleteUser.php?id=<?=$korisnik->id_korisnik?>" class="btn btn-danger">Obriši</a></td>
        </tr>
        <?php
        $rb++; 
        }
        }
    ?>
    </tbody>
</table>
</div>
<?php 
        }
    }
?>
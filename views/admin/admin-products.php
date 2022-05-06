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

    <?php
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
        switch($msg){
            case 'okDel':
                echo "<p class='alert alert-success'>Proizvod obrisan.</p>";
                break;
            case 'okUpd':
                echo "<p class='alert alert-success'>Proizvod izmenjen.</p>";
                break;
            case 'okAdd':
                echo "<p class='alert alert-success'>Proizvod dodat.</p>";
                break;
            case 'noDel':
                echo "<p class='alert alert-danger'>Došlo je do greške prilikom brisanja.</p>";
                break;
        }
    }
    ?>
    <div class="container text-center py-3">
        <a href="index.php?page=addProduct" class="btn btn-primary">Dodaj novi proizvod</a>
    </div>
<table class="table table-responsive container">
  <thead class="thead-light">
    <tr>
      <th>RB</th>
      <th>Slika</th>
      <th>Naziv</th>
      <th>Cena</th>
      <th>Kategorija</th>
      <th>Slika fajl</th>
      <th>Thumb fajl</th>
      <th>Izmeni</th>
      <th>Obriši</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $proizvodi = dohvatiProizvode();
        $rb=1;
        foreach($proizvodi as $proizvod){
        ?>
        <tr>
            <th><?=$rb?></th>
            <td><img src="assets/img/<?=$proizvod->thumb?>" class="img-fluid" alt="<?=$proizvod->p_naziv?>"></td>
            <td><?=$proizvod->p_naziv?></td>
            <td class="text-info"><?=$proizvod->cena?>,00 RSD</td>
            <td><?=$proizvod->k_naziv?></td>
            <td><?=$proizvod->slika?></td>
            <td><?=$proizvod->thumb?></td>
            <td><a href="index.php?page=editProduct&id=<?=$proizvod->id?>" class="btn btn-warning">Izmeni</a></td>
            <td><a href="models/admin/deleteProduct.php?id=<?=$proizvod->id?>" class="btn btn-danger">Obriši</a></td>
        </tr>
        <?php
        $rb++;    
        }
    ?>
    </tbody>
    </table>

<?php 
        }
    }
?>
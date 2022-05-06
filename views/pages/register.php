<?php
zabeleziStranicu('register');
?>
<div class="prostor">
    <div class="container py-5">
        <h1 class="text-center">Registracija</h1>
        <div class="row py-5">
            <div class="col-12 col-lg-5 mx-auto py-5">
                <?php
                if(isset($_GET['msg'])){
                    $msg = $_GET['msg'];
                    switch($msg){
                        case 'taken':
                            echo "<p class='alert alert-danger'>Email je zauzet.</p>";
                            break;
                        case 'success':
                            echo "<p class='alert alert-success'>Uspešna registracija. <a href='index.php?page=login'>Ulogujte se</a>";
                            break;
                        case 'else':
                            echo "<p class='alert alert-danger'>Neočekivana greška, pokušajte ponovo.";
                            break;
                    }
                }
                ?>
                <form action="models/user/register.php" name="regForm" id="regForm" method="post">
                    <div class="form-group">
                        <label for="tbEmail">Email</label>
                        <input type="text" name="tbEmail" id="tbEmail" class="form-control" />
                        <p class="greska text-danger"></p>
                    </div>
                    <div class="form-group">
                        <label for="tbPass">Lozinka</label>
                        <input type="password" name="tbPass" id="tbPass" class="form-control" />
                        <p class="greska text-danger"></p>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" name="btnReg" id="btnReg" class="btn btn-primary" value="Registrujte se" />
                        <p class="uspeh text-primary"></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
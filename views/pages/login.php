<?php
zabeleziStranicu("login");
?>
<div class="prostor">
    <div class="container py-5">
        <h1 class="text-center">Login</h1>
        <div class="row py-5">
            <div class="col-12 col-lg-5 mx-auto py-5">
                <?php if(isset($_GET['msg'])){
                 $msg = $_GET['msg']; 
                 echo'<p class="alert alert-danger">'.$msg.'</p>'; 
                }
                 ?>
                <form action="models/user/login.php" name="logForm" id="logForm" method="post">
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
                        <input type="submit" name="btnLogin" id="btnLogin" class="btn btn-primary" value="Login" />
                        <p class="uspeh text-primary"></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">PC Center</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul id="navigacija" class="navbar-nav mr-auto mt-2 mt-lg-0 w-100">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Početna</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=shop">Prodavnica</a>
            </li>
            <?php
                if(isset($_SESSION['user'])){
                    $user = $_SESSION['user'];
                    if($user->naziv == "admin"){
            ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=adminStats">Statistika</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=adminProducts">Proizvodi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=adminUsers">Korisnici</a>
                    </li>
                <?php
                    }
                    elseif($user->naziv=="korisnik"){
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=cart">Korpa<i class="fas fa-shopping-cart"></i></a>
                    </li>
                <?php
                    }
                ?>
                    <li class="nav-item ml-lg-auto">
                        <span class="text-white"><?=$user->email?></span>
                        <a class="btn btn-primary" href="models/user/logout.php">Odjavite se</a>
                    </li>
                <?php
                }
                else{
                ?>
                <li class="nav-item px-2 ml-lg-auto">
                    <a class="btn btn-primary " href="index.php?page=login">Login</a>
                </li>
                <li class="nav-item py-1 py-lg-0">
                    <a class="btn btn-primary " href="index.php?page=register">Registracija</a>
                </li>
                <?php
                }
                ?>
        </ul>
    </div>
</nav>
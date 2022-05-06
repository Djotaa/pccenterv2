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
<div class="container prostor mt-5">
    <h1 class="text-center">Statistika o posetama</h1>
    <div class="row">
        <div class="col-12 col-md-6 py-2">
            <h3 class="text-center">Posećenost stranica u poslednja 24h</h3>
            <div class="container-fluid">
                <div class="row py-2">
                    <?php
                    $pages = file("data/page-log.txt");
                    $pagesTotalCount = 0;
                    $pagesCount = ["home"=> 0,"shop" => 0, "login" => 0, "register" => 0, "author"=> 0, "cart"=> 0];
                    foreach ($pages as $page) {
                        $pageArray = explode(" ", $page);
                        $pageDate = $pageArray[0];
                        $pageName = trim($pageArray[1]);
                        if ($pageDate == date("d.m.Y.")) {
                            $pagesTotalCount++;
                            $pagesCount[$pageName]++;
                        }
                    }
                    foreach ($pagesCount as $page => $count){ ?>
                    <div class="col-6">
                        <p class="text-primary text-center"><?= $page ?>.php</p>
                    </div>
                    <div class="col-6">
                        <p class="text-info text-center"><?= round($count / $pagesTotalCount * 100) ?>%</p>
                    </div>
                    <?php 
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 py-2">
            <h3 class="text-center">Korisnici u poslednja 24h</h3>
            <div class="container-fluid">
                <div class="row py-2">
                    <?php
                    $users = file("data/user-log.txt");
                    foreach($users as $user){
                        $userArr = explode(" ",$user);
                        list($visitDate,$email) = $userArr;
                        if($visitDate == date("d.m.Y.")){
                        ?>
                        <div class="col-6">
                            <p class="text-center text-primary"><?=$visitDate?></p>
                        </div>
                        <div class="col-6">
                            <p class="text-center text-info"><?=$email?></p>
                        </div>
                        <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
        }
    }
?>
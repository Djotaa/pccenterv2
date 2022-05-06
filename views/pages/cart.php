<?php
if(!isset($_SESSION['user'])){
    header("Location: index.php");
}
zabeleziStranicu('cart');
?>
<div class="prostor">
    <h1 class="text-center">Korpa</h1>
    <div class="container row mx-auto mt-5 align-items-start justify-content-start" id="korpa">
        <?php
        $userID=$_SESSION['user']->id_korisnik;
        $sql = "SELECT * FROM korpa WHERE id_korisnik = $userID";
        $cart = dohvatiSve($sql);
        if(count($cart)==0){
            echo '<div class="container m-5 alert alert-danger"><p>Nemate ništa u korpi. Pogledajte <a href="index.php?page=shop">prodavnicu</a></p></div>';
        }
        $total = 0;
        foreach($cart as $cartItem){
            $product = dohvatiProizvod($cartItem->id_proizvod);
            $total+=$cartItem->cena;
        ?>
            <div class="row mx-0 my-2 align-items-center justify-space-between border p-3 w-100">
                <div class="col-4 col-lg-2">
                    <img class="img-fluid" src="assets/img/<?=$product->thumb?>" alt="<?=$product->p_naziv?>"/>
                </div>
                <div class="col-8 col-lg-3">
                    <h6>Naziv</h6>
                    <h4><?=$product->p_naziv?></h4>
                </div>
                <div class="col-4 col-lg-2 px-0">
                    <h6>Cena</h6>
                    <span class="font-weight-bold"><?=$product->cena?>,00 RSD</span>
                </div>  
                <div class="col-4 col-lg-1 mt-3 mt-lg-0 px-0">
                    <h6>Količina</h6>
                    <a href="models/product/addToCart.php?id=<?=$cartItem->id_proizvod?>&qty=<?=$cartItem->kolicina-1?>" class="text-dark"><i class="fas fa-minus"></i></a>
                    <span><?=$cartItem->kolicina?></span>
                    <a href="models/product/addToCart.php?id=<?=$cartItem->id_proizvod?>&qty=<?=$cartItem->kolicina+1?>" class="text-dark"><i class="fas fa-plus"></i></a>
                </div>
                <div class="col-4 col-lg-2">
                    <h6>Ukupna cena</h6>
                    <span class="font-weight-bold"><?=$cartItem->cena?>,00 RSD</span>
                </div>
                <div class="col-12 col-lg-1 mt-3 mt-lg-0 text-right">
                    <a href="models/product/removeFromCart.php?id=<?=$cartItem->id_proizvod?>" class="btn btn-danger obrisi">Ukloni</a> 
                </div>
            </div>
        <?php
        }
        if(count($cart)){
        ?>
        <div class="total w-100 text-right pb-3">
            <p>Ukupna cena je <span class="font-weight-bold"><?=$total?>,00 RSD</span></p>
            <a href="models/product/emptyCart.php?id=<?=$userID?>" class="btn btn-danger">Ukloni sve</a>
            </div>
        <?php 
        }?>
    </div>
</div>

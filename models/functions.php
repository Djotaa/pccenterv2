<?php
function zabeleziStranicu($stranica){

    $datum = date("d.m.Y.");

    $sadrzaj = "$datum $stranica\n";

    $fajl = fopen("data/page-log.txt", "a");
    $upis = fwrite($fajl, $sadrzaj);
    if($upis){
        fclose($fajl);
    }
}

function zabeleziLogin($email){
    $datum = date("d.m.Y.");
    $sadrzaj = "$datum $email\n";

    $fajl = fopen("../../data/user-log.txt","a");
    $upis = fwrite($fajl,$sadrzaj);
    if($upis){
        fclose($fajl);
    }    
}

function dohvatiProizvode(){
    global $conn;
    $sql ="SELECT p.id_proizvod AS id, p.naziv_proizvod AS p_naziv, p.cena AS cena, k.naziv_kat AS k_naziv, sp.slika AS slika, sp.slika_thumb AS thumb FROM proizvod p INNER JOIN kategorija k ON p.id_kategorija = k.id_kategorija INNER JOIN slike_proizvod sp ON p.id_proizvod = sp.id_proizvod";
    return $conn->query($sql)->fetchAll();
}

function dohvatiProizvod($id){
    global $conn;
    $sql ="SELECT p.id_proizvod AS id, p.naziv_proizvod AS p_naziv, p.cena AS cena, k.naziv_kat AS k_naziv, sp.slika AS slika, sp.slika_thumb AS thumb FROM proizvod p INNER JOIN kategorija k ON p.id_kategorija = k.id_kategorija INNER JOIN slike_proizvod sp ON p.id_proizvod = sp.id_proizvod WHERE p.id_proizvod=:id";
    $priprema = $conn->prepare($sql);
    $priprema->bindParam(':id',$id);
    $priprema->execute();

    return $priprema->fetch();
}

function insertKorpa($userID,$productID,$kolicina,$cena){
    global $conn;
    $insert = $conn->prepare("INSERT INTO korpa VALUES(?,?,?,?)");
    $isInserted = $insert->execute([$userID, $productID,$kolicina,$cena]);
    return $isInserted;
}

function updateKorpa($userID,$productID,$kolicina,$cena){
    global $conn;
    $update = $conn->prepare("UPDATE korpa SET kolicina=?, cena = ? WHERE id_korisnik = ? AND id_proizvod = ?");
    $isUpdated = $update->execute([$kolicina,$cena,$userID,$productID]);
    return $isUpdated;
}

function dohvatiKorisnika($email, $cryptedPass){
    global $conn;

    $upit = "SELECT * FROM korisnik k JOIN uloga u ON k.id_uloga=u.id_uloga WHERE k.email = :email AND k.pass = :lozinka";

    $priprema = $conn->prepare($upit);
    $priprema->bindParam(':email', $email);
    $priprema->bindParam(':lozinka', $cryptedPass);
    $priprema->execute();

    $rezultat = $priprema->fetch();
    return $rezultat;
}

function dodajKorisnika($email,$cryptedPass){
    global $conn;
    $datum = date("Y-m-d");
    $upit = "INSERT INTO korisnik VALUES(null,?,?,?,2)";
    $priprema = $conn->prepare($upit);
    $result = $priprema->execute([$email,$cryptedPass,$datum]);
    return $result;
}

function dohvatiJedan($query)
{
 global $conn;
 return $conn->query($query)->fetch();
}

function dohvatiSve($query)
{
 global $conn;
 return $conn->query($query)->fetchAll();
}

?>
<?php
    session_start();
    if(isset($_POST['btnLogin'])){
        include "../../config/connection.php";
        include "../functions.php";

        try{
            $email = $_POST['tbEmail'];
            $pass = $_POST['tbPass'];

            $encryptPass = md5($pass);
            $rezLogovanja = dohvatiKorisnika($email, $encryptPass);

            // var_dump($rezLogovanja);
            if($rezLogovanja){
                $_SESSION['user'] = $rezLogovanja;
                zabeleziLogin($rezLogovanja->email);
                if($rezLogovanja->naziv == "admin"){
                    header("Location: ../../index.php?page=adminStats");
                }
                else{
                    header("Location: ../../index.php");
                }
            }
            else{
                header('Location: ' . $_SERVER['HTTP_REFERER'] . '&msg=Pogrešan email ili lozinka');
            }
        }
        catch(PDOException $exception){
            http_response_code(500);
        }
    }
    else{
        header('Location: ../../index.php');
    }
?>
<?php
session_start();
require "config/connection.php";
require "models/functions.php";
include "views/fixed/head.php";
include "views/fixed/nav.php";
if(isset($_GET['page'])){
    switch($_GET['page']){
        case 'home':
            include "views/pages/home.php";
            break;
        case 'shop':
            include "views/pages/shop.php";
            break;
        case 'cart':
            include "views/pages/cart.php";
            break;
        case 'author':
            include "views/pages/author.php";
            break;
        case 'login':
            include "views/pages/login.php";
            break;
        case 'register':
            include "views/pages/register.php";
            break;
        case 'adminStats':
            include "views/admin/admin-stats.php";
            break;
        case 'adminProducts':
            include "views/admin/admin-products.php";
            break;
        case 'adminUsers':
            include "views/admin/admin-users.php";
            break;
        case 'editProduct':
            include "views/admin/edit-product.php";
            break;
        case 'addProduct':
            include "views/admin/add-product.php";
            break;
        case 'editUser':
            include "views/admin/edit-user.php";
            break;
        default:
            include "views/pages/home.php";
            break;
    }
}
else{
    include "views/pages/home.php";
}

include "views/fixed/footer.php";
?>
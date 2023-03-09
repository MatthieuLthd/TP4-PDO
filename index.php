<?php session_start(); ?>
<?php include "vues/header.php";

$uc =empty($_GET['uc']) ?  "accueil" : $_GET['uc'];

switch($uc){
  case 'accueil' :
    include('vues/accueil.php');
    break;
  case 'continent' :
    break;
}

include "vues/footer.php";?>
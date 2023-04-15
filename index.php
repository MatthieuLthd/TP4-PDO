<?php
ob_start();
session_start();
include "vues/header.php";
include "modeles/Continent.php";
include "modeles/Nationalite.php";
include "modeles/Auteur.php";
include "modeles/Genre.php";
include "modeles/Livre.php";
include "modeles/connexionPdo.php";
include "vues/messagesFlash.php";

$uc =empty($_GET['uc']) ?  "accueil" : $_GET['uc'];

switch($uc){
  case 'accueil' :
    include('vues/accueil.php');
    break;
  case 'continents' :
    include('controllers/continentController.php');
    break;
  case 'nationalites' :
    include('controllers/nationaliteController.php');
    break;
  case 'auteurs' :
    include('controllers/auteurController.php');
    break;
  case 'genres' :
    include('controllers/genreController.php');
    break;
  case 'livres' :
    include('controllers/livreController.php');
    break;
}

include "vues/footer.php";?>
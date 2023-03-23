<?php
$action=$_GET['action'];
switch($action){
    case 'list' :
        $lesNationalites=Continent::findAll();
        include('vues/Nationalite/listeNationalite.php');
        break;

    case 'add' :
        $mode="Ajouter";
        include ('vues/Nationalite/listeNationalite.php');
        break;

    case 'update' :
        $mode="Modifier";
        $continent=Continent::findById($_GET['num']);
        include ('vues/Nationalite/listeNationalite.php');
        break;

    case 'delete' :
        $continent=Continent::findById($_GET['num']);
        $nb=Continent::delete($continent);
        if($nb==1){
            $_SESSION['message'] = ["success" => "La nationalité a bien été supprimée"];
        }else{
            $_SESSION['message'] = ["warning" => "La nationalité n'a pas été supprimée"];
    
        }
        header('location: index.php?uc=nationalites&action=list');
        exit();
        break;

    case 'valideForm' :
        $continent = new Continent();
        if(empty($_POST['num'])){ // cas d'une création 
            $continent->setLibelle($_POST['libelle']);
            $nb=Continent::add($continent);
            $message='ajouté';
        }else{ // cas d'une modif 
            $continent->setNum($_POST['num']);
            $continent->setLibelle($_POST['libelle']);
            $nb=Continent::update($continent);
            $message='modifié';
        }
        if($nb==1){
            $_SESSION['message'] = ["success" => "La nationalité a bien été $message"];
        }else{
            $_SESSION['message'] = ["warning" => "La nationalité n'a pas été $message"];

        }
        header('location: index.php?uc=nationalites&action=list');
        exit();
        break;

}

?>
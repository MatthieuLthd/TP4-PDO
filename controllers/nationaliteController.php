<?php
$action=$_GET['action'];
switch($action){
    case 'list' :
        $lesNationalites=Nationalite::findAll();
        include('vues/Nationalite/listeNationalite.php');
        break;

    case 'add' :
        $mode="Ajouter";
        include ('vues/Nationalite/listeNationalite.php');
        break;

    case 'update' :
        $mode="Modifier";
        $nationalite=Nationalite::findById($_GET['num']);
        include ('vues/Nationalite/listeNationalite.php');
        break;

    case 'delete' :
        $nationalite=Nationalite::findById($_GET['num']);
        $nb=Nationalite::delete($nationalite);
        if($nb==1){
            $_SESSION['message'] = ["success" => "La nationalité a bien été supprimée"];
        }else{
            $_SESSION['message'] = ["warning" => "La nationalité n'a pas été supprimée"];
    
        }
        header('location: index.php?uc=nationalites&action=list');
        exit();
        break;

    case 'valideForm' :
        $nationalite = new Nationalite();
        if(empty($_POST['num'])){ // cas d'une création 
            $nationalite->setLibelle($_POST['libelle']);
            $nb=Nationalite::add($nationalite);
            $message='ajouté';
        }else{ // cas d'une modif 
            $nationalite->setNumNationalite($_POST['num']);
            $nationalite->setLibelle($_POST['libelle']);
            $nb=Nationalite::update($nationalite);
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
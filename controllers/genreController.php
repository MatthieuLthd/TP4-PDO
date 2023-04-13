<?php
$action=$_GET['action'];
switch($action){
    case 'list' :
        $lesGenres=Genre::findAll();
        include('vues/Genre/listeGenres.php');
        break;

    case 'add' :
        $mode="Ajouter";
        include ('vues/Genre/formGenre.php');
        break;

    case 'update' :
        $mode="Modifier";
        $genre=Genre::findById($_GET['num']);
        include ('vues/Genre/formGenre.php');
        break;

    case 'delete' :
        $genre=Genre::findById($_GET['num']);
        $nb=Genre::delete($genre);
        if($nb==1){
            $_SESSION['message'] = ["success" => "Le genre a bien été supprimé"];
        }else{
            $_SESSION['message'] = ["warning" => "Le genre n'a pas été supprimé"];
    
        }
        header('location: index.php?uc=genres&action=list');
        exit();

    case 'valideForm' :
        $genre = new Genre();
        if(empty($_POST['num'])){ // cas d'une création 
            $genre->setLibelle($_POST['libelle']);
            $nb=Genre::add($genre);
            $message='ajouté';
        }else{ // cas d'une modif 
            $genre->setNum($_POST['num']);
            $genre->setLibelle($_POST['libelle']);
            $nb=Genre::update($genre);
            $message='modifié';
        }
        if($nb==1){
            $_SESSION['message'] = ["success" => "Le genre a bien été $message"];
        }else{
            $_SESSION['message'] = ["warning" => "Le genre n'a pas été $message"];

        }
        header('location: index.php?uc=genres&action=list');
        exit();

}

?>
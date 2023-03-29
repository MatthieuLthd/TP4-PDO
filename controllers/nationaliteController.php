<?php
$action=$_GET['action'];
switch($action){
    case 'list' :
        // traitement form de recherche
        $libelle="";
        $continentSel="Tous";
        if(!empty($_POST["libelle"]) || !empty($_POST["continent"])){
            $libelle = $_POST["libelle"];
            $continentSel = $_POST["continent"];
        }
        $lesContinents = Continent::findAll();
        $lesNationalites=Nationalite::findAll($libelle, $continentSel);
        include('vues/Nationalite/listeNationalite.php');
        break;

    case 'add' :
        $mode="Ajouter";
        include ('vues/Nationalite/formNationalite.php');
        break;

    case 'update' :
        $mode="Modifier";
        $nationalite=Nationalite::findById($_GET['num']);
        include ('vues/Nationalite/formNationalite.php');
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
            var_dump($nationalite);
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
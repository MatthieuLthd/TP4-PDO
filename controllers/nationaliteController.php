<?php
$action=$_GET['action'];
switch($action){
    case 'list' :
        // traitement du formulaire de recherche
        $libelle="";
        $continentSel="Tous";
        if(!empty($_POST['libelle']) || !empty($_POST['continent'])){
            $libelle= $_POST['libelle'];
            $continentSel= $_POST['continent'];
        }
        $lesContinents=Continent::findAll();
        $lesNationalites=Nationalite::findAll($libelle, $continentSel);
        include('vues/Nationalite/listeNationalites.php');
        break;

    case 'add' :
        $mode="Ajouter";
        $lesContinents=Continent::findAll();
        include ('vues/Nationalite/formNationalite.php');
        break;

    case 'update' :
        $mode="Modifier";
        $lesContinents=Continent::findAll();
        $laNationalite=Nationalite::findById($_GET['num']);
        include ('vues/Nationalite/formNationalite.php');
        break;

    case 'delete' :
        $laNationalite=Nationalite::findById($_GET['num']);
        $nb=Nationalite::delete($laNationalite);
        if($nb==1){
            $_SESSION['message'] = ["success" => "Le nationalite a bien été supprimé"];
        }else{
            $_SESSION['message'] = ["warning" => "Le nationalite n'a pas été supprimé"];
    
        }
        header('location: index.php?uc=nationalites&action=list');
        exit();
        break;

    case 'validerForm' :
        $nationalite = new Nationalite();
        var_dump($_POST);
        $continent=Continent::findById($_POST['continent']);
        if(empty($_POST['num'])){ // cas d'une création 
            $nationalite->setLibelle($_POST['libelle'])
                        ->setContinent($continent);
            $nb=Nationalite::add($nationalite);
            $message='ajouté';
        }else{ // cas d'une modif 
            $nationalite->setNum($_POST['num'])
                        ->setLibelle($_POST['libelle']);
            $nb=Nationalite::update($nationalite);
            $message='modifié';
        }
        if($nb==1){
            $_SESSION['message'] = ["success" => "Le nationalite a bien été $message"];
        }else{
            $_SESSION['message'] = ["warning" => "Le nationalite n'a pas été $message"];

        }
        header('location: index.php?uc=nationalites&action=list');
        exit();
        break;

}

?>
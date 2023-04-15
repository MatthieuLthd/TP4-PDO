<?php
$action=$_GET['action'];
switch($action){
    case 'list' :
        // traitement du formulaire de recherche
        $titre="";
        $auteurSel="Tous";
        $genreSel="Tous";
        if(!empty($_POST['titre'])){
            $titre= $_POST['titre'];
        }
        if(!empty($_POST['numAuteur'])){
            $auteurSel= $_POST['numAuteur'];
        }
        if(!empty($_POST['numGenre'])){
            $genreSel= $_POST['numGenre'];
        }

        //$lesLivres=Livre::findAll($titre, $auteurSel, $genreSel);
        $lesLivres=Livre::findAll();

        $lesAuteurs=Auteur::findAll();        
        $lesGenres=Genre::findAll();        
        include('vues/Livre/listeLivres.php');
        break;

    case 'add' :
        $mode="Ajouter";
        $lesNationalites=Nationalite::findAll();
        include ('vues/Livre/formAuteur.php');
        break;

    case 'update' :
        $mode="Modifier";
        $lesNationalites=Nationalite::findAll();
        $laAuteur=Auteur::findById($_GET['num']);
        include ('vues/Livre/formAuteur.php');
        break;

    case 'delete' :
        $laAuteur=Auteur::findById($_GET['num']);
        $nb=Auteur::delete($laAuteur);
        if($nb==1){
            $_SESSION['message'] = ["success" => "L'auteur a bien été supprimé"];
        }else{
            $_SESSION['message'] = ["warning" => "L'auteur n'a pas été supprimé"];
    
        }
        header('location: index.php?uc=livres&action=list');
        exit();
        break;

    case 'validerForm' :
        $auteur = new Auteur();
        $nationalite=Nationalite::findById($_POST['nationalite']);
        if(empty($_POST['num'])){ // cas d'une création 
            $auteur->setNom($_POST['nom'])
                    ->setPrenom($_POST['Prenom'])
                    ->setNationalite($nationalite);
            $nb=Auteur::add($auteur);
            $message='ajouté';
        }else{ // cas d'une modif 
            $auteur->setNum($_POST['num'])
                        ->setNom($_POST['nom'])
                        ->setPrenom($_POST['Prenom'])
                        ->setNationalite($nationalite);
            $nb=Auteur::update($auteur);
            $message='modifié';
        }
        
        if($nb==1){
            $_SESSION['message'] = ["success" => "L'auteur a bien été $message"];
        }else{
            $_SESSION['message'] = ["warning" => "L'auteur n'a pas été $message"];

        }
        header('location: index.php?uc=livres&action=list');
        exit();
        break;

}

?>
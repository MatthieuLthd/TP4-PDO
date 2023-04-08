<?php
$action=$_GET['action'];
switch($action){
    case 'list' :
        // traitement du formulaire de recherche
        $nom="";
        $prenom="";
        $nationaliteSel="Tous";
        if(!empty($_POST['nom']) || !empty($_POST['nationalite'])){
            $nom= $_POST['nom'];
            $prenom= $_POST['prenom'];
            $nationaliteSel= $_POST['nationalite'];
        }
        $lesAuteurs=Auteur::findAll();
        $lesAuteurs=Auteur::findAll($nom, $nationaliteSel);        
        include('vues/Auteur/listeAuteurs.php');
        break;

    case 'add' :
        $mode="Ajouter";
        $lesAuteurs=Auteur::findAll();
        include ('vues/Auteur/formAuteur.php');
        break;

    case 'update' :
        $mode="Modifier";
        $lesAuteurs=Auteur::findAll();
        $laAuteur=Auteur::findById($_GET['num']);
        include ('vues/Auteur/formAuteur.php');
        break;

    case 'delete' :
        $laAuteur=Auteur::findById($_GET['num']);
        $nb=Auteur::delete($laAuteur);
        if($nb==1){
            $_SESSION['message'] = ["success" => "L'auteur a bien été supprimé"];
        }else{
            $_SESSION['message'] = ["warning" => "L'auteur n'a pas été supprimé"];
    
        }
        header('location: index.php?uc=auteurs&action=list');
        exit();
        break;

    case 'validerForm' :
        $auteur = new Auteur();
        $auteur=Auteur::findById($_POST['auteur']);
        if(empty($_POST['num'])){ // cas d'une création 
            $auteur->setLibelle($_POST['libelle'])
                        ->setNationalite($auteur);
            $nb=Auteur::add($auteur);
            $message='ajouté';
        }else{ // cas d'une modif 
            $auteur->setNum($_POST['num'])
                        ->setLibelle($_POST['libelle'])
                        ->setNationalite($auteur);
            $nb=Auteur::update($auteur);
            $message='modifié';
        }
        if($nb==1){
            $_SESSION['message'] = ["success" => "L'auteur a bien été $message"];
        }else{
            $_SESSION['message'] = ["warning" => "L'auteur n'a pas été $message"];

        }
        header('location: index.php?uc=auteurs&action=list');
        exit();
        break;

}

?>
<?php include "header.php";
include "connexionPdo.php";
$action = $_GET['action'];
$num = $_POST['num']; // récup libellé formulaire
$libelle = $_POST['libelle']; // recup libellé formulaire


if($action == "Modifier"){
    $req=$monPdo->prepare("UPDATE genre set libelle = :libelle where num = :num");
    $req->bindParam(':num', $num);
    $req->bindParam(':libelle', $libelle);
    
}else{
    $req=$monPdo->prepare("INSERT INTO genre(libelle) VALUES(:libelle)");
    $req->bindParam(':libelle', $libelle);
}
$nb = $req->execute();

// formulation de condition if else simple en 1 ligne :
$message= $action == "Modifier" ? "modifiée" : "ajoutée";
// La condition | ? = valeur donnée si cond vrai | : = else autre valeur 

echo '<div class="container mt-5">';
echo '<div class="row">
    <div class="col mt-5">';

if($nb == 1) {
    echo '<div class="alert alert-success" role="alert">
    Le genre a bien été ' . $message . 
    '</div> ';

}else{
    echo ' <div class="alert alert-warning" role="alert">
    Le genre n\'a pas été ' . $message . ' !
    </div> ';

}
?>
</div>
</div>
    <a href="listeGenres.php" class="btn btn-primary">Revenir à la liste des genres</a>
    </div>



</div>


<?php include "footer.php";
?>
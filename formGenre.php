<?php include "header.php";
$action = $_GET['action']; // Soit ajouter soit modifier
include "connexionPdo.php";

if($action == "Modifier"){
    $num = $_GET['num'];
    $req = $monPdo->prepare("select * from genre where num = :num");
    $req->setFetchMode(PDO::FETCH_OBJ);
    $req->bindParam(':num', $num);
    $req->execute();
    $leGenre = $req->fetch();
}
?>


<div class="container mt-5">
<h2 class="pt-3 text-center"><?php echo $action?> un genre</h2>
    <form action="valideFormGenre.php?action=<?php echo $action?>" method="post" class="col-md-6 offset-md-3 border border-primary p-3 rounded">
        <div class="form-group">
            <label for="libelle" > Libellé </label>
            <input type="text" class='form-control' id="libelle" placehoder="Saisir le libellé" name="libelle" value="<?php if($action == "Modifier"){echo $leGenre->libelle;} ?>">
        </div>
        <input type="hidden" id="num" name="num" value="<?php if($action == "Modifier"){echo $leGenre->num;} ?>">
        <div class="row">
            <div class="col"> <a href="listeGenres.php" class="btn btn-warning btn-block">Revenir à la liste</a> </div>
            <div class="col"><button type="submit" class="btn btn-success btn-block"> <?php echo $action?> </button> </div>
        </div>
    </form>

    
</div>

<?php include "footer.php";
?>
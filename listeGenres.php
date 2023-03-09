<?php include "header.php";
include "connexionPdo.php";
$nature=" ce genre ";
$libelle="";
$genreSel="Tous";
// Construction de la requête
$textReq="select g.num, g.libelle as 'libGenre' from genre g";
if(!empty($_GET)){
    $libelle = $_GET['libelle'];
    if($libelle != "") { $textReq.= " where g.libelle like '%".$libelle."%'";}
}

$req = $monPdo->prepare($textReq);
$req->setFetchMode(PDO::FETCH_OBJ);
$req->execute();
$lesGenres = $req->fetchAll();

?>


<div class="container mt-5">

    <div class="row pt-3">
            <div class="col-9"><h2>Listes des genres</h2></div>
            <div class="col-3"><a href="formGenre.php?action=Ajouter" class="btn btn-succes"><i class="fas fa-plus-circle"></i>Créer un genre</a></div>
        
    </div>


    <form action="" method="get" class="border border-primary rounded p-3 mt-3 mb-3">
        <div class="row">
            <div class="col">
                <input type="text" class='form-control' id="libelle" placehoder="Saisir le libellé" name="libelle" value="<?php echo $libelle; ?>">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-success btn-block">Rechercher</button>
            </div>
        </div>
    </form>

    <table class="table table-striped">
    <thead>
        <tr class="d-flex">
        <th scope="col" class="col-md-2">Numéro</th>
        <th scope="col" class="col-md-8">Libellé</th>
        <th scope="col" class="col-md-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($lesGenres as $genres){
            echo "<tr class='d-flex'>";
            echo "<td class='col-md-2' >$genres->num</td>";
            echo "<td class='col-md-8' >$genres->libGenre</td>";
            echo "<td class='col-md-2'>
                <a href='formGenre.php?action=Modifier&num=$genres->num' class='btn btn-info'><i class='fas fa-pen'></i></a>
                <a href='#modalSuppr' data-toggle='modal' data-message='Etes-vous sûr de vouloir supprimer ce genre ?' data-Suppr='supprGenre.php?num=$genres->num' class ='btn btn-warning'><i class ='far fa-trash-alt'></i></a>
            </td>";
            echo "</tr>";
        }
        ?>

        
    </tbody>
    </table>
</div>

<?php include "footer.php";
?>
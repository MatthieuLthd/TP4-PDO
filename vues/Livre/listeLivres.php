<div class="container mt-5">

    <div class="row pt-3">
            <div class="col-9"><h2>Listes des Livres</h2></div>
            <div class="col-3"><a href="index.php?uc=livres&action=add" class="btn btn-succes"><i class="fas fa-plus-circle"></i>Créer un livre</a></div>
        
    </div>


    <form id="formRecherche" action="index.php?uc=livres&action=list" method="post" class="border border-primary rounded p-3 mt-3 mb-3">
        <div class="row">
            <div class="col">
                <input type="text" class='form-control' id="titre" placehoder="Saisir le titre" name="titre" value="<?php echo $titre; ?>">
            </div>
            <div class="col">
            <select name="numAuteur" class='form-control'>
                        <?php
                        var_dump($lesLivres);
                        echo "<option value='Tous'>Tout les auteurs</option>";
                        foreach($lesAuteurs as $auteur){
                            $selection=$auteur->numero == $auteurSel ? 'selected' : '';
                            echo "<option value='".$auteur->numero."'". $selection.">".$auteur->nomA."</option>";
                        }
                        ?>
                </select>
            </div>
            <div class="col">
                <select name="numGenre" class='form-control'>
                        <?php
                        echo "<option value='Tous'>Tout les genres</option>";
                        foreach($lesGenres as $genre){
                            $selection=$genre->getNum() == $genreSel ? 'selected' : '';
                            echo "<option value='".$genre->getNum()."'". $selection.">".$genre->getLibelle()."</option>";
                        }
                        ?>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-success btn-block">Rechercher</button>
            </div>
        </div>
    </form>


    <table class="table table-striped">
    <thead>
        <tr class="d-flex">
        <th scope="col" class="col-md-1">ISBN</th>
        <th scope="col" class="col-md-2">Titre</th>
        <th scope="col" class="col-md-1">Prix</th>
        <th scope="col" class="col-md-2">Editeur</th>
        <th scope="col" class="col-md-1">Année</th>
        <th scope="col" class="col-md-2">Langue</th>
        <th scope="col" class="col-md-1">Auteur</th>
        <th scope="col" class="col-md-1">Genre</th>
        <th scope="col" class="col-md-1">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($lesLivres as $livre){
            echo "<tr class='d-flex'>";
            echo "<td class='col-md-1' >$livre->isbn</td>";
            echo "<td class='col-md-2' >$livre->titreL</td>";
            echo "<td class='col-md-1' >$livre->prixL</td>";
            echo "<td class='col-md-2' >$livre->editeurL</td>";
            echo "<td class='col-md-1' >$livre->anneeL</td>";
            echo "<td class='col-md-2' >$livre->langueL</td>";
            echo "<td class='col-md-1' >$livre->numAuteurL</td>";
            echo "<td class='col-md-1' >$livre->numGenreL</td>";
            echo "<td class='col-md-1'>
                <a href='index.php?uc=livres&action=update&num=".$livre->numero."' class='btn btn-info'><i class='fas fa-pen'></i></a>
                <a href='#modalSuppr' data-toggle='modal' data-message='Etes-vous sûr de vouloir supprimer ce livre ?' data-Suppr='index.php?uc=livres&action=delete&num=".$livre->numero."' class ='btn btn-warning'><i class ='far fa-trash-alt'></i></a>
            </td>";
            echo "</tr>";
        }
        ?>

        
    </tbody>
    </table>
</div>
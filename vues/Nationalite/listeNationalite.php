<div class="container mt-5">

    <div class="row pt-3">
            <div class="col-9"><h2>Listes des nationalités</h2></div>
            <div class="col-3"><a href="index.php?uc=nationalites&action=add" class="btn btn-succes"><i class="fas fa-plus-circle"></i>Créer une nationalité</a></div>
        
    </div>
    <form action="index.php?uc=nationalites&action=list" method="post" class="border border-primary rounded p-3 mt-3 mb-3">
        <div class="row">
            <div class="col">
                <input type="text" class='form-control' id="libelle" placehoder="Saisir le libellé" name="libelle" value="<?php echo $libelle; ?>">
            </div>
            <div class="col">
                <select name="continent" class='form-control'>
                        <?php
                        echo "<option value='Tous'>Tous les continents</option>";
                        foreach($lesContinents as $continent){
                            $selection=$continent->num == $continentSel ? 'selected' : '';
                            echo "<option value='$continent->num' $selection>$continent->libelle</option>";
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
        <th scope="col" class="col-md-2">Numéro</th>
        <th scope="col" class="col-md-4">Libellé</th>
        <th scope="col" class="col-md-4">Continent</th>
        <th scope="col" class="col-md-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($lesNationalites as $nationalite){
            echo "<tr class='d-flex'>";
            echo "<td class='col-md-2' >".$nationalite->num."</td>";
            echo "<td class='col-md-4' >".$nationalite->libelle."</td>";
            echo "<td class='col-md-4' >$nationalite->libContinent</td>";
            echo "<td class='col-md-2'>
                <a href='index.php?uc=nationalites&action=update&num=".$nationalite->num."' class='btn btn-info'><i class='fas fa-pen'></i></a>
                <a href='#modalSuppr' data-toggle='modal' data-message='Etes-vous sûr de vouloir supprimer cette nationalité ?' data-Suppr='index.php?uc=nationalites&action=delete&num=".$nationalite->num."' class ='btn btn-warning'><i class ='far fa-trash-alt'></i></a>
            </td>";
            echo "</tr>";
        }
        ?>

        
    </tbody>
    </table>
</div>
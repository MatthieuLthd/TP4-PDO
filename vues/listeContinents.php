<div class="container mt-5">

    <div class="row pt-3">
            <div class="col-9"><h2>Listes des continents</h2></div>
            <div class="col-3"><a href="index.php?uc=coninent&action=add" class="btn btn-succes"><i class="fas fa-plus-circle"></i>Créer un continent</a></div>
        
    </div>

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
        foreach($lesContinents as $continent){
            echo "<tr class='d-flex'>";
            echo "<td class='col-md-2' >".$continent->getNum()."</td>";
            echo "<td class='col-md-8' >".$continent->getLibelle()."</td>";
            echo "<td class='col-md-2'>
                <a href='formNationalite.php?action=Modifier&num=".$continent->getNum()."' class='btn btn-info'><i class='fas fa-pen'></i></a>
                <a href='#modalSuppr' data-toggle='modal' data-message='Etes-vous sûr de vouloir supprimer cette nationalité ?' data-Suppr='supprNationalite.php?num=".$continent->getNum()."' class ='btn btn-warning'><i class ='far fa-trash-alt'></i></a>
            </td>";
            echo "</tr>";
        }
        ?>

        
    </tbody>
    </table>
</div>
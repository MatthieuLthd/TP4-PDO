<div class="container mt-5">

    <div class="row pt-3">
            <div class="col-9"><h2>Listes des genres</h2></div>
            <div class="col-3"><a href="index.php?uc=genres&action=add" class="btn btn-succes"><i class="fas fa-plus-circle"></i>Créer un genre</a></div>
        
    </div>

    <table class="table table-striped">
    <thead>
        <tr class="d-flex">
        <th scope="col" class="col-md-3">Numéro</th>
        <th scope="col" class="col-md-7">Libellé</th>
        <th scope="col" class="col-md-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($lesGenres as $genre){
            echo "<tr class='d-flex'>";
            echo "<td class='col-md-3' >".$genre->getNum()."</td>";
            echo "<td class='col-md-7' >".$genre->getLibelle()."</td>";
            echo "<td class='col-md-2'>
                <a href='index.php?uc=genres&action=update&num=".$genre->getNum()."' class='btn btn-info'><i class='fas fa-pen'></i></a>
                <a href='#modalSuppr' data-toggle='modal' data-message='Etes-vous sûr de vouloir supprimer ce genre ?' data-Suppr='index.php?uc=genres&action=delete&num=".$genre->getNum()."' class ='btn btn-warning'><i class ='far fa-trash-alt'></i></a>
            </td>";
            echo "</tr>";
        }
        ?>

        
    </tbody>
    </table>
</div>
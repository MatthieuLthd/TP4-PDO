<div class="container mt-5">
<h2 class="pt-3 text-center"><?php echo $mode?> un Auteur</h2>
    <form action="index.php?uc=auteurs&action=validerForm" method="post" class="col-md-6 offset-md-3 border border-primary p-3 rounded">
        <div class="form-group">
            <label for="nom" > Nom </label>
            <input type="text" class='form-control' id="nom" placehoder="Saisir le libellé" name="nom" value="<?php if($mode == "Modifier"){echo $laNationalite->getLibelle();} ?>">
        </div>
        <div>
            <label for="nom" > Prenom </label>
            <input type="text" class='form-control' id="Prenom" placehoder="Saisir le libellé" name="Prenom" value="<?php if($mode == "Modifier"){echo $laNationalite->getLibelle();} ?>">
        </div>
        <div class="form-group">
            <label for="Nationalite" > Nationalite </label>
            <select name="nationalite" class='form-control'>
                <?php
                foreach($lesNationalites as $nationalite){
                    $selection="";
                    if($mode=="Modifier"){
                        $selection=$nationalite->getNum() == $laNationalite->getNationalite()->getNum() ? 'selected' : '';
                    } 
                    
                    echo "<option value='".$nationalite->getNum()."'". $selection.">".$nationalite->getLibelle()."</option>";
                }
                ?>
                
            </select>
        </div>
        <input type="hidden" id="num" name="num" value="<?php if($mode == "Modifier"){echo $laNationalite->getNum();} ?>">
        <div class="row">
            <div class="col"> <a href="index.php?uc=auteurs&action=list" class="btn btn-warning btn-block">Revenir à la liste</a> </div>
            <div class="col"><button type="submit" class="btn btn-success btn-block"> <?php echo $mode?> </button> </div>
        </div>
    </form> 
</div>
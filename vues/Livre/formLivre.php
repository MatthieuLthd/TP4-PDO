<div class="container mt-5">
<h2 class="pt-3 text-center"><?php echo $mode?> un Livre</h2>
    <form action="index.php?uc=livres&action=validerForm" id="form" method="post" class="col-md-8 offset-md-2 border border-primary p-3 rounded">
        <div class="form-group">
            <label for="isbn" id="isbn" > ISBN </label>
            <input type="text" class='form-control' id="isbn" placehoder="Saisir le numéro ISBN" name="isbn" value="<?php if($mode == "Modifier"){echo $laLivre->getIsbn();} ?>">
        </div>
        <div>
            <label for="titre" > Titre </label>
            <input type="text" class='form-control' id="titre" placehoder="Saisir le titre" name="titre" value="<?php if($mode == "Modifier"){echo $laLivre->getTitre();} ?>">
        </div>
        <div class="form-group">
            <label for="prix" > Prix </label>
            <input type="number" class='form-control' id="prix" placehoder="Saisir le prix" name="prix" value="<?php if($mode == "Modifier"){echo $laLivre->getPrix();} ?>">
        </div>
        <div>
            <label for="editeur" > Editeur </label>
            <input type="text" class='form-control' id="editeur" placehoder="Saisir l'éditeur'" name="editeur" value="<?php if($mode == "Modifier"){echo $laLivre->getEditeur();} ?>">
        </div>
        <div class="form-group">
            <label for="annee" > Année </label>
            <input type="number" class='form-control' id="annee" placehoder="Saisir l'année" name="annee" value="<?php if($mode == "Modifier"){echo $laLivre->getAnnee();} ?>">
        </div>
        <div>
            <label for="langue" > Langue </label>
            <input type="text" class='form-control' id="langue" placehoder="Saisir la langue" name="langue" value="<?php if($mode == "Modifier"){echo $laLivre->getLangue();} ?>">
        </div>



        <div class="form-group">
            <label for="Auteur" > Auteur </label>
            <select name="auteur" id="auteur" class='form-control'>
                <?php
                var_dump($lesAuteurs);
                foreach($lesAuteurs as $auteur){
                    $selection="";
                    if($mode=="Modifier"){
                        $selection=$auteur->numero == $auteur->nomA ? 'selected' : '';
                    } 
                    
                    echo "<option value='".$auteur->numero."'". $selection.">".$auteur->nomA."</option>";
                }
                ?>
                
            </select>
        </div>
        <div class="form-group">
            <label for="Genre" > Genre </label>
            <select name="genre" id="genre" class='form-control'>
                <?php
                foreach($lesGenres as $genre){
                    $selection="";
                    if($mode=="Modifier"){
                        $selection=$genre->getNum() == $genre->getLibelle() ? 'selected' : '';
                    } 
                    
                    echo "<option value='".$genre->getNum()."'". $selection.">".$genre->getLibelle()."</option>";
                }
                ?>
                
            </select>
        </div>
        <input type="hidden" id="num" name="num" value="<?php if($mode == "Modifier"){echo $laLivre->getNum();} ?>">
        <div class="row">
            <div class="col"> <a href="index.php?uc=livres&action=list" class="btn btn-warning btn-block">Revenir à la liste</a> </div>
            <div class="col"><button type="submit" class="btn btn-success btn-block"> <?php echo $mode?> </button> </div>
        </div>
    </form> 
</div>
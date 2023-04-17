<?php
class Livre{

/**------------------------DEFINITION DES VARIABLES------------------------------- */

    /**
     *  numero du livre
     * @var int
     */

    private $num;

    /**
     *  isbn du livre
     * @var string
     */

    private $isbn;

    /**
     *  titre du livre
     * @var string
     */
    private $titre;

    /**
     *  prix du livre
     * @var int
     */
    private $prix;
    
    /**
     *  editeur du livre
     * @var string
     */
    private $editeur;
    
    /**
     *  annee du livre
     * @var int
     */
    private $annee;
    
    /**
     *  langue du livre
     * @var string
     */
    private $langue;
    
    /**
     *  numero de l'auteur du livre
     * @var int
     */
    private $numAuteur;
    
    /**
     *  numero du genre du livre
     * @var int
     */
    private $numGenre;


    

/**------------------------ACESSEURS------------------------------- */


    /**
     * Get the value of num
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set the value of num
     */
    public function setNum($num): self
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get the value of isbn
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set the value of isbn
     */
    public function setIsbn($isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get titre du livre
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * Set titre du livre
     */
    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get prix du livre
     */
    public function getPrix(): int
    {
        return $this->prix;
    }

    /**
     * Set prix du livre
     */
    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get editeur du livre
     */
    public function getEditeur(): string
    {
        return $this->editeur;
    }

    /**
     * Set editeur du livre
     */
    public function setEditeur(string $editeur): self
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * Get annee du livre
     */
    public function getAnnee(): int
    {
        return $this->annee;
    }

    /**
     * Set annee du livre
     */
    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get langue du livre
     */
    public function getLangue(): string
    {
        return $this->langue;
    }

    /**
     * Set langue du livre
     */
    public function setLangue(string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * Get numero de l'auteur du livre
     */
    public function getNumAuteur(): int
    {
        return $this->numAuteur;
    }

    /**
     * Set numero de l'auteur du livre
     */
    public function setNumAuteur(int $numAuteur): self
    {
        $this->numAuteur = $numAuteur;

        return $this;
    }

    /**
     * Get numero du genre du livre
     */
    public function getNumGenre(): int
    {
        return $this->numGenre;
    }

    /**
     * Set numero du genre du livre
     */
    public function setNumGenre(int $numGenre): self
    {
        $this->numGenre = $numGenre;

        return $this;
    }

    

/**------------------------CODE------------------------------- */


    /**
     * Retourne l'ensemble des Livres
     *
     * @return Livre[] tableau d'objets Livre
     */
    public static function findAll(?string $titre="",?string $numAuteur="Tous",?string $numGenre="Tous") : array
    {
        $texteReq="select l.num as numero, l.isbn as isbn, l.titre as 'titreL', l.prix as 'prixL', l.editeur as 'editeurL', l.annee as 'anneeL',
        l.langue as 'langueL', a.nom as 'numAuteurL', g.libelle as 'numGenreL' from livre l, auteur a, genre g 
        where l.numAuteur=a.num AND l.numGenre=g.num";
        if($titre != "") {
            $texteReq .= " and l.titre like '%".$titre."%'";
        }
        if($numAuteur != "Tous") {
            $texteReq .= " and a.num like '%".$numAuteur."%'";
        }
        if($numGenre != "Tous") { 
            $texteReq .= " and g.num='".$numGenre."'";
        }
        $texteReq .= " order by l.titre";
        $req=MonPdo::getInstance()->prepare($texteReq);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats;
    }

    /**
     * trouve une Livre par son num
     *
     * @param integer $id numéro de l'livre
     * @return Livre objet Livre trouvé
     */
    public static function findById(int $id) :Livre
    {
        $req=MonPdo::getInstance()->prepare("Select * from livre where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"Livre");
        $req->bindParam(':id', $id);
        $req->execute();
        $leResultats=$req->fetch();
        return $leResultats;
    }


    /**
     * Permet d'ajouter un livre
     *
     * @param Livre $livre livre à ajouter
     * @return integer resultat(1 si l'opération a réussi, 0 sinon)
     */
    public static function add(Livre $livre) : int
    {
        $req=MonPdo::getInstance()->prepare("INSERT INTO livre(isbn, titre, prix, editeur, annee, langue, numAuteur, numGenre) VALUES(:isbn, :titre, :prix, :editeur, :annee, :langue, :numAuteur, :numGenre)");
        $isbn = $livre->getIsbn();
        $titre = $livre->getTitre();
        $prix = $livre->getPrix();
        $editeur = $livre->getEditeur();
        $annee = $livre->getAnnee();
        $langue = $livre->getLangue();
        $numAuteur = $livre->getNumAuteur();
        $numGenre = $livre->getNumGenre();
        $req->bindParam(':isbn', $isbn);
        $req->bindParam(':titre', $titre);
        $req->bindParam(':prix', $prix);
        $req->bindParam(':editeur', $editeur);
        $req->bindParam(':annee', $annee);
        $req->bindParam(':langue', $langue);
        $req->bindParam(':numAuteur', $numAuteur);
        $req->bindParam(':numGenre', $numGenre);
        $nb=$req->execute();
        return $nb;
    }


    /**
     * Permet de modifier un livre 
     *
     * @param Livre $livre livre à modifier 
     * @return integer resultat(1 si l'opération a réussi, 0 sinon)
     */
    public static function update(Livre $livre) : int
    {
        $req=MonPdo::getInstance()->prepare("Update livre set isbn= :isbn , titre= :titre, prix= :prix, editeur= :editeur, annee= :annee, langue= :langue, numAuteur= :numAuteur, numGenre= :numGenre where num= :id");
        $isbn = $livre->getIsbn();
        $titre = $livre->getTitre();
        $prix = $livre->getPrix();
        $editeur = $livre->getEditeur();
        $annee = $livre->getAnnee();
        $langue = $livre->getLangue();
        $numAuteur = $livre->getNumAuteur();
        $numGenre = $livre->getNumGenre();
        $req->bindParam(':isbn', $isbn);
        $req->bindParam(':titre', $titre);
        $req->bindParam(':prix', $prix);
        $req->bindParam(':editeur', $editeur);
        $req->bindParam(':annee', $annee);
        $req->bindParam(':langue', $langue);
        $req->bindParam(':numAuteur', $numAuteur);
        $req->bindParam(':numGenre', $numGenre);
        $nb=$req->execute();
        return $nb;
    }


    /**
     * Permet de supprimer un livre 
     *
     * @param Livre $livre livre à supprimer 
     * @return integer resultat(1 si l'opération a réussi, 0 sinon)
     */
    public static function delete(Livre $livre) :int
    {
        $req=MonPdo::getInstance()->prepare("Delete from livre where num= :id");
        $req->bindParam(':id', $livre->getNum());
        $nb=$req->execute();
        return $nb;
    }

}


?>
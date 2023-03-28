<?php
class Nationalite{

/**------------------------DEFINITION DES VARIABLES------------------------------- */

    /**
     *  numero de la nationalité
     * @var int
     */

    private $num;


    /**
     * Libelle de la nationalité
     *
     * @var string
     */
    private $libelle;


    /**
     * num nationalite (clé étrangère) relié à num de Nationalite
     *
     * @var int
     */
    private $numNationalite;


/**------------------------ACESSEURS------------------------------- */


    /**
     * Get the value of num
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Lit le libelle
     * @return string
     */ 
    public function getLibelle() : string 
    {
        return $this->libelle;
    }
    /**
     * écrit dans le libelle 
     *
     * @param string $libelle
     * @return self
     */
    public function setLibelle(string $libelle) : self
    {
        $this->libelle = $libelle;

        return $this;
    }

    
    /**
     * renvoie l'objet nationalite associé
     *
     * @return Nationalite
     */
    public function getNumNationalite() : Nationalite
    {
        return Nationalite::findById($this->numNationalite);
    }

    /**
     * ecris 
     *
     * @param Nationalite $nationalite
     * @return self
     */
    public function setNumNationalite(Nationalite $nationalite) : self
    {
        $this->numNationalite = $nationalite->getNum();

        return $this;
    }


/**------------------------CODE------------------------------- */


    /**
     * Retourne l'ensemble des Nationalites
     *
     * @return Nationalite[] tableau d'objets Nationalite
     */
    public static function findAll() : array
    {
        $req=MonPdo::getInstance()->prepare("Select * from nationalite");
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats;
    }

    /**
     * trouve une Nationalite par son num
     *
     * @param integer $id numéro de la Nationalite
     * @return Nationalite objet Nationalite trouvé
     */
    public static function findById(int $id) :Nationalite
    {
        $req=MonPdo::getInstance()->prepare("Select * from nationalite where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"Nationalite");
        $req->bindParam(':id', $id);
        $req->execute();
        $leResultats=$req->fetch();
        return $leResultats;
    }


    /**
     * Permet d'ajouter une Nationalite
     *
     * @param Nationalite $nationalite nationalite à ajouter
     * @return integer resultat(1 si l'opération a réussi, 0 sinon)
     */
    public static function add(Nationalite $nationalite) : int
    {
        $req=MonPdo::getInstance()->prepare("insert into nationalite(libelle, numNationalite) values(:libelle, :numNationalite)");
        $req->bindParam(':libelle', $nationalite->getLibelle());
        $req->bindParam(':numNationalite', $nationalite->getNumNationalite()->getNum());
        $nb=$req->execute();
        return $nb;
    }


    /**
     * Permet de modifier un nationalite 
     *
     * @param Nationalite $nationalite nationalite à modifier 
     * @return integer resultat(1 si l'opération a réussi, 0 sinon)
     */
    public static function update(Nationalite $nationalite) : int
    {
        $req=MonPdo::getInstance()->prepare("Update nationalite set libelle= :libelle, numNationalite= :numNationalite where num= :id");
        $req->bindParam(':id', $nationalite->getNum());
        $req->bindParam(':libelle', $nationalite->getLibelle());
        $req->bindParam(':numNationalite', $nationalite->getNumNationalite()->getNum());
        $nb=$req->execute();
        return $nb;
    }


    /**
     * Permet de supprimer un nationalite 
     *
     * @param Nationalite $nationalite nationalite à supprimer 
     * @return integer resultat(1 si l'opération a réussi, 0 sinon)
     */
    public static function delete(Nationalite $nationalite) :int
    {
        $req=MonPdo::getInstance()->prepare("Delete from nationalite where num= :id");
        $req->bindParam(':id', $nationalite->getNum());
        $nb=$req->execute();
        return $nb;
    }


    
}


?>
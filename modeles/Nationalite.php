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
     * renvoie l'objet continent associé
     *
     * @return Continent
     */
    public function getContinent() : Continent
    {
        return Continent::findById($this->numContinent);
    }

    /**
     * ecris le num continent
     *
     * @param Continent $continent
     * @return self
     */
    public function setContinent(Continent $continent) : self
    {
        $this->numContinent = $continent->getNum();

        return $this;
    }


/**------------------------CODE------------------------------- */


    /**
     * Retourne l'ensemble des Nationalites
     *
     * @return Nationalite[] tableau d'objets Nationalite
     */
    public static function findAll(?string $libelle="", ?string $continent="Tous") : array
    {
        $texteReq="select n.num as numero, n.libelle as 'libNation', c.libelle as 'libContinent' from nationalite n, continent c where n.numContinent=c.num";
        if($libelle != "") {
            $texteReq .= " and n.libelle like '%".$libelle."%'";
        }
        if($continent != "Tous") { 
            $texteReq .= " and c.num =".$continent;
        }
        $texteReq .= " order by n.libelle";
        $req=MonPdo::getInstance()->prepare($texteReq);
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
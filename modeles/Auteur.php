<?php
class Auteur{

/**------------------------DEFINITION DES VARIABLES------------------------------- */

    /**
     *  numero de l'auteur
     * @var int
     */

    private $num;


    /**
     * Nom de l'auteur
     *
     * @var string
     */
    private $nom;

    /**
     * Prenom de l'auteur
     *
     * @var string
     */
    private $prenom;


    /**
     * Num de la nationalite
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
     * Set the value of num
     */
    public function setNum($num): self
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get nom de l'auteur
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Set nom de l'auteur
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get prenom de l'auteur
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * Set prenom de l'auteur
     */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * renvoie l'objet Nationalite associé
     *
     * @return Continent
     */
    public function getContinent() : Nationalite
    {
        return Nationalite::findById($this->numNationalite);
    }

    /**
     * ecris le num nationalite
     *
     * @param Nationalite $nationalite
     * @return self
     */
    public function setNationalite(Nationalite $nationalite) : self
    {
        $this->numNationalite = $nationalite->getNum();

        return $this;
    }

/**------------------------CODE------------------------------- */


    /**
     * Retourne l'ensemble des Auteurs
     *
     * @return Auteur[] tableau d'objets Auteur
     */
    public static function findAll(?string $nom="", ?string $nationalite="Tous") : array
    {
        $texteReq="select a.num as numero, a.nom as 'nomA', a.prenom as 'prenomA', a.numNationalite as 'numNat' from auteur a, nationalite n where a.numNationalite=n.num";
        if($nom != "") {
            $texteReq .= " and a.nom like '%".$nom."%'";
        }
        if($nationalite != "Tous") { 
            $texteReq .= " and n.num =".$nationalite;
        }
        $texteReq .= " order by a.nom";
        $req=MonPdo::getInstance()->prepare($texteReq);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats;
    }

    /**
     * trouve une Auteur par son num
     *
     * @param integer $id numéro de l'auteur
     * @return Auteur objet Auteur trouvé
     */
    public static function findById(int $id) :Auteur
    {
        $req=MonPdo::getInstance()->prepare("Select * from auteur where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"Auteur");
        $req->bindParam(':id', $id);
        $req->execute();
        $leResultats=$req->fetch();
        return $leResultats;
    }


    /**
     * Permet d'ajouter un auteur
     *
     * @param Auteur $auteur auteur à ajouter
     * @return integer resultat(1 si l'opération a réussi, 0 sinon)
     */
    public static function add(Auteur $auteur) : int
    {
        $req=MonPdo::getInstance()->prepare("INSERT INTO auteur(nom, prenom, numNationalite) VALUES(:nom, :prenom, :nationalite)");
        $nom = $auteur->getNom();
        $prenom = $auteur->getPrenom();
        $nationalite = $auteur->numNationalite;
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':nationalite', $nationalite);
        $nb=$req->execute();
        return $nb;
    }


    /**
     * Permet de modifier un auteur 
     *
     * @param Auteur $auteur auteur à modifier 
     * @return integer resultat(1 si l'opération a réussi, 0 sinon)
     */
    public static function update(Auteur $auteur) : int
    {
        $req=MonPdo::getInstance()->prepare("Update auteur set nom= :nom , prenom= :prenom, numNationalite= :numNationalite where num= :id");
        $nat = $auteur->getNum();
        $nom = $auteur->getNom();
        $prenom = $auteur->getPrenom();
        $num = $auteur->getNationalite()->getNum();
        $req->bindParam(':id', $nat);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':numNationalite', $num);
        $nb=$req->execute();
        return $nb;
    }


    /**
     * Permet de supprimer un nationalite 
     *
     * @param Auteur $nationalite nationalite à supprimer 
     * @return integer resultat(1 si l'opération a réussi, 0 sinon)
     */
    public static function delete(Auteur $nationalite) :int
    {
        $req=MonPdo::getInstance()->prepare("Delete from nationalite where num= :id");
        $req->bindParam(':id', $nationalite->getNum());
        $nb=$req->execute();
        return $nb;
    }


    


    

    
}


?>
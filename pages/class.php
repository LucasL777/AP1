<?php

// Classe Compte_rendu qui récupere les CR depuis la bdd pour créer des objets POO (facilite la manipulation des comptes rendus)
class Compte_rendu{
	private $id;
	private $titre;
	private $date;
	private $id_etudiant;
    private $nom_etudiant;
    private $prenom;
	
	public function __construct($unid, $untitre, $undate, $unid_etudiant, $unnom_etudiant, $unprenom){
        $this->id = $unid;
        $this->titre = $untitre;
        $this->date = $undate;
        $this->id_etudiant = $unid_etudiant;
        $this->nom_etudiant = $unnom_etudiant;
        $this->prenom = $unprenom;
    }
	
	public function getId(){
		return $this->id;
	}

	public function getTitre(){
		return $this->titre;
	}

	public function getDate(){
		return $this->date;
	}

	public function getId_etudiant(){
		return $this->id_etudiant;
	}

    public function getNom_etudiant(){
        return $this->nom_etudiant;
    }

    public function getPrenom(){
        return $this->prenom;
    }
}

// Classe Eleve qui récupere les eleve depuis la bdd pour créer des objets POO (facilite la manipulation des eleves)
class Eleve{
    private $id;
    private $nom;
    private $prenom;
    private $classe;
    
    public function __construct($unid, $unnom, $unprenom, $unclasse){
        $this->id = $unid;
        $this->nom = $unnom;
        $this->prenom = $unprenom;
        $this->classe = $unclasse;
    }
    
    public function getId(){
        return $this->id;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function getClasse(){
        return $this->classe;
    }
}
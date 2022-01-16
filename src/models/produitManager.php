<?php
class ProduitManager extends Produit{
	
    /**
	 * Récupère les produits présentes dans une catégorie
	 */
	public function findByCategorie(int $id){
		// Connexion auto à la BDD :
		$bdd = new BDD();
		// Récupération de la connexion :
		$connexion = $bdd->getCo();

		$sql = "SELECT * FROM produit WHERE categorie = :id";
		// Prépare la requete SQL :
		$req = $connexion->prepare($sql);
		// Execute la requete SQL :
		$req->execute([
			'id' => $id
		]);

		return $req;
	}

	/**
	 * Récupère toute la table 'produit'
	 */
	public function findAll(){
		// Connexion auto à la BDD :
		$bdd = new BDD();
		// Récupération de la connexion :
		$connexion = $bdd->getCo();

		$sql = "SELECT * FROM produit";
		// Prépare la requete SQL :
		$req = $connexion->prepare($sql);
		// Execute la requete SQL :
		$req->execute();

		return $req;
	}

	/**
	 * Sauvegarde une produit
	 */
	public function save(){
		// Connexion auto à la BDD :
		$bdd = new BDD();
		// Récupération de la connexion :
		$connexion = $bdd->getCo();

		$sql = "INSERT INTO produit(nom, description, categorie, quantite, prix) VALUES (:n, :d, :c, :q, :p);";
		// Prépare la requete SQL :
		$req = $connexion->prepare($sql);
		// Execute la requete SQL :
		$req->execute([
			'n' => $this->getNom(),
            'd' => $this->getDescription(),
            'c' => $this->getCategorie(),
            'q' => $this->getQuantite(),
            'p' => $this->getPrix()
		]);

		return $req;
	}

	/**
	 * Retrouve une produit grace à son id
	 */
	public function findOneById($id){
		// Connexion auto à la BDD :
		$bdd = new BDD();
		// Récupération de la connexion :
		$connexion = $bdd->getCo();

		$sql = "SELECT * FROM produit WHERE id = :id";
		// Prépare la requete SQL :
		$req = $connexion->prepare($sql);
		// Execute la requete SQL :
		$req->execute(['id' => $id]);

		return $req;
	}

	/**
	 * Met à jour une produit
	 */
	public function update(){
		// Connexion auto à la BDD :
		$bdd = new BDD();
		// Récupération de la connexion :
		$connexion = $bdd->getCo();

		$sql = "UPDATE produit SET nom = :n, description = :d, categorie = :c, quantite = :q, prix = :p WHERE id = :id;";
		// Prépare la requete SQL :
		$req = $connexion->prepare($sql);
		// Execute la requete SQL :
		$req->execute([
			'n' => $this->getNom(),
            'd' => $this->getDescription(),
            'c' => $this->getCategorie(),
            'q' => $this->getQuantite(),
            'p' => $this->getPrix(),
            'id' => $this->getId()
		]);

		return $req;
	}

	/**
	 * Supprime une produit
	 */
	public function delete(){
		// Connexion auto à la BDD :
		$bdd = new BDD();
		// Récupération de la connexion :
		$connexion = $bdd->getCo();

		$sql = "DELETE FROM produit WHERE id = :id;";
		// Prépare la requete SQL :
		$req = $connexion->prepare($sql);
		// Execute la requete SQL :
		$req->execute([
			'id'=> $this->getId()
		]);

		return $req;
	}

}
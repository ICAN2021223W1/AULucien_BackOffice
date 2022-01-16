<?php
class CategorieManager extends Categorie{
	
	/**
	 * Récupère toute la table 'categorie'
	 */
	public function findAll(){
		// Connexion auto à la BDD :
		$bdd = new BDD();
		// Récupération de la connexion :
		$connexion = $bdd->getCo();

		$sql = "SELECT * FROM categorie";
		// Prépare la requete SQL :
		$req = $connexion->prepare($sql);
		// Execute la requete SQL :
		$req->execute();

		return $req;
	}

	/**
	 * Sauvegarde une categorie
	 */
	public function save(){
		// Connexion auto à la BDD :
		$bdd = new BDD();
		// Récupération de la connexion :
		$connexion = $bdd->getCo();

		$sql = "INSERT INTO categorie(nom) VALUES (:n);";
		// Prépare la requete SQL :
		$req = $connexion->prepare($sql);
		// Execute la requete SQL :
		$req->execute([
			'n' => $this->getNom(),
		]);

		return $req;
	}

	/**
	 * Retrouve une categorie grace à son id
	 */
	public function findOneById($id){
		// Connexion auto à la BDD :
		$bdd = new BDD();
		// Récupération de la connexion :
		$connexion = $bdd->getCo();

		$sql = "SELECT * FROM categorie WHERE id = :id";
		// Prépare la requete SQL :
		$req = $connexion->prepare($sql);
		// Execute la requete SQL :
		$req->execute(['id' => $id]);

		return $req;
	}

	/**
	 * Met à jour une categorie
	 */
	public function update(){
		// Connexion auto à la BDD :
		$bdd = new BDD();
		// Récupération de la connexion :
		$connexion = $bdd->getCo();

		$sql = "UPDATE categorie SET nom = :n WHERE id = :id;";
		// Prépare la requete SQL :
		$req = $connexion->prepare($sql);
		// Execute la requete SQL :
		$req->execute([
			'n' => $this->getNom(),
            'id'=> $this->getId()

		]);

		return $req;
	}

	/**
	 * Supprime une categorie
	 */
	public function delete(){
		// Connexion auto à la BDD :
		$bdd = new BDD();
		// Récupération de la connexion :
		$connexion = $bdd->getCo();

		$sql = "DELETE FROM categorie WHERE id = :id;";
		// Prépare la requete SQL :
		$req = $connexion->prepare($sql);
		// Execute la requete SQL :
		$req->execute([
			'id'=> $this->getId()
		]);

		return $req;
	}

}
<?php
class UserManager extends User{

	/**
	 * Récupère toute la table 'user'
	 */
	public function findAll(){
		// Connexion auto à la BDD :
		$bdd = new BDD();
		// Récupération de la connexion :
		$connexion = $bdd->getCo();

		$sql = "SELECT * FROM user";
		// Prépare la requete SQL :
		$req = $connexion->prepare($sql);
		// Execute la requete SQL :
		$req->execute();

		return $req;
	}

	/**
	 * Récupère toute la table 'role'
	 */
	public function findAllRole(){
		// Connexion auto à la BDD :
		$bdd = new BDD();
		// Récupération de la connexion :
		$connexion = $bdd->getCo();

		$sql = "SELECT * FROM role";
		// Prépare la requete SQL :
		$req = $connexion->prepare($sql);
		// Execute la requete SQL :
		$req->execute();

		return $req;
	}

	/**
	 * Trouver l'utilisateur du formulaire
	 */
	public function findUser($user_mail){
		// Connexion auto à la BDD :
		$bdd = new BDD();
		// Récupération de la connexion :
		$connexion = $bdd->getCo();

		$sql = "SELECT * FROM user WHERE user_mail= :mail";
		// Prépare la requete SQL :
		$req = $connexion->prepare($sql);
		// Execute la requete SQL :
		$req->execute([
            'mail'=> $user_mail
        ]);

		return $req;
	}

	/**
	 * Trouver l'utilisateur du formulaire par id
	 */
	public function findUserById($id){
		// Connexion auto à la BDD :
		$bdd = new BDD();
		// Récupération de la connexion :
		$connexion = $bdd->getCo();

		$sql = "SELECT * FROM user WHERE id= :id";
		// Prépare la requete SQL :
		$req = $connexion->prepare($sql);
		// Execute la requete SQL :
		$req->execute([
            'id'=> $id
        ]);

		return $req;
	}

	/**
	 * Trouver l'utilisateur du formulaire par email
	 */
	public function findUserByMail($mail){
		// Connexion auto à la BDD :
		$bdd = new BDD();
		// Récupération de la connexion :
		$connexion = $bdd->getCo();

		$sql = "SELECT * FROM user WHERE user_mail= :mail";
		// Prépare la requete SQL :
		$req = $connexion->prepare($sql);
		// Execute la requete SQL :
		$req->execute([
            'mail'=> $mail
        ]);

		return $req;
	}

	/**
	 * Sauvgarder un nouveau user
	 */
    public function save(){
		// Connexion auto à la BDD :
		$bdd = new BDD();
		// Récupération de la connexion :
		$connexion = $bdd->getCo();

		$sql = "INSERT INTO user(user_mail, user_password) VALUES (:um, :p);";
        $hashPassword = password_hash($this->getPassword(), PASSWORD_BCRYPT);
		// Prépare la requete SQL :
		$req = $connexion->prepare($sql);
		// Execute la requete SQL :
		$req->execute([
			'um' => $this->getMail(),
            'p' => $hashPassword
		]);
        
		return $req;
	}

	/**
	 * Met à jour un user
	 */
	public function update(){
		// Connexion auto à la BDD :
		$bdd = new BDD();
		// Récupération de la connexion :
		$connexion = $bdd->getCo();

		$sql = "UPDATE user  SET user_admin = :u WHERE id = :id;";
		// Prépare la requete SQL :
		$req = $connexion->prepare($sql);
		// Execute la requete SQL :
		$req->execute([
			'id' => $this->getId(),
			'u' => $this->getUser_admin()
		]);

		return $req;
	}

}
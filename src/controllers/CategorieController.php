<?php

class CategorieController extends DefaultController{
	public function list(){
	
		$sc = new SessionController;
		// Initaliser la sessions de l'utilisateur
		$sc->init_php_session();
		// Verifier s'il connecter
		if($sc->is_logged()){
			
			$cm = new CategorieManager();
			// Récupération de la table 'categorie'
			$categories = $cm->findAll();
	
			// Je génère un tableau d'objets PHP pour pouvoir faire le foreach
			$liste_categories = $categories->fetchAll(PDO::FETCH_CLASS, 'categorie');
			
			// Récupération de la vue
			$variables = compact('categories', 'liste_categories','sc');
			parent::render('categorie_list.php', $variables);
		}
		else{
			// Redirige sur la page de connection
			echo '<script language="JavaScript" type="text/javascript">
    
            window.location.replace("?p=connection");
    
            </script>';
		}
	}

	public function save(){

		$sc = new SessionController;
		// Initaliser la sessions de l'utilisateur
		$sc->init_php_session();
		// Verifier s'il est admin
		if($sc->is_admin()){

			if(isset($_POST['nom']) && !empty($_POST['nom'])){
			
				// Je crée le objet 'cm' de type 'CategorieManager'
				$cm = new CategorieManager();
				// Je lui assigne les données reçues par le formulaire
				$cm->setNom($_POST['nom']);
				
				// Je sauvegarde le élément et je regarde le nombre de lignes affectées par le opération
				if($cm->save()->rowCount() == 1){
					echo "<p class='text-success'>Categorie enregistrée.</p>";
				}
				else{
					echo "<p class='text-danger'>Une erreur est survenue lors du enregistrement.</p>";
				}
			}
			else{
				echo "<p class='text-danger'>Veuillez renseigner tous les champs du formulaire.</p>";
			}
		}
		else{
			// Redirige sur la page de connection
			echo '<script language="JavaScript" type="text/javascript">
    
            window.location.replace("?p=connection");
    
            </script>';
		}
	}

	public function show(){

		$sc = new SessionController;
		// Initaliser la sessions de l'utilisateur
		$sc->init_php_session();
		// Verifier s'il connecter
		if($sc->is_logged()){
			// Je vérifie que j'ai reçu un id en paramètre et qu'il n'est pas vide
			if(isset($_GET['categorie']) && !empty($_GET['categorie'])){

				// Je vérifie que le categorie existe en base
				$cm = new CategorieManager();
				$categorie = $cm->findOneById($_GET['categorie']);

				if($categorie->rowCount() == 1){
					// Je la transforme en objet PHP
					$categorie = $categorie->fetchObject('categorie');

					// Je crée le objet 'cm' de type 'produitManager'
					$cm = new produitManager();
					// Je récupère les produits présentes dans le categorie
					$produits = $cm->findByCategorie($categorie->getId());

					// Je génère un tableau d'objets PHP pour pouvoir faire le foreach
					$liste_produits = $produits->fetchAll(PDO::FETCH_CLASS, 'Produit');

					$variables = compact('categorie', 'produits', 'cm', 'liste_produits','sc');
					// Appel de la vue
					parent::render('categorie_show.php', $variables);
				}
				else{
					echo "<p class='text-danger'>Categorie introuvable.</p>";
				}
			}
			else{
				echo "<p class='text-danger'>Categorie introuvable.</p>";
			}
		}
		else{
			// Redirige sur la page de connection
			echo '<script language="JavaScript" type="text/javascript">
    
            window.location.replace("?p=connection");
    
            </script>';
		}
		
	}

	public function update(){

		$sc = new SessionController;
		// Initaliser la sessions de l'utilisateur
		$sc->init_php_session();
		// Verifier s'il est admin
		if($sc->is_admin()){

			// Je vérifie que j'ai reçu tous les champs et qu'ils ne sont pas vides
			if(isset($_POST['nom']) && !empty($_POST['nom']) && isset($_GET['categorie']) && !empty($_GET['categorie'])){
				
				// Je crée le objet 'cm' de type 'categorieManager'
				$cm = new CategorieManager();

				// Je vérifie que le id reçu par le formulaire corresponde bien à le categorie dans la base
				$categorie = $cm->findOneById($_GET['categorie']);

				// Si j'ai un résultat, c'est que le categorie existe en base
				if($categorie->rowCount() == 1){

					// Je lui assigne les données reçues par le formulaire
					$cm->setId($_GET['categorie'])
						->setNom($_POST['nom']);

					// Je met à jour le élément et je regarde le nombre de lignes affectées par le opération
					if($cm->update()->rowCount() >= 1){
						echo "<p class='text-success'>Catégorie mise à jour.</p>";
					}
					else{
						echo "<p class='text-danger'>Les données sont identiques.</p>";
					}
				}
				else{
					echo "<p class='text-danger'>Catégorie introuvable.</p>";
				}
			}
			else{
				echo "<p class='text-danger'>Veuillez renseigner tous les champs du formulaire.</p>";
			}
		}
		else{
			// Redirige sur la page de connection
			echo '<script language="JavaScript" type="text/javascript">
    
            window.location.replace("?p=connection");
    
            </script>';
		}
		
	}

	public function delete(){

		$sc = new SessionController;
		// Initaliser la sessions de l'utilisateur
		$sc->init_php_session();
		// Verifier s'il est admin
		if($sc->is_admin()){
				// Je vérifie que j'ai reçu l'id et qu'il n'est pas vide
			if(isset($_GET['categorie']) && !empty($_GET['categorie'])){

				// Je crée le objet 'cm' de type 'categorieManager'
				$cm = new CategorieManager();

				// Je vérifie que l'id reçu corresponde bien à une categorie dans la base
				$categorie = $cm->findOneById($_GET['categorie']);

				// Si j'ai un résultat, c'est que le categorie existe en base
				if($categorie->rowCount() == 1){

					// Je lui assigne les données reçues par le formulaire
					$cm->setId($_GET['categorie']);

					// Je supprime le élément et je regarde le nombre de lignes affectées par le opération
					if($cm->delete()->rowCount() >= 1){
						echo "<p class='text-warning'>Catégorie supprimée.</p>";
					}
					else{
						echo "<p class='text-danger'>Une erreur est survenue lors de la suppression.</p>";
					}
				}
				else{
					echo "<p class='text-danger'>Catégorie introuvable.</p>";
				}
			}
			else{
				echo "<p class='text-danger'>Catégorie introuvable.</p>";
			}
		}
		else{
			// Redirige sur la page de connection
			echo '<script language="JavaScript" type="text/javascript">
    
            window.location.replace("?p=connection");
    
            </script>';
		}

	}
}

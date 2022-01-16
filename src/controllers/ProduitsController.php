<?php

class ProduitsController extends DefaultController{
	public function show(){
		$sc = new SessionController;
		// Initaliser la sessions de l'utilisateur
		$sc->init_php_session();
		// Verifier s'il connecter
		if($sc->is_logged()){

			// Je vérifie que j'ai reçu un id en paramètre et qu'il n'est pas vide
			if(isset($_GET['produit']) && !empty($_GET['produit'])){

				// Je vérifie que la produit existe en base
				$pm = new ProduitManager();
				$produits = $pm->findOneById($_GET['produit']);

				if($produits->rowCount() == 1){
					// Je la transforme en objet PHP
					$produit = $produits->fetchObject('produit');

					// Récuperer la catégorie du produit pour l'afficher
					$cm = new CategorieManager();
					$CetteCategorie = $cm->findOneById($produit->getCategorie());
					$CetteCategorieProduit = $CetteCategorie->fetchObject('categorie');

					// Récupère toute la table 'categorie'
					$categories = $cm->findAll();

					// Je génère un tableau d'objets PHP pour pouvoir faire le foreach des options
					$liste_categories = $categories->fetchAll(PDO::FETCH_CLASS, 'Categorie');

					// Récupération de la vue
					$variables = compact('produits','produit','categories','liste_categories','CetteCategorie','CetteCategorieProduit','sc');
					parent::render('produit_show.php', $variables);
				}
				else{
					echo "<p class='text-danger'>Produit introuvable.</p>";
				}
			}
			else{
				echo "<p class='text-danger'>Produit introuvable.</p>";
			}
		}
		else{
			// Redirige vers la page de connection
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
			if(isset($_GET['produit']) && !empty($_GET['produit'])){
				
				// Je crée l'objet 'pm' de type 'produitManager'
				$pm = new ProduitManager();

				// Je vérifie que l'id reçu corresponde bien à une produit dans la base
				$produit = $pm->findOneById($_GET['produit']);

				// Si j'ai un résultat, c'est que la produit existe en base
				if($produit->rowCount() == 1){

					// Je lui assigne les données reçues par le formulaire
					$pm->setId($_GET['produit']);

					// Je supprime l'élément et je regarde le nombre de lignes affectées par l'opération
					if($pm->delete()->rowCount() >= 1){
						echo "<p class='text-warning'>Produit supprimée.</p>";
					}
					else{
						echo "<p class='text-danger'>Une erreur est survenue lors de la suppression.</p>";
					}
				}
				else{
					echo "<p class='text-danger'>Produit introuvable.</p>";
				}
			}
			else{
				echo "<p class='text-danger'>Produit introuvable.</p>";
			}	
		}
		else{
			// Redirige vers la page de connection
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

			// Je vérifie que j'ai reçu tous les champs et qu'ils ne sont pas vides
			if(isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['description']) && !empty($_POST['description']) && isset($_POST['categorie']) && !empty($_POST['categorie'])&& isset($_POST['quantite']) && !empty($_POST['quantite'])&& isset($_POST['prix']) && !empty($_POST['prix'])){
				
				// Je vérifie que le Categorie reçu du formulaire corresponde bien à une catégorie dans la base
				$cm = new CategorieManager();
				$categorie = $cm->findOneById($_POST['categorie']);

				// Si j'ai une correspondance dans la base
				if($categorie->rowCount() == 1){
					// Je crée mon objet
					$pm = new ProduitManager();

					// Je lui assigne les valeurs reçues par le formulaire
					$pm->setNom($_POST['nom'])
						->setDescription($_POST['description'])
						->setCategorie($_POST['categorie'])
						->setQuantite($_POST['quantite'])
						->setPrix($_POST['prix']);

					// Je le sauvegarde en base
					if($pm->save()->rowCount() == 1){
						echo "<p class='text-success'>Produit sauvegardée.</p>";
					}
					else{
						echo "<p class='text-danger'>Une erreur est survenue lors de la sauvegarde.</p>";
					}
				}
				else{
					echo "<p class='text-danger'>Categorie introuvable.</p>";
				}
			}
			else{
				echo "<p class='text-danger'>Veuillez renseigner tous les champs du formulaire.</p>";
			}
		}
		else{
			// Redirige vers la page de connection
			echo '<script language="JavaScript" type="text/javascript">
	
			window.location.replace("?p=connection");
	
			</script>';
		}
	}

	public function update(){

		$sc = new SessionController;
		// Initaliser la sessions de l'utilisateur'
		$sc->init_php_session();
		// Verifier s'il est admin
		if($sc->is_admin()){
			// Je vérifie que j'ai reçu tous les champs et qu'ils ne sont pas vides
			if(isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['description']) && !empty($_POST['description']) && isset($_POST['categorie']) && !empty($_POST['categorie'])&& isset($_POST['quantite']) && !empty($_POST['quantite'])&& isset($_POST['prix']) && !empty($_POST['prix'])&& isset($_POST['id']) && !empty($_POST['id'])){
				
				// Je crée l'objet 'pm' de type 'produitManager'
				$pm = new ProduitManager();

				// Je vérifie que l'id reçu par le formulaire corresponde bien à une produit dans la base
				$produit = $pm->findOneById($_POST['id']);
				
				// Si j'ai un résultat, c'est que la produit existe en base
				if($produit->rowCount() == 1){
					$cm = new CategorieManager();
					$ThisCategorie =  $cm->findOneById($_POST['categorie']);

					if($ThisCategorie->rowCount() == 1){
						// Je lui assigne les données reçues par le formulaire
						$pm->setNom($_POST['nom'])
						->setDescription($_POST['description'])
						->setCategorie($_POST['categorie'])
						->setQuantite($_POST['quantite'])
						->setPrix($_POST['prix'])
						->setId($_POST['id']);
		
						// Je met à jour l'élément et je regarde le nombre de lignes affectées par l'opération
						if($pm->update()->rowCount() >= 1){
							echo "<p class='text-success'>Produit mise à jour.</p>";
						}
						else{
							echo "<p class='text-danger'>Les données sont identiques.</p>";
						}
					}
					else{
						echo "<p class='text-danger'>La catégories modifier du produit n'exsite pas</p>";
					}	
				}
				else{
					echo "<p class='text-danger'>Produit introuvable.</p>";
				}
			}
			else{
				echo "<p class='text-danger'>Veuillez renseigner tous les champs du formulaire.</p>";
			}

		}
		else{
			// Redirige vers la page de connection
			echo '<script language="JavaScript" type="text/javascript">
	
			window.location.replace("?p=connection");
	
			</script>';
		}

		
	}
}
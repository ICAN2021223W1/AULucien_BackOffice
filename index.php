<?php

include_once 'inc.header.php';

require_once 'src/class/Autoload.php';
Autoload::load();

if(isset($_GET['p'])){

	switch ($_GET['p']) {
		// ?p=categories
		case 'categories':
			$ec = new CategorieController();
			$ec->list();
			break;

		// ?p=categorie_insert
		case 'categorie_insert':
			$ec = new CategorieController();
			$ec->save();
			break;

		// ?p=categorie_show&categorie=X
		case 'categorie_show':
			$ec = new CategorieController();
			$ec->show();
			break;

		// ?p=categorie_update
		case 'categorie_update':
			$ec = new CategorieController();
			$ec->update();
			break;

		// ?p=categorie_delete
		case 'categorie_delete':
			$ec = new CategorieController();
			$ec->delete();
			break;
		
		// ?p=produit_show
		case 'produit_show':
			$cc = new ProduitsController();
			$cc->show();
			break;
		
		// ?p=produit_delete
		case 'produit_delete':
			$cc = new ProduitsController();
			$cc->delete();
			break;
		
		// ?p=produit_insert
		case 'produit_insert':
			$cc = new ProduitsController();
			$cc->save();
			break;
		
		// ?p=produit_update
		case 'produit_update':
			$cc = new ProduitsController();
			$cc->update();
			break;
		
		// ?p=connection
		case 'connection':
			$uc = new UserController();
			$uc->connection();
			break;
		
		// ?p=traitement
		case 'traitement':
			$uc = new UserController();
			$uc->traitement();
			break;
		
		// ?p=deconnexion
		case 'deconnexion':
			$uc = new UserController();
			$uc->deconnexion();
			break;
		
		// ?p=inscription
		case 'inscription':
			$uc = new UserController();
			$uc->inscription();
			break;
		
		// ?p=traitement_inscription
		case 'traitement_inscription':
			$uc = new UserController();
			$uc->traitement_inscription();
			break;
		
		// ?p=parametre
		case 'parametre':
			$uc = new UserController();
			$uc->parametre();
			break;
			break;
		
		// ?p=user_update
		case 'user_update':
			$uc = new UserController();
			$uc->update();
			break;

		default:
			echo "<p class='alert alert-danger'>Erreur 404</p>";
			break;
	}
}
else{
	echo "<p class='alert alert-danger'>Erreur 404</p>";
}

include_once 'inc.footer.php';
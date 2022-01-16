<h1><?= $categorie->getNom(); ?></h1>

<h2>Liste des produits de cette categorie</h2>
<?php
	// Si j'ai reçu des résultats
	if($produits->rowCount() >= 1){
?>
		<table class="table">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					// Je parcours ce tableau PHP
					foreach ($liste_produits as $produit) {
				?>
					<tr>
						<td><?= $produit->getNom(); ?></td>
						<td>
							<a href="index.php?p=produit_show&produit=<?= $produit->getId(); ?>" class="btn btn-primary">Afficher</a>
							<?php
								// Je verifie s'il est admin
								if($sc->is_admin()){
									echo '<a href="index.php?p=produit_delete&produit='.$produit->getId().'" class="btn btn-danger">Supprimer</a>';
								}
							?>
						</td>
					</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	<?php

	}
	else{
		echo "<p>Il n'y a aucune produit dans cette categorie</p><hr>";
	}

	// Je verifie s'il est admin
	if($sc->is_admin()){
	?>
		<h2>Modifier le categorie</h2>
		<form class="w-25" action="index.php?p=categorie_update&categorie=<?= $_GET["categorie"]; ?>" method="POST">
			<label for="nom">Nom :</label>
			<input class="form-control" type="text" name="nom" id="nom" value="<?= $categorie->getNom(); ?>">
			<br>
			<input type="submit" name="update_produit" value="Modifier" class="btn btn-primary">
		
		</form>
		
		<hr>
			
		<h2>Ajouter un produit dans le categorie</h2>
		<form class="w-25 mb-5" action="index.php?p=produit_insert" method="POST">
			<input class="form-control" type="hidden" name="categorie" id="categorie" value="<?= $categorie->getId(); ?>">
			<label for="nom">Nom du produit :</label>
			<input  class="form-control" type="text" name="nom" id="nom">		
			<label for="description">Description :</label>			
			<input class="form-control" type="text" name="description" id="description">			
			<label for="quantite">Quantite:</label>		
			<input class="form-control" type="number" name="quantite" id="quantite">			
			<label for="prix">Prix :</label>			
			<input  class="form-control" type="text" name="prix" id="prix">
			<br>
			<input type="submit" name="insert_produit" value="Ajouter" class="btn btn-primary">
		</form>
	<?php
	}
	?>


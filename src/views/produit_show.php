
<h1><?= $produit->getNom(); ?></h1>

<h2> produits </h2>

<?php
	// Si j'ai reçu des résultats
	if($produits->rowCount() >= 1){
?>
		<table class="table">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Description</th>
					<th>Categorie</th>
					<th>Quantite</th>
                    <th>Prix</th>
				</tr>
			</thead>
			<tbody>
			
	    		<tr>
	    			<td><?= $produit->getNom();?></td>
	    			<td><?= $produit->getDescription();?></td>
	    			<td><?= $CetteCategorieProduit->getNom();?></td>
	    			<td><?= $produit->getQuantite();?></td>
                    <td><?= $produit->getPrix();?>€</td>
	    		</tr>
					
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
		<hr>
		<h2>Modifier la produit</h2>
		<form class="w-25" action="index.php?p=produit_update" method="POST">
			<input type="hidden" name="id" id="id" value="<?= $produit->getId(); ?>">
			<label for="nom">Nom du produit :</label>
			<input class="form-control" type="text" name="nom" id="nom">
			<label for="description">Description :</label>
			<input class="form-control" type="text" name="description" id="description">
			<label for="categorie">Catégorie :</label>
			<br>
			<select class="form-select" name="categorie">

		<?php
			foreach ($liste_categories as $categorie) {
				if($categorie->getId() == $produit->getCategorie()){
					echo "<option value='".$categorie->getId()."' selected>".$categorie->getNom()."</option>";
				}
				else{
					echo "<option value='".$categorie->getId()."'>".$categorie->getNom()."</option>";
				}
			}
		?>
			</select>

			<label for="quantite">Quantite:</label>
			<input class="form-control" type="number" name="quantite" id="quantite">
			<label for="prix">Prix :</label>
			<input class="form-control" type="text" name="prix" id="prix">
			<br>	
			<input type="submit" name="update_produit" value="Mettre à jour" class="btn btn-primary">
		</form>
<?php
	}
?>




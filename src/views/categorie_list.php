<h1>Catégories</h1>
<?php
	// S'il y a des résultats, on affiche le tableau
	if($categories->rowCount() > 0){
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
					foreach ($liste_categories as $categorie) {
				?>
						<tr>
							<td><?= $categorie->getNom(); ?></td>
							<td>
								<a href="index.php?p=categorie_show&categorie=<?= $categorie->getId(); ?>" class="btn btn-primary">Afficher</a>
								<?php
									// Je verifie s'il est admin
									if($sc->is_admin()){
										echo '<a href="index.php?p=categorie_delete&categorie='.$categorie->getId().'" class="btn btn-danger">Supprimer</a>';
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
		echo "<p>Il n'y a aucune categorie</p><hr>";
	}

	// Je verifie s'il est admin
	if($sc->is_admin()){
		echo 
		'<h2>Ajouter une categorie</h2>
		<form class="w-25"  action="index.php?p=categorie_insert" method="POST">
			<label for="nom">Nom :</label>
			<br>
			<input class="form-control" type="text" name="nom" id="nom">
			<br> 
			<input type="submit" name="ajout_categorie" value="Ajouter" class="btn btn-primary">
		</form>';
	}
?>


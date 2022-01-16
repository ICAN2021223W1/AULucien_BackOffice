<div class="container-md w-50 d-flex flex-column mt-5">
	<h1 class="text-center mb-4">Back office Lulu store</h1>
	<h2>S'inscrire</h2>
	<br>
	<form  class="form-floating mb-3" action="index.php?p=traitement_inscription" method="POST">

		<div class="form-floating mb-3">
			<input type="email" class="form-control" name="mail" id="mail" placeholder="name@example.com">
			<label for="mail">Adresse mail</label>
		</div>
		<div class="form-floating">
			<input type="password" class="form-control"  name="password" placeholder="Mot de passe" id="password">
			<label for="password">Mot de passe</label>
		</div>
		<br>
		<input type="submit" name="autentification" value="Se connecter" class="btn btn-primary">

	</form>
	<p>Vous est déjà inscris? <a href="index.php?p=connection">Cliquer ici</a></p>
</div>
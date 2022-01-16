<?php
	$url = "/option_dev/Lucien_AU_3WEB_MicroBackOffice";
	$path = "xamp/htdocs".$url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<title>Back-office Ecommerce LuluStore</title>
</head>
<body>
	<?php
		require_once "src/controllers/SessionController.php";
		$sc = new SessionController;
		// J'initialise la sessions
		$sc->init_php_session();
		// Je verifie si l'utilisateur est admin
		if($sc->is_logged()){
		?>
		<header class="mb-3">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">
					<a class="navbar-brand" href="<?= $url; ?>../?p=categories">Back office Lulu Store</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
						<div class="navbar-nav">
							<a class="nav-link active" aria-current="page" href="<?= $url; ?>../?p=categories">Accueil</a>
							<?php
								// Je verifie si l'utilisateur est super admin
								if($sc->is_SuperAdmin()){
									echo '<a class="nav-link active" href="'.$url.'../?p=parametre">Parametre</a>';
								}
							?>
							<a class="nav-link active" href="<?= $url; ?>../?p=deconnexion">Déconnexion</a></a>
						</div>
					</div>
				</div>
			</nav>
		</header>
	<?php
		}
	?>
	
	<main class="container">
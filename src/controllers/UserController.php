<?php

class UserController extends DefaultController{

    public function connection(){

        $sc = new SessionController;
        // Initaliser la sessions de l'utilisateur
        $sc->init_php_session();
        // Verifier s'il connecter
        if($sc->is_logged()){
            
            // Redirige sur la page des catégories de produit
            echo '<script language="JavaScript" type="text/javascript">

            window.location.replace("?p=categories");

            </script>';
        }
        else{
            // Récupération de la vue
            parent::renderClassique('authentification.php');
        }
    }

    public function traitement(){

        if(isset($_POST['mail']) && !empty($_POST['mail']) && isset($_POST['password']) && !empty($_POST['password'])){

           // Je crée des varaibles pour stocker les données du formulaire
           $user_mail = $_POST['mail'];
           $password = $_POST['password'];

           $um = new UserManager();

           //Je cherche s'il exsiter cet utilisateur dans ma base de données
           if($um->findUser($user_mail)->rowCount()==1){
                $user = $um->findUser($user_mail);

				// Je génère un tableau d'objets PHP 
                $user = $user->fetchObject('User');

                // Je verifie s'il le mots de passe de l'utilisateur est correct
                if(password_verify($password,$user->getPassword())){
                     
                     // Je stock les info récuperer de l'utilisateur  dans  les sessions  ( variables super global) pour pouvoir les reutiliser par la suite
                     $_SESSION['user_mail'] = $user_mail;
                     $_SESSION['rank'] = $user->getUser_admin();
                     $_SESSION['id'] = $user->getId();

                     // Redirige sur la page de connection
                     echo '<script language="JavaScript" type="text/javascript">

                            window.location.replace("?p=categories");

                            </script>';
                }
                else{
                    echo "<p class='text-danger'>Votre identifiant ou mot de passe n'est pas bonne</p>";
                }
           }
           else{
            echo "<p class='text-danger'>Votre identifiant ou de mot passe n'est pas bonne</p>";
           }
        }
        else{
            echo "<p class='text-danger'>Veuillez renseigner tous les champs du formulaire.</p>";

        }
    }

    public function deconnexion(){

        $sc = new SessionController;

        // Verifier s'il connecter
        if($sc->is_logged()){

            //Je nettoye la session
            $sc->clean_php_session();

            // Redirige vers la page de connection
            echo '<script language="JavaScript" type="text/javascript">
    
            window.location.replace("?p=connection");
    
            </script>';
        }
        else{
            echo "<p class='text-danger'>Une erreur s'est produit</p>";
        }
    }

    public function inscription(){

        $sc = new SessionController;
        // Initaliser la sessions de l'utilisateur
        $sc->init_php_session();
        // Verifier s'il connecter
        if($sc->is_logged()){
            
            // Redirige sur la page des catégories de produit
            echo '<script language="JavaScript" type="text/javascript">

            window.location.replace("?p=categories");

            </script>';
        }
        else{
            // Récupération de la vue
            parent::renderClassique('inscription.php');
        }
    }

    public function traitement_inscription(){
		if(isset($_POST['mail']) && !empty($_POST['mail']) && isset($_POST['password']) && !empty($_POST['password'])){
			
			// Je crée le objet 'um' de type 'UserManager'
			$um = new UserManager();

            // Je verifie si le compte "inscrit" existe déjà dans notre base de donnée
            $mailUser = $um->findUserByMail($_POST['mail']);
            if($mailUser->rowCount() == 1 ){
                echo "<p class='text-danger'>Ce compte existe déjà , veuiller - vous conneceter avec votre compte</p>";
            }
            else{

                 // Je lui assigne les données reçues par le formulaire
                $um->setMail($_POST['mail'])
                ->setPassword($_POST['password']);
            
                // Je sauvegarde le élément et je regarde le nombre de lignes affectées par le opération
                if($um->save()->rowCount() == 1){
                    echo "<p class='text-success'>Compte enregistrée.</p>";
                }
                else{
                    echo "<p class='text-danger'>Une erreur est survenue lors du enregistrement.</p>";
                }   
            }
		}
		else{
			echo "<p class='text-danger'>Veuillez renseigner tous les champs du formulaire.</p>";
		}
	}

    public function update(){

        $sc = new SessionController;
         // Initaliser la sessions de l'utilisateur
		$sc->init_php_session();
        // Verifier s'il est Super Admin
        // Pour des regles de sécurité seul le super admin peut modifier les roles des utlisateurs
		if($sc->is_SuperAdmin()){

            if(isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['user']) && !empty($_POST['user']) ){
			
                // Je crée le objet 'um' de type 'UserManager'
                $um = new UserManager();
                
				// Je vérifie que le id reçu par le formulaire corresponde bien à un utilisateur dans la base
				$utilisateur = $um->findUserById($_POST['id']);
                if($utilisateur->rowCount() == 1){
                    // Je lui assigne les données reçues par le formulaire
                    $um->setId($_POST['id'])
                        ->setUser_admin($_POST['user']);
                    
                    // Je sauvegarde le élément et je regarde le nombre de lignes affectées par le opération
                    if($um->update()->rowCount() >=1){
                     
                         echo "<p class='text-success'>Compte Mis à jour.</p>";
                    }
                    else{
                        echo "<p class='text-danger'>Les données sont identiques.</p>";
                    }
                }
                else{
                    echo "<p class='text-danger'>Cet utilisateur est introuvable </p>";
                }
            }
            else{
            echo "<p class='text-danger'>Veuillez renseigner  le selecteur du formulaire.</p>";
           }     
        }
        else{
            // Redirige vers la page de connection
			echo '<script language="JavaScript" type="text/javascript">
    
            window.location.replace("?p=connection");
    
            </script>';
		}
    }

    public function parametre(){

        $sc = new SessionController;
        // Initaliser la sessions de l'utilisateur
		$sc->init_php_session();

        // Verifier s'il est super Admin
		if($sc->is_SuperAdmin()){

            $um = new UserManager();

            // Récupère toute la table 'user'
            $utilisateurs = $um->findAll();

            // Je la transforme en objet PHP
            $liste_utilisateur = $utilisateurs->fetchAll(PDO::FETCH_CLASS, 'User');

            // Récupère toute la table 'role'
            $roles = $um->findAllRole();

            // Je la transforme en objet PHP
            $liste_role = $roles->fetchAll(PDO::FETCH_CLASS, 'Role');

            // Récupération de la vue
			$variables = compact('utilisateurs','liste_utilisateur', 'roles','liste_role');
			parent::render('parametre.php', $variables);
        }
        else{
            // Redirige vers la page de connection
			echo '<script language="JavaScript" type="text/javascript">
    
            window.location.replace("?p=connection");
    
            </script>';
		}
    }
}

?>
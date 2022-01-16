<?php

class SessionController{

    //Fonction qui permet d'initialiser et verifier la  session de l'utilisateur
    public static function init_php_session(): bool{

        if(!session_id()){
            session_start();
            session_regenerate_id();
            return true;
        }
        else {
            return false;
        }
    }

    //Fonction qui permet de nettoyer la session 
    public  function clean_php_session() :void{

        session_unset();
        session_destroy();
    }

     //Fonction qui permet de verifier s'il l'utlisateur est connecter ou pas
    public function is_logged(): bool{

        if(isset($_SESSION['user_mail'])){
            return true;
        }
        else{
            return false;
        }
    }

     //Fonction qui permet de verifier s'il l'utlisateur est admin ou pas
    public function is_admin(): bool{

        if($this->is_logged()){
            if(isset($_SESSION['rank']) && $_SESSION['rank'] >= 2  ){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

     //Fonction qui permet de verifier s'il l'utlisateur est Super admin ou pas
    public function is_SuperAdmin(): bool{

        if($this->is_logged()){
            if(isset($_SESSION['rank']) && $_SESSION['rank'] == 3  ){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
}

?>
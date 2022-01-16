<?php

class Autoload{
	public static function load(){
		spl_autoload_register([__CLASS__, 'mon_autoload']);
	}

	public static function mon_autoload($nomClasse){
		if(file_exists('src/class/'.$nomClasse.'.php')){
			require_once 'src/class/'.$nomClasse.'.php';
		}
		else if(file_exists('src/controllers/'.$nomClasse.'.php')){
			require_once 'src/controllers/'.$nomClasse.'.php';
		}
		else if(file_exists('src/models/'.$nomClasse.'.php')){
			require_once 'src/models/'.$nomClasse.'.php';
		}
		else if(file_exists('src/orms/'.$nomClasse.'.php')){
			require_once 'src/orms/'.$nomClasse.'.php';
		}
		else{
			die($nomClasse.' introuvable');
		}
	}
}
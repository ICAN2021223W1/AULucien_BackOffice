<?php

class DefaultController extends SessionController{
	protected static function render($vue, $variables){
		extract($variables);
		
		ob_start();

		require_once 'src/views/'.$vue;
		$contenu = ob_get_clean();

		echo $contenu;
	}

	protected static function renderClassique($vue){

		ob_start();

		require_once 'src/views/'.$vue;
		$contenu = ob_get_clean();

		echo $contenu;
	}
}
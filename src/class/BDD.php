<?php

class BDD{
	const HOST 	= 'localhost';
	const USR 	= 'root';
	const PWD 	= '';
	const DB 	= 'boutique';

	private $co;

	public function __construct(){
		try{
			$this->co = new PDO('mysql:host='.self::HOST.';dbname='.self::DB, self::USR, self::PWD);
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function getCo(){
		return $this->co;
	}
}
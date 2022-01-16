<?php

class Categorie{
	protected $id;
	private $nom;

	public function setId(int $id) : self
	{
		$this->id = $id;
		return $this;
	}

	public function getId() : int
	{
		return $this->id;
	}

	public function setNom(string $nom) : self
	{
		$this->nom = $nom;
		return $this;
	}
	
	public function getNom() : string
	{
		return $this->nom;
	}

}

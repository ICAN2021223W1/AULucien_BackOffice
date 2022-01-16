<?php

class Role{
	protected $id;
	private $role;

	public function setId(int $id) : self
	{
		$this->id = $id;
		return $this;
	}

	public function getId() : int
	{
		return $this->id;
	}

	public function setRole(string $role) : self
	{
		$this->role = $role;
		return $this;
	}
	
	public function getRole() : string
	{
		return $this->role;
	}

}

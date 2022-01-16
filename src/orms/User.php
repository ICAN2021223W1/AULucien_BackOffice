<?php

class User{
	protected $id;
	private $user_mail;
    private $user_password;
    private $registerDate;
    private $user_admin;

	public function setId(int $id) : self
	{
		$this->id = $id;
		return $this;
	}

	public function getId() : int
	{
		return $this->id;
	}

	public function setMail(string $user_mail) : self
	{
		$this->user_mail = $user_mail;
		return $this;
	}

	public function getMail() : string
	{
		return $this->user_mail;
	}

    public function setPassword(string $user_password) : self
	{
		$this->user_password = $user_password;
		return $this;
	}

	public function getPassword() : string
	{
		return $this->user_password;
	}

    public function setRegisterDate(string $registerDate) : self
	{
		$this->registerDate = $registerDate;
		return $this;
	}

	public function getRegisterDate() : string
	{
		return $this->registerDate;
	}

    public function setUser_admin(int $user_admin) : self
	{
		$this->user_admin = $user_admin;
		return $this;
	}
	
	public function getUser_admin(): int
	{
		return $this->user_admin;
	}

}

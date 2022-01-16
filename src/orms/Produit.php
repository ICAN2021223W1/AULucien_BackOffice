<?php

    class Produit{

        protected $id;
        private $nom;
        private $description;
        private $quantite;
        private $prix;
        private $categorie;

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

        public function setDescription(string $description) : self
        {
            $this->description = $description;
            return $this;
        }

        public function getDescription() : string
        {
            return $this->description;
        }

        public function setQuantite(int $quantite) : self
        {
            $this->quantite = $quantite;
            return $this; 
        }

        public function getQuantite() : int
        {
            return $this->quantite;
        }

        public function setPrix(string $prix) : self
        {
            $this->prix = $prix;
            return $this; 
        }

        public function getPrix() : string
        {
            return $this->prix;
        }

        public function setCategorie(int $categorie) : self
        {
            $this->categorie = $categorie;
            return $this;
        }

        public function getCategorie() : int
        {
            return $this->categorie;
        }
    }
    
?>
<?php
    class Usuario{
        private $DNIUsu;
        private $PwdUsu;
        private $NomUsu;
        private $ApeUsu;
        private $EmaUsu;
        private $ConUsu;
        private $IdRol;
    

    public function getDNIUsu(){
		return $this->DNIUsu;
	}

	public function setDNIUsu($DNIUsu){
		$this->DNIUsu = $DNIUsu;
	}

	public function getPwdUsu(){
		return $this->PwdUsu;
	}

	public function setPwdUsu($PwdUsu){
		$this->PwdUsu = $PwdUsu;
	}

	public function getNomUsu(){
		return $this->NomUsu;
	}

	public function setNomUsu($NomUsu){
		$this->NomUsu = $NomUsu;
	}

	public function getApeUsu(){
		return $this->ApeUsu;
	}

	public function setApeUsu($ApeUsu){
		$this->ApeUsu = $ApeUsu;
	}

	public function getEmaUsu(){
		return $this->EmaUsu;
	}

	public function setEmaUsu($EmaUsu){
		$this->EmaUsu = $EmaUsu;
	}

	public function getConUsu(){
		return $this->ConUsu;
	}

	public function setConUsu($ConUsu){
		$this->ConUsu = $ConUsu;
	}

	public function getIdRol(){
		return $this->IdRol;
	}

	public function setIdRol($IdRol){
		$this->IdRol = $IdRol;
	}

    }



?>
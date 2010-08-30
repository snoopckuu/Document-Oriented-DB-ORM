<?php

class Resource {
	
	private $aModified = array(),$aAttributes = array();
	private $sPK = null, $db = null;
	private $bIsNew = false;
	
	public function __construct( $sDomainName, $sPK = null){
		
		$this->db = Database::getInstance();
	
		$this->sDomain = $sDomainName;
		
		/* TODO: Move PK to save method */
		
		if( is_null( $sPK ) ){
			$this->isNew = true;
		} else{
			$this->sPK = $sPK;
			$this->populate();
		}
	
	}
	
	/* Magic */
	
	public function __call($name, $arguments ){
		
		$value = strtolower(substr($name,3,strlen($name)));
		$name = strtolower(substr($name,0,3));
		
		if( $name == 'set' )
			return $this->set($value,$arguments);
		elseif( $name == 'get' )
			return $this->get($value);
		elseif( $name == 'add' )
			return $this->add($value,$arguments);
		else
			throw new Exception('Method does not exist');
	}
	
	/* get Attribute from resource modified one first, than populated */
	
	private function get( $sName ){
		
			if( isset( $this->aModified[$sName] ) )
				return $this->output( $this->aModified[$sName] );
			elseif( isset( $this->aAttributes[$sName] ) )
				return $this->output( $this->aAttributes[$sName] );
			else
				return null;
		
	}
	
	/* Format output */
	
	private function output( $sString ){
		
		if( is_array( $sString ) && count( $sString ) == 1 )
			return $sString[0];
		else 
			return $sString;
		
	}
	
	
	private function add( $name, $arguments ){
		
		$attributes = $this->getAttributes();
		
		if( !is_array( $arguments ) )
			$arguments = array( $arguments );
		
		foreach( $arguments as $arg ){
				array_push($attributes[$name], $arg );
				$this->aModified[$name] = $attributes[$name];
		}
		
		return $this;
		
	}
	
	
	
	private function set( $name, $arguments ){
		
		$aKeys = array();
		
		foreach( $arguments as $arg ){
				
				if( !in_array($name, $aKeys) ){
					if( is_array( $arg ) )
						$this->aModified[$name] = $arg;
					else
						$this->aModified[$name] = array($arg);
					$aKeys[] = $name;
				} else {
					if( is_array( $arg ) ){
						foreach( $arg as $a ){ array_push($this->aModified[$name], $a); }
					} else
						array_push($this->aModified[$name], $arg);
				}
				
		}
		
		return $this;
	
	}
	
	/* populate object with saved information from db */
	
	public function populate(){

		$this->aAttributes = $this->db->retrieve($this->sDomain, $this->sPK );
		
	}
	
	/* return array of all attributes merge between saved & modified */
	
	public function getAttributes(){
		
		return array_merge($this->aAttributes, $this->aModified);
		
	}
	
	/* return array of modified attributes */ 
	
	public function getModifiedAttributes(){
		
		return $this->aModified;
		
	}
	
	public function isNew(){
		
		return $this->isNew;
		
	}
	
	public function isModified(){
		
		return ( empty( $this->aModified ) ) ? false : true;
		
	}
	
	/* return primary key */
	
	public function getPK(){
		
			return $this->sPK;
			
	}
	
	public function clean(){
		
		$this->isNew = true;
		$this->aModified = array();
		$this->aAttributes = array();
		$this->sPK = null;
		
	}
	
	public function save(){
		
		if( count( $this->getModifiedAttributes() ) > 0){
			if( is_null($this->sPK) )
				$this->sPK = uniqid();
			$this->db->save($this->sDomain,$this->sPK, $this->getModifiedAttributes());
		}
		
		$this->isNew = false;
		$this->aModified = array();
		
			if($this->sPK)
				$this->populate();
		
		return true;
		
	}
	
	
}
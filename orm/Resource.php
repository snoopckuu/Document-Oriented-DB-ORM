<?php

class Resource implements ArrayAccess {
	
	private $aModified = array(),$aAttributes = array();
	private $sPK = null, $db = null;
	private $bIsNew = false;
	
	public function __construct( $sPK = null, $sDomainName = null, $bPopulate = true){
		
		$this->db = Database::getInstance();
		
		if( is_null($sDomainName) )
			$this->sDomain = get_class($this);
	
		if( is_null( $sPK ) ){
			$this->isNew = true;
		} else{
			$this->sPK = $sPK;
			if($bPopulate === true)
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
	
	public function offsetSet($offset, $value) {
		if (is_null($offset)) {
			$this->aModified[] = $value;
		} else {
			$this->aModified[$offset] = $value;
	    }
	}
	
	public function offsetExists($offset) {
		return isset($this->aModified[$offset]);
	}
	
	public function offsetUnset($offset) {
		unset($this->aModified[$offset]);
	}
	
	public function offsetGet($offset) {
		return isset($this->aModified[$offset]) ? $this->output($this->aModified[$offset]) : null;
	}
	
	/* get Attribute from resource modified one first, than populated */
	
	private function get( $sName ){
		
			$sName = strtolower($sName);
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
		
		$aKeys = array($name);
		
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
	
	public function toArray(){
		
		return array_merge($this->aAttributes, $this->aModified);
		
	}
	
	public function toObject(){
		
		$object = new stdClass;
		
		$aAttribbutes = $this->toArray();
		
			foreach($aAttribbutes as $key => $value ){
				
				$object->$key = $value;
				
			}
			
		return $object;
		
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
	
	// TODO: PHP 5.2

	public static function query(){
		
		return Query::create()->from( get_called_class( ) ); 
		
	}
	
	public static function hydrate(array $aFields){
		$class = get_called_class( );
		return new $class($aFields['_PK'],$class,$aFields);
	}
	
	public static function retrieveByPk( $sPK ){
		
		$sModelName = get_called_class( );
		return new $sModelName( $sPK );
		
	}
	
	public function clean(){
		
		$this->isNew = true;
		$this->aModified = array();
		$this->aAttributes = array();
		$this->sPK = null;
		
	}
	
	public function delete(){
		
		return $this->db->delete($this->sDomain,$this->sPK);
		
	}
	
	public function save(){
		
		if( count( $this->getModifiedAttributes() ) > 0){
			$this->sPK = $this->db->save($this->sDomain,$this->sPK, $this->getModifiedAttributes());
		}
		
		$this->isNew = false;
		$this->aModified = array();
		
			if($this->sPK)
				$this->populate();
		
		return true;
		
	}
	
	
}
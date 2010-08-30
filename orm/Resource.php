<?php

class Resource {
	
	private $aModified = array(),$aAttributes = array();
	private $sPK = null, $oService = null;
	private $bIsNew = false;
	
	public function __construct( $sDomainName, $sPK = null){
		
		/* TODO: Adapter */
		$this->service = new Amazon_SimpleDB_Client(AWS_ACCESS_KEY_ID, 
	                                       			AWS_SECRET_ACCESS_KEY);
	
		$this->sDomain = $sDomainName;
		
		/* TODO: Move PK to save method */
		
		if( is_null( $sPK ) ){
			$this->sPK = uniqid();
			$this->isNew = true;
		} else{
			$this->sPK = $sPK;
			$this->populate();
		}
	
	}
	
	/* Magic */
	
	public function __call($name, $arguments ){
		
		if( substr($name,0,3) == 'set' )
			return $this->set(substr($name,3,strlen($name)),$arguments);
		elseif( substr($name,0,3) == 'get' )
			return $this->get(substr($name,3,strlen($name)));
		elseif( substr($name,0,3) == 'add' )
			return $this->get(substr($name,3,strlen($name)),$arguments);
		else
			throw new Exception('Method does not exist');
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
		
		$attributes = $this->getAttributes();
		
		if( !is_array( $arguments ) )
			$arguments = array( $arguments );
		
		foreach( $arguments as $arg ){
			if( is_array( $attributes[$name] ) ){
				array_push($attributes[$name], $arg );
				$this->aModified[$name] = $attributes[$name];
			} elseif( isset($this->attributes[$name ] ) ){
				
			} else {
				
			}
		}
		return $this;
		
	}
	
	
	
	private function set( $name, $arguments ){
		
		$keys
		foreach( $arguments as $arg ){
			
			if( is_array( $arg ) )
				$this->add( $name, $arg );
			elseif( )
				$this->aModified[strtolower($name)] = $arg;
			
		}
		
		return $this;
	
	}
	
	/* populate object with saved information from db TODO: Move to Adapter */
	
	public function populate(){
		
		$this->aAttributes = array();
		
		$response = $this->service->getAttributes(array ( "DomainName" =>  $this->sDomain,
		            								 "ItemName" =>    $this->sPK ) );
		
		if ($response->isSetGetAttributesResult()) { 
			
			$getAttributesResult = $response->getGetAttributesResult();
			$attributeList = $getAttributesResult->getAttribute();
			
			foreach ($attributeList as $attribute) {
			
			 if($attribute->isSetName() && $attribute->isSetValue()){
				$this->aAttributes[$attribute->getName()] = $attribute->getValue();
			 }
			
			}
			
			return true;
		
		} else 
		
			return false;
				
		
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
		
		if( $this->sPK === null )
			throw new Exception('Primary key is null');
		else
			return $this->sPK;
		
	}
	
	/* format array to Simpledb save format TODO: Move to adapter */
	
	private function format( array $aAttributes ){
		
		$aResult = array();
		
		foreach($aAttributes  as $name => $value ){
			
			$aResult[] = array ("Name" => $name, "Value" => $value);
			
		}
		
		return $aResult;
		
	}
	
	
	/* Save object to db TODO: Move everuthis to adapter */
	
	public function save(){

		$action = array ( "DomainName" =>  $this->sDomain,
		            "ItemName" =>    $this->sPK,
		            "Attribute" =>  $this->format($this->getModifiedAttributes()),
		            );
		
		$this->service->putAttributes($action);
		$this->isNew = false;
		$this->aModified = array();
		$this->populate();
		return true;
		
	}
	
	
}
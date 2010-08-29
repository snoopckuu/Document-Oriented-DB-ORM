<?php

class Resource {
	
	private $aModified = array(),$aAttributes = array();
	private $sPK = null, $oService = null;
	private $bIsNew = false;
	public function __construct( $sDomainName, $sPK = null){
		
		$this->service = new Amazon_SimpleDB_Client(AWS_ACCESS_KEY_ID, 
	                                       			AWS_SECRET_ACCESS_KEY);
	
		$this->sDomain = $sDomainName;
	
		if( is_null( $sPK ) ){
			$this->sPK = uniqid();
			$this->isNew = true;
		} else{
			$this->sPK = $sPK;
			$this->populate();
		}
	
	}
	
	public function __call($name, $arguments ){
		
		if( substr($name,0,3) == 'set' )
			return $this->set(substr($name,3,strlen($name)),$arguments);
		elseif( substr($name,0,3) == 'get' )
			return $this->get(substr($name,3,strlen($name)),$arguments);
		else
			throw new Exception('Method does not exist');
	}
	
	private function get( $sName ){
		
		$sName = strtolower($sName);
		
			if( isset( $this->aModified[$sName] ) )
				return $this->aModified[$sName];
			elseif( isset( $this->aAttributes[$sName] ) )
				return $this->aAttributes[$sName];
			else
				return null;
		
	}
	
	private function set( $name, $arguments ){
		
		foreach( $arguments as $arg ){
			
			$this->aModified[strtolower($name)] = $arg;
			
		}
		
		return $this;
	
	}
	
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
	
	public function getAttributes(){
		
		return array_merge($this->aAttributes, $this->aModified);
		
	}
	
	public function getModifiedAttributes(){
		
		return $this->aModified;
		
	}
	
	public function isNew(){
		
		return $this->isNew;
		
	}
	
	public function isModified(){
		
		return ( empty( $this->aModified ) ) ? false : true;
		
	}
	
	public function getPK(){
		
		if( $this->sPK === null )
			throw new Exception('Primary key is null');
		else
			return $this->sPK;
		
	}
	
	private function format( array $aAttributes ){
		
		$aResult = array();
		foreach($aAttributes  as $name => $value ){
			
			$aResult[] = array ("Name" => $name, "Value" => $value);
			
		}
		
		return $aResult;
		
	}
	
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
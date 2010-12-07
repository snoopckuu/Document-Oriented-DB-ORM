<?php

class Collection {
	
	private $aCollection = array();
	
	public function __construct(array $aResults){
		
		$this->aCollection = $aResults;
		
	}
	
	public function toJson(){
	
		return json_encode($this->aCollection);
	
	}
	
}
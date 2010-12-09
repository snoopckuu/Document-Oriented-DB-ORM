<?php

class Collection implements IteratorAggregate {

   	private $aCollection = array();

  	public function getIterator() {

    	return new ArrayIterator($this->aCollection);
	
   	}

	public function __construct(array $aResults){
		
		$this->aCollection = $aResults;
		
	}
	
	public function toJson(){
	
		return json_encode($this->aCollection);
	
	}
	
}
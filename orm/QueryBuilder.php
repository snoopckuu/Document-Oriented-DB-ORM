<?php

class QueryBuilder {
	
	public function __construct( Query $query ){
		
		$this->query = $query;
		if( is_null( $this->query->sFrom ) ) 
			throw new Exception('You need to specify FROM parameter');
	}
	
	public function __get($key){
		
		return $this->query->$key;
		
	}
	
	public function __toString(){
		
		if( is_null( $this->sFrom ) ) 
			return 'You need to specify FROM parameter';
		
		return $this->buildQuery();
		
	}
	
	private function buildQuery(){}
	
}
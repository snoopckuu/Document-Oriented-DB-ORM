<?php

/**
* Query builder
*/
class Query
{
	private $db = null;
	public $sFrom = null;
	public $aWhere = array();
	public $aOrWhere = array();
	public $sSelect = '*';
	public $sLimit = null;
	public $sOffset = null;
	public $aGroupBy = array();
	public $sOrderBy = null;
	
	public function __construct( $connection = null ){
		$this->db = Database::getInstance(); 
	}
	
	public static function create( $connection = null ){
		
		return new Query( $connection );
		
	}
	
	public function __toString(){
		
		return $this->fetchAll();
		
	}
	
	public function select( $sQuery ){
		
		$this->sSelect = $sQuery;
		
		return $this;
	}
	
	public function getModel(){
		return $this->sFrom;
	}
	
	public function from( $sQuery ){
		
		$this->sFrom = $sQuery;
		return $this;
	}
	
	public function where( $sQuery ){
		
		$this->aWhere[] = $sQuery;
		
		return $this;
		
	}
	
	public function andWhere( $sQuery ){
		
		return $this->where( $sQuery );
		
	}
	
	public function orWhere( $sQuery ){
		
		$this->aOrWhere[] = $sQuery;
		
		return $this;
		
	}
	
	public function setLimit( $sQuery ){
		
		$this->sLimit = $sQuery;
		
		return $this;
		
	}
	
	public function orderBy( $sQuery ){
		
		$this->sOrderBy = $sQuery;
		
		return $this;
		
	}
	
	public function toSql(){
		
		return new SqlBuilder( $this );
		
	}

	
	public function fetchAll(){
		
		 return new Collection($this->db->fetchAll($this));
		
	}
	
	public function fetchOne(){
		 
		 return $this->db->fetchOne($this);
		
	}
	
	
}

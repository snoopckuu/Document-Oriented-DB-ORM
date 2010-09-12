<?php

/**
* Query builder
*/
class Query
{
	private $db = null;
	private $sFrom = null;
	private $aWhere = array();
	private $aOrWhere = array();
	private $sSelect = '*';
	private $sLimit = null;
	private $sOffset = null;
	private $aGroupBy = array();
	private $sOrderBy = null;
	
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
	
	private function buildSql( $bLimit = false ){
		
		$sSql = "SELECT ";
		$sSql .= $this->sSelect;
		if( is_null( $this->sFrom ) ) 
			throw new Exception('You need to specify FROM parameter');
		$sSql .= " FROM ". $this->sFrom;
		if( !empty( $this->aWhere ) or !empty($this->aOrWhere) ){
			$sSql .= " WHERE ".implode(' AND ', $this->aWhere );
			$sSql .= (!empty($this->aWhere)) ? ' OR ' : '';
			$sSql .= implode(' OR ', $this->aOrWhere );
		}
		if( !is_null($this->sOrderBy ) )
			$sSql .= " ORDER BY ".$this->sOrderBy;
		if( !is_null($this->sLimit) OR $bLimit )
			$sSql .= " LIMIT ";
			$sSql .= ( $bLimit ) ? 1 : $this->sLimit;
		
		return $sSql;
		 
		
	}
	
	// TODO: Output decorator here.
	// TODO: Adapters
	
	public function fetchAll(){
		
		 $sSql = $this->buildSql();
		
		 return $this->db->Query($sSql);
		
	}
	
	public function fetchOne(){
		
		 $sSql = $this->buildSql(true);
		 
		 return $this->db->Query($sSql, true);
		
	}
	
	
}

<?php

/**
* SQL Builder
*/
class SqlBuilder
{
	
	public function __construct( Query $query ){
		
		foreach($query as $key => $val ){
			
			$this->$key = $val;
			
		}
		
	}
	
	public function __toString(){
		
		if( is_null( $this->sFrom ) ) 
			return 'You need to specify FROM parameter';
		
		return $this->buildSql();
		
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
	
	
}

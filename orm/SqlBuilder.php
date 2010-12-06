<?php

/**
* SQL Builder
*/
class SqlBuilder extends QueryBuilder
{
	
	private function buildQuery( $bLimit = false ){
		
		$sSql = "SELECT ";
		$sSql .= $this->sSelect;
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

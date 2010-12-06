<?php

/**
* Mongo
*/
class MongoQueryBuilder extends QueryBuilder
{
	private static $aOperators = array(' = ' => '', ' < ' => '$gt', 
									   ' > ' => '$lt', 
									   '<=' => '$gte', '>=' => '$lte', 
									   ' IN ' => '$all', ' NOT IN ' => '$nin');
	
	private $aExist = array();
									
	public function buildQuery( $bLimit = false ){
		
		$sSql = "db.".ORMConfig::get('database','mongodb');
		#$sSql .= $this->sSelect;
		$sSql .= ".". $this->sFrom.'.';

			foreach($this->aWhere as $a){
				$this->parseValue($a);
		 	}
		if( !is_null($this->sOrderBy ) )
			#$sSql .= " ORDER BY ".$this->sOrderBy;
		if( !is_null($this->sLimit) OR $bLimit )
			#$sSql .= " LIMIT ";
			#$sSql .= ( $bLimit ) ? 1 : $this->sLimit;
		
		return $this->aExist;
		 	
	}
	
	
	private function parseValue( $value ){
		
		foreach( self::$aOperators as $o => $command){
			$ex = explode($o, $value);
			$key = trim(strtolower($ex[0]));
			$value = trim($ex[1], ' " ');
			if( count($ex) > 1 ){
				if(!empty($command)){
					$aResult = (in_array($key,array_keys($this->aExist))) ? array( $command => $value ) : array( $key => array( $command => $value )); 
				}
				$aResult = (in_array($key,array_keys($this->aExist))) ? $value :array( $key => $value);
				break;
			}
		}
		$this->aExist[] = $aResult;
		return $aResult;
		
	}

}

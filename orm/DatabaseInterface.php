<?php 

interface DatabaseInterface {
	
	 public function createDomain($sName);
	 public function deleteDomain($sName);
	 public function listDomains();
	 
	 public function retrieve($sDomain,$sPk);
	 public function fetchAll(Query $query);
	 public function fetchOne(Query $query);
	
	 public function save($sDomain,$sPk, array $aAttributes);
	
}
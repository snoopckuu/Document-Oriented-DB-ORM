<?php 

interface DatabaseInterface {
	
	 public function createDomain($sName);
	 public function deleteDomain($sName);
	 public function listDomains();
	 
	 public function query($sQuery);
	
	 public function retrieve($sDomain,$sPk);
	 public function save($sDomain,$sPk, array $aAttributes);
	
}
<?php 

class MongoDBAdapter implements DatabaseInterface {
	
	 public function __construct(){
		
		$host = (ORMConfig::get('host','mongodb')) ? ORMConfig::get('host','mongodb') : 'localhost';
		$port = (ORMConfig::get('port','mongodb')) ? ORMConfig::get('port','mongodb') : '27017';
		$this->service = new Mongo("mongodb://{$host}:{$port}");
		$this->service->selectDB(ORMConfig::get('database','mongodb'));
		if(ORMConfig::get('username','mongodb') && ORMConfig::get('password','mongodb')){
			$this->service->authenticate(ORMConfig::get('username','mongodb'),ORMConfig::get('password','mongodb'));
		}
	 }
	
	 public function createDomain($sName){
		return $this->service->command(array("create" => $sName);
	 }
	 public function deleteDomain($sName){
		return $this->service->selectCollection($sName)->drop();
	 }
	 public function listDomains(){
		return $this->service->listCollections();
	 }
	 
	 public function retrieve($sDomain,$sPk){
		
	 }
	 public function fetchAll(Query $query){
		
	 }
	 public function fetchOne(Query $query){
		
	 }
	
	 public function save($sDomain,$sPk, array $aAttributes){
		
	 }
}
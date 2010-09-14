<?php 

class MongoDBAdapter implements DatabaseInterface {
	
	 public function __construct(){
		
		$host = (ORMConfig::get('host','mongodb')) ? ORMConfig::get('host','mongodb') : 'localhost';
		$port = (ORMConfig::get('port','mongodb')) ? ORMConfig::get('port','mongodb') : '27017';
		$this->service = new Mongo("mongodb://{$host}:{$port}", array('connect' => true));
		$this->service = $this->service->selectDB(ORMConfig::get('database','mongodb'));
		if(ORMConfig::get('username','mongodb') && ORMConfig::get('password','mongodb')){
			$this->service->authenticate(ORMConfig::get('username','mongodb'),ORMConfig::get('password','mongodb'));
		}
	 }
	
	 public function createDomain($sName){
		return $this->service->command(array("create" => $sName));
	 }
	 public function deleteDomain($sName){
		return $this->service->selectCollection($sName)->drop();
	 }
	 public function listDomains(){
		return $this->service->listCollections();
	 }
	 
	 public function retrieve($sDomain,$sPk){
		return $this->service->selectCollection($sDomain)->findOne(array('_id' => new MongoId($sPk)));
	 }
	
	 //FIXME: IMPLEMENT ME 
	
	 public function fetchAll(Query $query){
		return array();
	 }
	 public function fetchOne(Query $query){
		return array();
	 }	
	
	 public function save($sDomain,$sPk, array $aAttributes){
		$aAttributes['_id'] = new MongoId($sPk);		
			if($this->service->selectCollection($sDomain)->save($aAttributes)){
				return $aAttributes['_id'];
			}else
				return false;
		
	 }
	 public function delete($sDomain,$sPk){
		return $this->service->selectCollection($sDomain)->remove(array('_id' => new MongoId($sPk)), true);
	 }
}
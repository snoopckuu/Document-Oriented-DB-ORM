<?

class Database {
	
	private static $instance = null;
	
	public static function getInstance(){
		if(self::$instance === null){
			$adapter = ORMConfig::get('adapter','orm');
			self::$instance = new $adapter();
		}
		
		return self::$instance;
	}
	
}
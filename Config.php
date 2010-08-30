<?php

     function simpleDBautoload($className){
        $className = 'vendor/'.str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
		if( file_exists($className) )
			include_once($className);
		
		return;

    }

	class Config {
		
		private static $instance = null;
		private static $aSettings = null;
		
		private function __construct(){	
			$yaml = new sfYamlParser();
			self::$aSettings = $yaml->parse(file_get_contents('config/settings.yaml'));
		}
		
		public static function getInstnace(){
			if(self::$instance === null)
				self::$instance = new Config();
		}
		
		public static function get( $sKey ){
			
			var_dump( $self::$aSettings );
			
		}
		
	}

	spl_autoload_register('simpleDBautoload');
  	
	Config::getInstnace();


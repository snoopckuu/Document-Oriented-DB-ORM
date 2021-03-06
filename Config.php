<?php

// TODO: Completely overwrite autoload and deleter this file.
set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ .'/vendor');
	
	function autoload($className){
        $path = realpath(__DIR__).'/';
		if(stristr($className,'Amazon')){
			
			$className = $path.'vendor/'.str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
			if( file_exists($className) )
				include_once($className);
			return;
			
		}
		$className = str_replace('Adapter','',$className);
		$className = $className.'.php';
		if( file_exists($path.'vendor/yaml/'.$className) )
			include_once($path.'vendor/yaml/'.$className);
		elseif( file_exists($path.'orm/'.$className) )
			include_once($path.'orm/'.$className);
		elseif( file_exists($path.'model/'.$className) )
			include_once($path.'model/'.$className);
		elseif( file_exists($path.'adapters/'.$className) )
			include_once($path.'adapters/'.$className);
		
		return;

    }
	
	spl_autoload_register('autoload');
			
	class ORMConfig {
		
		private static $instance = null;
		private static $aSettings = null;
		
		private function __construct(){	
			$yaml = new sfYamlParser();
			self::$aSettings = $yaml->parse(file_get_contents(__DIR__.'/config/settings.yml'));
		}
		
		public static function getInstance(){
			if(self::$instance === null)
				self::$instance = new ORMConfig();
			
			return self::$instance;
		}
		
		public static function get( $sKey, $sNamespace = false ){
			
			if( $sNamespace && isset(self::$aSettings[$sNamespace][$sKey]))
				return self::$aSettings[$sNamespace][$sKey];
			elseif( isset(self::$aSettings[$sKey]) )
				return self::$aSettings[$sKey];
			else 
				return null;
		}
		
	}
	
	class Schema {
		
		private static $instance = null;
		private static $aSettings = null;
		
		private function __construct(){	
			$yaml = new sfYamlParser();
			self::$aSettings = $yaml->parse(file_get_contents(__DIR__.'/config/schema.yml'));
		}
		
		public static function getInstance(){
			if(self::$instance === null)
				self::$instance = new Schema();
			
			return self::$instance;
		}
		
		public static function get( $sSchema, $sModel, $sField ){

				return ( isset(self::$aSettings[$sSchema][$sModel][$sField]) ) ? self::$aSettings[$sSchema][$sModel][$sField] : null;

		}
		
	}

	ORMConfig::getInstance();
	Schema::getInstance();
	

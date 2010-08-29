<?php

    define('AWS_ACCESS_KEY_ID', '');
    define('AWS_SECRET_ACCESS_KEY', '');  


    set_include_path(get_include_path() . PATH_SEPARATOR . '../vendor');    
    
     function __autoload($className){
        $filePath = str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
        $includePaths = explode(PATH_SEPARATOR, get_include_path());
        foreach($includePaths as $includePath){
            if(file_exists($includePath . DIRECTORY_SEPARATOR . $filePath)){
                require_once $filePath;
                return;
            }
        }
    }
  

<?php

/**
* User Model
*/
class User extends Resource {
	
	public $id = null;
	
	public function __construct( $id = null){
		
		if( !is_null($id) )
			$this->id = $id;
		
		parent::__construct(get_class($this),$this->id);
		
	}
	
}
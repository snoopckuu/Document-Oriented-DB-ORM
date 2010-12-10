<?php

/**
* Input Decorator
*/

class InputDecorator
{
	private $sInput = null,$sField = null;
	
	public function __construct( $sInput, $sField ){
		
		$this->input $sInput;
		$this->format = $sFormat;
		
	}
	
	public function __toString(){
		return $this->input;
	}
	
}
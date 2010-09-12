<?php

/**
* Output Decorator
*/
class OutputDecorator implements IteratorAggregate
{
	private $input = null;
	public function __construct( $input ){
		$this->input = $input;
	}
	
	public function getIterator() {
        return new ArrayIterator($this->input);
    }

	public function __toString(){
		
		return $this->input;
		
	}
	
	// TODO: implemet this
	public function toArray(){}
	public function toObject(){}
	
	
}

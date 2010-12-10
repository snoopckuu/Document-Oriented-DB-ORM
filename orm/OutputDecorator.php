<?php

/**
* Output Decorator
*/
class OutputDecorator implements IteratorAggregate, ArrayAccess
{
	private $input = null,$format = null;
	
	public function __construct( $input, $sFormat = null ){
		
		if(is_array($input) && count($input) == 1)
			$this->input = $this->transform($input[0]);
		elseif(is_array($input))
		 	$this->input = $this->map($input);
		else
			$this->input = $this->transform($input);
			
		$this->format = $sFormat;
		
	}
	
	public function getIterator() {
		
		if(!is_array($this->input))
			$aResult = array($this->input);
        else
			$aResult = $this->input;
			
		return new ArrayIterator($aResult);
		
    }

	public function offsetSet($offset, $value) {}
	public function offsetUnset($offset) {}
		
	public function offsetExists($offset) {
		return isset($this->input[$offset]);
	}
	
	public function offsetGet($offset) {
		return isset($this->input[$offset]) ? $this->input[$offset] : null;
	}
	
	public function __toString(){
		
		$sOutput = $this->input;
		if(is_array($sOutput))
			$sOutput = 'Array'; // Stupid but this magic should return only string
		return (is_null($sOutput)) ? "asd" : $sOutput;
		
	}
	
	private function map( array $aInput ){
		return array_map(array('OutputDecorator','transform'),$aInput);
	}
	
	// TODO: CHECK Config & schema for escaping type
	
	public function transform($sInput = null, $sFormat = null){
		
		$sInput = (is_null($sInput)) ? $this->input : $sInput;
		$sFormat = (is_null($sFormat)) ? $this->format : $sFormat;
		
		if(is_array($sInput) && !is_null($sFormat))
			return $this->glue($sFormat);
		else
			return htmlspecialchars($sInput);
			
	}
	
	private function dateTime(){
		
		$sDefaultFormat = ORMConfig::get('date_format','orm');
		
		if(!is_null($this->format))
			$sFormat = $this->format;
		elseif(!empty($sDefaultFormat))
			$sFormat = $sDefaultFormat;
		else
			$sFormat = DateTime::RSS;
		
		$datetime = new Datetime($this->input);

		return $datetime->format($sFormat);

	}
	
	public function glue($sInput){
		return (is_array($this->input)) ? implode($sInput,$this->input) : $this->input;
	}
	
	public function getRaw(){
		return $this->input;
	}
	
	// TODO: IMPLEMENT
	public function toXML(){}
	
	
}

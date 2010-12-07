<?php

require_once('../vendor/simpletest/autorun.php');
require_once('../Config.php');

class TestOfModel extends UnitTestCase {
	
	 public function testIsNew(){
		
		$user = new User();
		$this->assertTrue($user->isNew());
		$user->setName('daniel');
		$user->save();
		$this->assertFalse($user->isNew());
		
	}
	
}
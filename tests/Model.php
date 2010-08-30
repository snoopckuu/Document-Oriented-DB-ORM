<?php

require_once('../vendor/simpletest/autorun.php');
require_once('../Config.php');
require_once('../orm/Resource.php');
require_once('../Model/User.php');

$user = new User('4c798669f35ee');

class TestOfModel extends UnitTestCase {
	
	 public function testIsNew(){
		
		$user = new User();
		$this->assertTrue($user->isNew());
		$user->setName('daniel');
		$user->save();
		$this->assertFalse($user->isNew());
		
	}
	
}
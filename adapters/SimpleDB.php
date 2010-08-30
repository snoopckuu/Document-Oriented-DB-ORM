<?php

class SimpleDB extends Database {
	
		private function __construct(){
			
			$this->service = new Amazon_SimpleDB_Client(AWS_ACCESS_KEY_ID, 
		                                       			AWS_SECRET_ACCESS_KEY);
		}

		public function createDomain( $sName ){

			return $this->service->createDomain(array('DomainName'=> $sName));

		}

		public function query( )

	}
}
<?php 

interface Database {
	
	 public function createResource();
	 public function listResources();
	 public function deleteResource();
	
	 public function insertItem();
	 public function deleteItem();
	
	 public function getAttributes();
	 public function putAttributes();
	
}
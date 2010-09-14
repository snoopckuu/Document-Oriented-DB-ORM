<?php

class SimpleDBAdapter implements DatabaseInterface {
	
		public function __construct(){
			
			$this->service = new Amazon_SimpleDB_Client(ORMConfig::get('access_key','amazon'), 
		                                       			ORMConfig::get('secret_key','amazon'));
		}

		public function createDomain( $sName ){

			return $this->service->createDomain(array('DomainName'=> $sName));

		}
		
		public function deleteDomain( $sName ){

			return $this->service->deleteDomain(array('DomainName'=> $sName));

		}
		
		public function getDomainInfo( $sName ){
			
			$response = $this->service->domainMetadata(array('DomainName'=> $sName));
			
			if ($response->isSetDomainMetadataResult()) { 
                $domainMetadataResult = $response->getDomainMetadataResult();
              	$aResult["ItemCount"] = $domainMetadataResult->getItemCount();
                $aResult["ItemNamesSizeBytes"] = $domainMetadataResult->getItemNamesSizeBytes();
                $aResult["AttributeNameCount"] = $domainMetadataResult->getAttributeNameCount();
                $aResult["AttributeNamesSizeBytes"] = $domainMetadataResult->getAttributeNamesSizeBytes();
                $aResult["AttributeValueCount"] = $domainMetadataResult->getAttributeValueCount();
                $aResult["AttributeValuesSizeBytes"] = $domainMetadataResult->getAttributeValuesSizeBytes();
                $aResult["Timestamp"] = $domainMetadataResult->getTimestamp();

				return $aResult;
               
            } else return null;
		
		}
		
		public function listDomains() {
			
			$aDomains = array();
			
			$response = $this->service->listDomains(array());
			
			 if ($response->isSetListDomainsResult()) { 
                    $listDomainsResult = $response->getListDomainsResult();
                    $domainNameList  =  $listDomainsResult->getDomainName();
                    foreach ($domainNameList as $domainName) { 
                        $aDomains[] =  $domainName;
                    }	
             }
			
			return $aDomains;
			
		}

		public function query( $sQuery, $bOne = false ){
			
			$aResult = array();	
			$response = $this->service->select(array( 'SelectExpression' => $sQuery ) );

	        
			  if ($response->isSetSelectResult()) { 
	                    $selectResult = $response->getSelectResult();
	                    $itemList = $selectResult->getItem();
	                    foreach ($itemList as $item) {
	                       	$res = array( '_PK' => $item->getName() );
	                       
	                        $attributeList = $item->getAttribute();
	                        foreach ($attributeList as $attribute) {
	                            if( isset($res[$attribute->getName()]) && is_array($res[$attribute->getName()] ) )
									array_push($res[$attribute->getName()],$attribute->getValue());
								elseif( isset( $res[$attribute->getName()] ) )
									$res[$attribute->getName()] = array( $res[$attribute->getName()], $attribute->getValue() );
								else
									$res[$attribute->getName()] = $attribute->getValue();
	                        }
							$aResult[] = $res;
	                    }
			  }
			
			return ( $bOne ) ? $aResult[0] : $aResult;
			
		}
		
		public function retrieve( $sDomain, $sPK ){
			
			$aResult = array();
			
			$response = $this->service->getAttributes(array ( "DomainName" =>  $sDomain,
			            								 "ItemName" =>    $sPK ) );

			if ($response->isSetGetAttributesResult()) { 

				$getAttributesResult = $response->getGetAttributesResult();
				$attributeList = $getAttributesResult->getAttribute();

				foreach ($attributeList as $attribute) {

				 if($attribute->isSetName() && $attribute->isSetValue()){
					
					if( isset($aResult[$attribute->getName()]) && is_array($aResult[$attribute->getName()] ) )
						array_push($aResult[$attribute->getName()],$attribute->getValue());
					elseif( isset( $aResult[$attribute->getName()] ) )
						$aResult[$attribute->getName()] = array( $aResult[$attribute->getName()], $attribute->getValue() );
					else
						$aResult[$attribute->getName()] = $attribute->getValue();
				 
				}

				}

				return $aResult;

			} else 

				return false;
			
	  }
	
	  private function format( array $aAttributes ){

		$aResult = array();
		foreach($aAttributes as $name => $value ){

			foreach( $value as $val )
				$aResult[] = array ("Name" => $name, "Value" => $val);
		}

		return $aResult;

	 }
	 
	 public function save( $sDomain, $sPk, array $aArguments ){

		$action = array ( "DomainName" =>  $sDomain,
		            "ItemName" => $sPk,
		            "Attribute" =>  $this->format($aArguments),
		            );
		if($this->service->putAttributes($action))
			return $sPk;
		else
			return false;
		
	 } 
	
	 public function fetchOne( Query $query ){
		$sSql = new SqlBuilder( $query->limit(1) );
		return $this->Query( $sSql, true );
	 }
	
	 public function fetchAll( Query $query ){
		
		$sSql = new SqlBuilder( $query );
		return $this->Query( $sSql );
		
	 }
	 
	 // TODO: IMPLEMENT ME
	 public function delete( $sDomain,$sPk ){
		return false;
	 }

}
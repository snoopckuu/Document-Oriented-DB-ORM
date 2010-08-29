<?php
/** 
 *  PHP Version 5
 *
 *  @category    Amazon
 *  @package     Amazon_SimpleDB
 *  @copyright   Copyright 2008-2009 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 *  @link        http://aws.amazon.com
 *  @license     http://aws.amazon.com/apache2.0  Apache License, Version 2.0
 *  @version     2009-04-15
 */
/******************************************************************************* 
 *    __  _    _  ___ 
 *   (  )( \/\/ )/ __)
 *   /__\ \    / \__ \
 *  (_)(_) \/\/  (___/
 * 
 *  Amazon Simple DB PHP5 Library
 *  Generated: Wed Jan 06 15:57:27 PST 2010
 * 
 */

/**
 * Domain Metadata  Sample
 */

include_once ('.config.inc.php'); 

/************************************************************************
 * Instantiate Implementation of Amazon SimpleDB
 * 
 * AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY constants 
 * are defined in the .config.inc.php located in the same 
 * directory as this sample
 ***********************************************************************/
 $service = new Amazon_SimpleDB_Client(AWS_ACCESS_KEY_ID, 
                                       AWS_SECRET_ACCESS_KEY);
 
/************************************************************************
 * Uncomment to try out Mock Service that simulates Amazon_SimpleDB
 * responses without calling Amazon_SimpleDB service.
 *
 * Responses are loaded from local XML files. You can tweak XML files to
 * experiment with various outputs during development
 *
 * XML files available under Amazon/SimpleDB/Mock tree
 *
 ***********************************************************************/
 // $service = new Amazon_SimpleDB_Mock();

/************************************************************************
 * Setup request parameters and uncomment invoke to try out 
 * sample for Domain Metadata Action
 ***********************************************************************/
 // @TODO: set request. Action can be passed as Amazon_SimpleDB_Model_DomainMetadataRequest
 // object or array of parameters
 // invokeDomainMetadata($service, $request);

                                
/**
  * Domain Metadata Action Sample
  * The DomainMetadata operation returns some domain metadata values, such as the
  * number of items, attribute names and attribute values along with their sizes.  
  * @param Amazon_SimpleDB_Interface $service instance of Amazon_SimpleDB_Interface
  * @param mixed $request Amazon_SimpleDB_Model_DomainMetadata or array of parameters
  */
  function invokeDomainMetadata(Amazon_SimpleDB_Interface $service, $request) 
  {
      try {
              $response = $service->domainMetadata($request);
              
                echo ("Service Response\n");
                echo ("=============================================================================\n");

                echo("        DomainMetadataResponse\n");
                if ($response->isSetDomainMetadataResult()) { 
                    echo("            DomainMetadataResult\n");
                    $domainMetadataResult = $response->getDomainMetadataResult();
                    if ($domainMetadataResult->isSetItemCount()) 
                    {
                        echo("                ItemCount\n");
                        echo("                    " . $domainMetadataResult->getItemCount() . "\n");
                    }
                    if ($domainMetadataResult->isSetItemNamesSizeBytes()) 
                    {
                        echo("                ItemNamesSizeBytes\n");
                        echo("                    " . $domainMetadataResult->getItemNamesSizeBytes() . "\n");
                    }
                    if ($domainMetadataResult->isSetAttributeNameCount()) 
                    {
                        echo("                AttributeNameCount\n");
                        echo("                    " . $domainMetadataResult->getAttributeNameCount() . "\n");
                    }
                    if ($domainMetadataResult->isSetAttributeNamesSizeBytes()) 
                    {
                        echo("                AttributeNamesSizeBytes\n");
                        echo("                    " . $domainMetadataResult->getAttributeNamesSizeBytes() . "\n");
                    }
                    if ($domainMetadataResult->isSetAttributeValueCount()) 
                    {
                        echo("                AttributeValueCount\n");
                        echo("                    " . $domainMetadataResult->getAttributeValueCount() . "\n");
                    }
                    if ($domainMetadataResult->isSetAttributeValuesSizeBytes()) 
                    {
                        echo("                AttributeValuesSizeBytes\n");
                        echo("                    " . $domainMetadataResult->getAttributeValuesSizeBytes() . "\n");
                    }
                    if ($domainMetadataResult->isSetTimestamp()) 
                    {
                        echo("                Timestamp\n");
                        echo("                    " . $domainMetadataResult->getTimestamp() . "\n");
                    }
                } 
                if ($response->isSetResponseMetadata()) { 
                    echo("            ResponseMetadata\n");
                    $responseMetadata = $response->getResponseMetadata();
                    if ($responseMetadata->isSetRequestId()) 
                    {
                        echo("                RequestId\n");
                        echo("                    " . $responseMetadata->getRequestId() . "\n");
                    }
                    if ($responseMetadata->isSetBoxUsage()) 
                    {
                        echo("                BoxUsage\n");
                        echo("                    " . $responseMetadata->getBoxUsage() . "\n");
                    }
                } 

     } catch (Amazon_SimpleDB_Exception $ex) {
         echo("Caught Exception: " . $ex->getMessage() . "\n");
         echo("Response Status Code: " . $ex->getStatusCode() . "\n");
         echo("Error Code: " . $ex->getErrorCode() . "\n");
         echo("Error Type: " . $ex->getErrorType() . "\n");
         echo("Request ID: " . $ex->getRequestId() . "\n");
         echo("XML: " . $ex->getXML() . "\n");
     }
 }
                            
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
 * Select  Sample
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
 * sample for Select Action
 ***********************************************************************/
 // @TODO: set request. Action can be passed as Amazon_SimpleDB_Model_SelectRequest
 // object or array of parameters
 // invokeSelect($service, $request);

                                                        
/**
  * Select Action Sample
  * The Select operation returns a set of item names and associate attributes that match the
  * query expression. Select operations that run longer than 5 seconds will likely time-out
  * and return a time-out error response.  
  * @param Amazon_SimpleDB_Interface $service instance of Amazon_SimpleDB_Interface
  * @param mixed $request Amazon_SimpleDB_Model_Select or array of parameters
  */
  function invokeSelect(Amazon_SimpleDB_Interface $service, $request) 
  {
      try {
              $response = $service->select($request);
              
                echo ("Service Response\n");
                echo ("=============================================================================\n");

                echo("        SelectResponse\n");
                if ($response->isSetSelectResult()) { 
                    echo("            SelectResult\n");
                    $selectResult = $response->getSelectResult();
                    $itemList = $selectResult->getItem();
                    foreach ($itemList as $item) {
                        echo("                Item\n");
                        if ($item->isSetName()) 
                        {
                            echo("                    Name\n");
                            echo("                        " . $item->getName() . "\n");
                        }
                        $attributeList = $item->getAttribute();
                        foreach ($attributeList as $attribute) {
                            echo("                    Attribute\n");
                            if ($attribute->isSetName()) 
                            {
                                echo("                        Name\n");
                                echo("                            " . $attribute->getName() . "\n");
                            }
                            if ($attribute->isSetValue()) 
                            {
                                echo("                        Value\n");
                                echo("                            " . $attribute->getValue() . "\n");
                            }
                        }
                    }
                    if ($selectResult->isSetNextToken()) 
                    {
                        echo("                NextToken\n");
                        echo("                    " . $selectResult->getNextToken() . "\n");
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
    
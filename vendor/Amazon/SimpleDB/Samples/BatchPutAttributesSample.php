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
 * Batch Put Attributes  Sample
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
 * sample for Batch Put Attributes Action
 ***********************************************************************/
 // @TODO: set request. Action can be passed as Amazon_SimpleDB_Model_BatchPutAttributesRequest
 // object or array of parameters
 // invokeBatchPutAttributes($service, $request);

                                            
/**
  * Batch Put Attributes Action Sample
  * The BatchPutAttributes operation creates or replaces attributes within one or more items.
  * You specify the item name with the Item.X.ItemName parameter.
  * You specify new attributes using a combination of the Item.X.Attribute.Y.Name and Item.X.Attribute.Y.Value parameters.
  * You specify the first attribute for the first item by the parameters Item.0.Attribute.0.Name and Item.0.Attribute.0.Value,
  * the second attribute for the first item by the parameters Item.0.Attribute.1.Name and Item.0.Attribute.1.Value, and so on.
  * Attributes are uniquely identified within an item by their name/value combination. For example, a single
  * item can have the attributes { "first_name", "first_value" } and { "first_name",
  * second_value" }. However, it cannot have two attribute instances where both the Item.X.Attribute.Y.Name and
  * Item.X.Attribute.Y.Value are the same.
  * Optionally, the requestor can supply the Replace parameter for each individual value. Setting this value
  * to true will cause the new attribute value to replace the existing attribute value(s). For example, if an
  * item 'I' has the attributes { 'a', '1' }, { 'b', '2'} and { 'b', '3' } and the requestor does a
  * BacthPutAttributes of {'I', 'b', '4' } with the Replace parameter set to true, the final attributes of the
  * item will be { 'a', '1' } and { 'b', '4' }, replacing the previous values of the 'b' attribute
  * with the new value.  
  * @param Amazon_SimpleDB_Interface $service instance of Amazon_SimpleDB_Interface
  * @param mixed $request Amazon_SimpleDB_Model_BatchPutAttributes or array of parameters
  */
  function invokeBatchPutAttributes(Amazon_SimpleDB_Interface $service, $request) 
  {
      try {
              $response = $service->batchPutAttributes($request);
              
                echo ("Service Response\n");
                echo ("=============================================================================\n");

                echo("        BatchPutAttributesResponse\n");
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
                
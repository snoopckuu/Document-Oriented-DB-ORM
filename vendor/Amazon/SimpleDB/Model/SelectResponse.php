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
 *  @see Amazon_SimpleDB_Model
 */
require_once ('Amazon/SimpleDB/Model.php');  

    

/**
 * Amazon_SimpleDB_Model_SelectResponse
 * 
 * Properties:
 * <ul>
 * 
 * <li>SelectResult: Amazon_SimpleDB_Model_SelectResult</li>
 * <li>ResponseMetadata: Amazon_SimpleDB_Model_ResponseMetadata</li>
 *
 * </ul>
 */ 
class Amazon_SimpleDB_Model_SelectResponse extends Amazon_SimpleDB_Model
{


    /**
     * Construct new Amazon_SimpleDB_Model_SelectResponse
     * 
     * @param mixed $data DOMElement or Associative Array to construct from. 
     * 
     * Valid properties:
     * <ul>
     * 
     * <li>SelectResult: Amazon_SimpleDB_Model_SelectResult</li>
     * <li>ResponseMetadata: Amazon_SimpleDB_Model_ResponseMetadata</li>
     *
     * </ul>
     */
    public function __construct($data = null)
    {
        $this->_fields = array (
        'SelectResult' => array('FieldValue' => null, 'FieldType' => 'Amazon_SimpleDB_Model_SelectResult'),
        'ResponseMetadata' => array('FieldValue' => null, 'FieldType' => 'Amazon_SimpleDB_Model_ResponseMetadata'),
        );
        parent::__construct($data);
    }

       
    /**
     * Construct Amazon_SimpleDB_Model_SelectResponse from XML string
     * 
     * @param string $xml XML string to construct from
     * @return Amazon_SimpleDB_Model_SelectResponse 
     */
    public static function fromXML($xml)
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);
        $xpath = new DOMXPath($dom);
    	$xpath->registerNamespace('a', 'http://sdb.amazonaws.com/doc/2009-04-15/');
        $response = $xpath->query('//a:SelectResponse');
        if ($response->length == 1) {
            return new Amazon_SimpleDB_Model_SelectResponse(($response->item(0))); 
        } else {
            throw new Exception ("Unable to construct Amazon_SimpleDB_Model_SelectResponse from provided XML. 
                                  Make sure that SelectResponse is a root element");
        }
          
    }
    
    /**
     * Gets the value of the SelectResult.
     * 
     * @return SelectResult SelectResult
     */
    public function getSelectResult() 
    {
        return $this->_fields['SelectResult']['FieldValue'];
    }

    /**
     * Sets the value of the SelectResult.
     * 
     * @param SelectResult SelectResult
     * @return void
     */
    public function setSelectResult($value) 
    {
        $this->_fields['SelectResult']['FieldValue'] = $value;
        return;
    }

    /**
     * Sets the value of the SelectResult  and returns this instance
     * 
     * @param SelectResult $value SelectResult
     * @return Amazon_SimpleDB_Model_SelectResponse instance
     */
    public function withSelectResult($value)
    {
        $this->setSelectResult($value);
        return $this;
    }


    /**
     * Checks if SelectResult  is set
     * 
     * @return bool true if SelectResult property is set
     */
    public function isSetSelectResult()
    {
        return !is_null($this->_fields['SelectResult']['FieldValue']);

    }

    /**
     * Gets the value of the ResponseMetadata.
     * 
     * @return ResponseMetadata ResponseMetadata
     */
    public function getResponseMetadata() 
    {
        return $this->_fields['ResponseMetadata']['FieldValue'];
    }

    /**
     * Sets the value of the ResponseMetadata.
     * 
     * @param ResponseMetadata ResponseMetadata
     * @return void
     */
    public function setResponseMetadata($value) 
    {
        $this->_fields['ResponseMetadata']['FieldValue'] = $value;
        return;
    }

    /**
     * Sets the value of the ResponseMetadata  and returns this instance
     * 
     * @param ResponseMetadata $value ResponseMetadata
     * @return Amazon_SimpleDB_Model_SelectResponse instance
     */
    public function withResponseMetadata($value)
    {
        $this->setResponseMetadata($value);
        return $this;
    }


    /**
     * Checks if ResponseMetadata  is set
     * 
     * @return bool true if ResponseMetadata property is set
     */
    public function isSetResponseMetadata()
    {
        return !is_null($this->_fields['ResponseMetadata']['FieldValue']);

    }



    /**
     * XML Representation for this object
     * 
     * @return string XML for this object
     */
    public function toXML() 
    {
        $xml = "";
        $xml .= "<SelectResponse xmlns=\"http://sdb.amazonaws.com/doc/2009-04-15/\">";
        $xml .= $this->_toXMLFragment();
        $xml .= "</SelectResponse>";
        return $xml;
    }

}
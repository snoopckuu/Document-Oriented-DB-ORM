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
 * Amazon_SimpleDB_Model_UpdateCondition
 * 
 * Properties:
 * <ul>
 * 
 * <li>Name: string</li>
 * <li>Value: string</li>
 * <li>Exists: bool</li>
 *
 * </ul>
 */ 
class Amazon_SimpleDB_Model_UpdateCondition extends Amazon_SimpleDB_Model
{


    /**
     * Construct new Amazon_SimpleDB_Model_UpdateCondition
     * 
     * @param mixed $data DOMElement or Associative Array to construct from. 
     * 
     * Valid properties:
     * <ul>
     * 
     * <li>Name: string</li>
     * <li>Value: string</li>
     * <li>Exists: bool</li>
     *
     * </ul>
     */
    public function __construct($data = null)
    {
        $this->_fields = array (
        'Name' => array('FieldValue' => null, 'FieldType' => 'string'),
        'Value' => array('FieldValue' => null, 'FieldType' => 'string'),
        'Exists' => array('FieldValue' => null, 'FieldType' => 'bool'),
        );
        parent::__construct($data);
    }

        /**
     * Gets the value of the Name property.
     * 
     * @return string Name
     */
    public function getName() 
    {
        return $this->_fields['Name']['FieldValue'];
    }

    /**
     * Sets the value of the Name property.
     * 
     * @param string Name
     * @return this instance
     */
    public function setName($value) 
    {
        $this->_fields['Name']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Sets the value of the Name and returns this instance
     * 
     * @param string $value Name
     * @return Amazon_SimpleDB_Model_UpdateCondition instance
     */
    public function withName($value)
    {
        $this->setName($value);
        return $this;
    }


    /**
     * Checks if Name is set
     * 
     * @return bool true if Name  is set
     */
    public function isSetName()
    {
        return !is_null($this->_fields['Name']['FieldValue']);
    }

    /**
     * Gets the value of the Value property.
     * 
     * @return string Value
     */
    public function getValue() 
    {
        return $this->_fields['Value']['FieldValue'];
    }

    /**
     * Sets the value of the Value property.
     * 
     * @param string Value
     * @return this instance
     */
    public function setValue($value) 
    {
        $this->_fields['Value']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Sets the value of the Value and returns this instance
     * 
     * @param string $value Value
     * @return Amazon_SimpleDB_Model_UpdateCondition instance
     */
    public function withValue($value)
    {
        $this->setValue($value);
        return $this;
    }


    /**
     * Checks if Value is set
     * 
     * @return bool true if Value  is set
     */
    public function isSetValue()
    {
        return !is_null($this->_fields['Value']['FieldValue']);
    }

    /**
     * Gets the value of the Exists property.
     * 
     * @return bool Exists
     */
    public function getExists() 
    {
        return $this->_fields['Exists']['FieldValue'];
    }

    /**
     * Sets the value of the Exists property.
     * 
     * @param bool Exists
     * @return this instance
     */
    public function setExists($value) 
    {
        $this->_fields['Exists']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Sets the value of the Exists and returns this instance
     * 
     * @param bool $value Exists
     * @return Amazon_SimpleDB_Model_UpdateCondition instance
     */
    public function withExists($value)
    {
        $this->setExists($value);
        return $this;
    }


    /**
     * Checks if Exists is set
     * 
     * @return bool true if Exists  is set
     */
    public function isSetExists()
    {
        return !is_null($this->_fields['Exists']['FieldValue']);
    }




}
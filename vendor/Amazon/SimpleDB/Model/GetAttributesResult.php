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
 * Amazon_SimpleDB_Model_GetAttributesResult
 * 
 * Properties:
 * <ul>
 * 
 * <li>Attribute: Amazon_SimpleDB_Model_Attribute</li>
 *
 * </ul>
 */ 
class Amazon_SimpleDB_Model_GetAttributesResult extends Amazon_SimpleDB_Model
{


    /**
     * Construct new Amazon_SimpleDB_Model_GetAttributesResult
     * 
     * @param mixed $data DOMElement or Associative Array to construct from. 
     * 
     * Valid properties:
     * <ul>
     * 
     * <li>Attribute: Amazon_SimpleDB_Model_Attribute</li>
     *
     * </ul>
     */
    public function __construct($data = null)
    {
        $this->_fields = array (
        'Attribute' => array('FieldValue' => array(), 'FieldType' => array('Amazon_SimpleDB_Model_Attribute')),
        );
        parent::__construct($data);
    }

        /**
     * Gets the value of the Attribute.
     * 
     * @return array of Attribute Attribute
     */
    public function getAttribute() 
    {
        return $this->_fields['Attribute']['FieldValue'];
    }

    /**
     * Sets the value of the Attribute.
     * 
     * @param mixed Attribute or an array of Attribute Attribute
     * @return this instance
     */
    public function setAttribute($attribute) 
    {
        if (!$this->_isNumericArray($attribute)) {
            $attribute =  array ($attribute);    
        }
        $this->_fields['Attribute']['FieldValue'] = $attribute;
        return $this;
    }


    /**
     * Sets single or multiple values of Attribute list via variable number of arguments. 
     * For example, to set the list with two elements, simply pass two values as arguments to this function
     * <code>withAttribute($attribute1, $attribute2)</code>
     * 
     * @param Attribute  $attributeArgs one or more Attribute
     * @return Amazon_SimpleDB_Model_GetAttributesResult  instance
     */
    public function withAttribute($attributeArgs)
    {
        foreach (func_get_args() as $attribute) {
            $this->_fields['Attribute']['FieldValue'][] = $attribute;
        }
        return $this;
    }   



    /**
     * Checks if Attribute list is non-empty
     * 
     * @return bool true if Attribute list is non-empty
     */
    public function isSetAttribute()
    {
        return count ($this->_fields['Attribute']['FieldValue']) > 0;
    }




}
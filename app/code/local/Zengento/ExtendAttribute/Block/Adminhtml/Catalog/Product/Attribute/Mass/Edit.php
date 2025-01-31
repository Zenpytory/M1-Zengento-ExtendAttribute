<?php
/**
 * @author      Richárd Fülöp <info@zenpytory.com>
 * @copyright   Copyright (c) 2024 Richárd Fülöp
 * @link        https://zenpytory.com
 */

class Zengento_ExtendAttribute_Block_Adminhtml_Catalog_Product_Attribute_Mass_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'zengento_extendattribute';
        $this->_controller = 'adminhtml_catalog_product_attribute_mass';
    }

    public function getHeaderText()
    {
        return Mage::helper('zengento_extendattribute')->__('Mass edit product attributes');
    }

    public function getBackUrl()
    {
        parent::getBackUrl();

        return $this->getUrl('*/catalog_product_attribute/index');
    }
}

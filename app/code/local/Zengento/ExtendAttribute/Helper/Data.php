<?php

class Zengento_ExtendAttribute_Helper_Data extends Mage_Core_Helper_Data
{
    public function getAttributeIds()
    {
        /** @var Mage_Adminhtml_Model_Session $session */
        $session = Mage::getSingleton('adminhtml/session');

        if ($this->_getRequest()->isPost() && strtolower($this->_getRequest()->getActionName()) === 'edit') {
            $session->setAttributeIds($this->_getRequest()->getParam('catalog_product_attribute', null));
        }

        return $session->getAttributeIds();
    }
}

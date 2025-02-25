<?php

class Zengento_ExtendAttribute_Helper_Data extends Mage_Core_Helper_Data
{
    public function getAttributeIds()
    {
        /** @var Mage_Adminhtml_Model_Session $session */
        $session = Mage::getSingleton('adminhtml/session');

        $action_name = strtolower($this->_getRequest()->getActionName());

        if ($this->_getRequest()->isPost() && in_array($action_name, ['edit', 'delete'])) {
            $session->setAttributeIds($this->_getRequest()->getParam('catalog_product_attribute', null));
        }

        return $session->getAttributeIds();
    }
}

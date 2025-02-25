<?php

class Zengento_ExtendAttribute_Adminhtml_Extendattribute_MassController extends Mage_Adminhtml_Controller_Action
{
    public function editAction()
    {
        // save ids from massaction in session
        Mage::helper('zengento_extendattribute')->getAttributeIds();

        $this->_title($this->__('Zengento ExtendAttribute'))->_title($this->__('Mass edit'));

        $this->loadLayout()
        ->_setActiveMenu('catalog/attribute')
        ->_addBreadcrumb($this->__('Attribute'), $this->__('Attribute'))
        ->_addBreadcrumb($this->__('Mass edit'), $this->__('Mass edit'));

        $block = $this->getLayout()->createBlock('zengento_extendattribute/adminhtml_catalog_product_attribute_mass_edit');
        $this->_addContent($block);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $form = $this->getRequest()->getPost('fields');

        if (!$form) {
            $this->_getSession()->addNotice($this->__("You haven't changed anything."));
            return $this->_redirect('*/catalog_product_attribute/');
        }

        try {
            $attribute_ids = Mage::helper('zengento_extendattribute')->getAttributeIds();

            foreach ($attribute_ids as $attribute_id) {
                $attribute = Mage::getModel('catalog/resource_eav_attribute')->load($attribute_id);

                if (!$attribute->getId()) {
                    Mage::throwException('Unknown attribute id: ' . $attribute_id);
                }

                $attribute_name = $attribute->getAttributeCode();

                foreach ($form as $key => $value) {
                    $attribute->setData($key, $value);
                }

                $attribute->save();
            }

            $this->_getSession()->addSuccess(
                $this->__('Total of %d record(s) were updated', count($attribute_ids))
            );
        } catch (Mage_Eav_Model_Entity_Attribute_Exception $e) {
            $this->_getSession()->addError($attribute_name . ': ' . $e->getMessage());
        } catch (Mage_Core_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Throwable $e) {
            Mage::logException($e);
            $this->_getSession()->addError($this->__('An error occurred while updating the attribute(s).'));
        }

        $this->_redirect('*/catalog_product_attribute/');
    }

    public function deleteAction()
    {
        try {
            $attribute_ids = Mage::helper('zengento_extendattribute')->getAttributeIds();

            foreach ($attribute_ids as $attribute_id) {
                $attribute = Mage::getModel('catalog/resource_eav_attribute')->load($attribute_id);

                if (!$attribute->getId()) {
                    Mage::throwException('Unknown attribute id: ' . $attribute_id);
                }

                $attribute_name = $attribute->getAttributeCode();

                $attribute->delete();
            }

            $this->_getSession()->addSuccess(
                $this->__('Total of %d record(s) were deleted', count($attribute_ids))
            );
        } catch (Mage_Eav_Model_Entity_Attribute_Exception $e) {
            $this->_getSession()->addError($attribute_name . ': ' . $e->getMessage());
        } catch (Mage_Core_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Throwable $e) {
            Mage::logException($e);
            $this->_getSession()->addError($this->__('An error occurred while deleting the attribute(s).'));
        }

        $this->_redirect('*/catalog_product_attribute/');
    }
}

<?php
/**
 * @author      Richárd Fülöp <info@zenpytory.com>
 * @copyright   Copyright (c) 2024 Richárd Fülöp
 * @link        https://zenpytory.com
 */

class Zengento_ExtendAttribute_Block_Adminhtml_Catalog_Product_Attribute_Mass_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form([
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save'),
            'method' => 'post',
        ]);

        $form->setUseContainer(true);
        $this->setFields($form);
        $form->setFieldNameSuffix('fields');
        $this->setForm($form);

        return parent::_prepareForm();
    }

    protected function setFields($form)
    {
        $yesnoSource = Mage::getModel('adminhtml/system_config_source_yesno')->toOptionArray();

        $fieldset = $form->addFieldset('general', [
            'legend' => Mage::helper('adminhtml')->__('General'),
            'class' => 'fieldset',
        ]);

        $element = $fieldset->addField('is_searchable', 'select', [
            'name'     => 'is_searchable',
            'label'    => Mage::helper('catalog')->__('Use in Quick Search'),
            'title'    => Mage::helper('catalog')->__('Use in Quick Search'),
            'values'   => $yesnoSource,
        ]);
        $element->setAfterElementHtml($this->_getAdditionalElementHtml($element));

        $element = $fieldset->addField('is_visible_in_advanced_search', 'select', [
            'name' => 'is_visible_in_advanced_search',
            'label' => Mage::helper('catalog')->__('Use in Advanced Search'),
            'title' => Mage::helper('catalog')->__('Use in Advanced Search'),
            'values' => $yesnoSource,
        ]);
        $element->setAfterElementHtml($this->_getAdditionalElementHtml($element));

        $element = $fieldset->addField('is_comparable', 'select', [
            'name' => 'is_comparable',
            'label' => Mage::helper('catalog')->__('Comparable on Front-end'),
            'title' => Mage::helper('catalog')->__('Comparable on Front-end'),
            'values' => $yesnoSource,
        ]);
        $element->setAfterElementHtml($this->_getAdditionalElementHtml($element));

        $element = $fieldset->addField('is_filterable', 'select', [
            'name' => 'is_filterable',
            'label' => Mage::helper('catalog')->__("Use In Layered Navigation"),
            'title' => Mage::helper('catalog')->__('Can be used only with catalog input type Dropdown, Multiple Select and Price'),
            'note' => Mage::helper('catalog')->__('Can be used only with catalog input type Dropdown, Multiple Select and Price'),
            'values' => [
                ['value' => '0', 'label' => Mage::helper('catalog')->__('No')],
                ['value' => '1', 'label' => Mage::helper('catalog')->__('Filterable (with results)')],
                ['value' => '2', 'label' => Mage::helper('catalog')->__('Filterable (no results)')],
            ],
        ]);
        $element->setAfterElementHtml($this->_getAdditionalElementHtml($element));

        $element = $fieldset->addField('is_filterable_in_search', 'select', [
            'name' => 'is_filterable_in_search',
            'label' => Mage::helper('catalog')->__("Use In Search Results Layered Navigation"),
            'title' => Mage::helper('catalog')->__('Can be used only with catalog input type Dropdown, Multiple Select and Price'),
            'note' => Mage::helper('catalog')->__('Can be used only with catalog input type Dropdown, Multiple Select and Price'),
            'values' => $yesnoSource,
        ]);
        $element->setAfterElementHtml($this->_getAdditionalElementHtml($element));

        $element = $fieldset->addField('is_used_for_promo_rules', 'select', [
            'name' => 'is_used_for_promo_rules',
            'label' => Mage::helper('catalog')->__('Use for Promo Rule Conditions'),
            'title' => Mage::helper('catalog')->__('Use for Promo Rule Conditions'),
            'values' => $yesnoSource,
        ]);
        $element->setAfterElementHtml($this->_getAdditionalElementHtml($element));

        $element = $fieldset->addField('position', 'text', [
            'name' => 'position',
            'label' => Mage::helper('catalog')->__('Position'),
            'title' => Mage::helper('catalog')->__('Position in Layered Navigation'),
            'note' => Mage::helper('catalog')->__('Position of attribute in layered navigation block'),
            'class' => 'validate-digits',
        ]);
        $element->setAfterElementHtml($this->_getAdditionalElementHtml($element));

        $element = $fieldset->addField('is_wysiwyg_enabled', 'select', [
            'name' => 'is_wysiwyg_enabled',
            'label' => Mage::helper('catalog')->__('Enable WYSIWYG'),
            'title' => Mage::helper('catalog')->__('Enable WYSIWYG'),
            'values' => $yesnoSource,
        ]);
        $element->setAfterElementHtml($this->_getAdditionalElementHtml($element));

        $element = $htmlAllowed = $fieldset->addField('is_html_allowed_on_front', 'select', [
            'name' => 'is_html_allowed_on_front',
            'label' => Mage::helper('catalog')->__('Allow HTML Tags on Frontend'),
            'title' => Mage::helper('catalog')->__('Allow HTML Tags on Frontend'),
            'values' => $yesnoSource,
        ]);
        $element->setAfterElementHtml($this->_getAdditionalElementHtml($element));

        /*
        if (!$attributeObject->getId() || $attributeObject->getIsWysiwygEnabled()) {
            $attributeObject->setIsHtmlAllowedOnFront(1);
        }
        */

        $element = $fieldset->addField('is_visible_on_front', 'select', [
            'name'      => 'is_visible_on_front',
            'label'     => Mage::helper('catalog')->__('Visible on Product View Page on Front-end'),
            'title'     => Mage::helper('catalog')->__('Visible on Product View Page on Front-end'),
            'values'    => $yesnoSource,
        ]);
        $element->setAfterElementHtml($this->_getAdditionalElementHtml($element));

        $element = $fieldset->addField('used_in_product_listing', 'select', [
            'name'      => 'used_in_product_listing',
            'label'     => Mage::helper('catalog')->__('Used in Product Listing'),
            'title'     => Mage::helper('catalog')->__('Used in Product Listing'),
            'note'      => Mage::helper('catalog')->__('Depends on design theme'),
            'values'    => $yesnoSource,
        ]);
        $element->setAfterElementHtml($this->_getAdditionalElementHtml($element));

        $element = $fieldset->addField('used_for_sort_by', 'select', [
            'name'      => 'used_for_sort_by',
            'label'     => Mage::helper('catalog')->__('Used for Sorting in Product Listing'),
            'title'     => Mage::helper('catalog')->__('Used for Sorting in Product Listing'),
            'note'      => Mage::helper('catalog')->__('Depends on design theme'),
            'values'    => $yesnoSource,
        ]);
        $element->setAfterElementHtml($this->_getAdditionalElementHtml($element));
    }

    /**
     * Custom additional elemnt html
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    protected function _getAdditionalElementHtml($element)
    {
        // Add name attribute to checkboxes that correspond to multiselect elements
        $nameAttributeHtml = ($element->getExtType() === 'multiple') ? 'name="' . $element->getId() . '_checkbox"'
            : '';

        return '<span class="attribute-change-checkbox"><input type="checkbox" id="' . $element->getId()
             . '-checkbox" ' . $nameAttributeHtml . ' onclick="toogleFieldEditMode(this, \'' . $element->getId()
             . '\')" /><label for="' . $element->getId() . '-checkbox">' . Mage::helper('catalog')->__('Change')
             . '</label></span>
                <script type="text/javascript">initDisableFields(\'' . $element->getId() . '\')</script>';
    }
}

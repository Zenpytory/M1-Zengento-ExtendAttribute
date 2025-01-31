<?php

class Zengento_ExtendAttribute_Block_Adminhtml_Catalog_Product_Attribute_Grid extends Mage_Adminhtml_Block_Catalog_Product_Attribute_Grid
{
    protected function _prepareColumns()
    {
        parent::_prepareColumns();

        $this->addColumn('attribute_id', [
            'header' => Mage::helper('adminhtml')->__('Attribute id'),
            'index' => 'attribute_id',
            'filter_index' => 'main_table.attribute_id'
        ]);

        return $this;
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('attribute_id');
        $this->getMassactionBlock()->setFormFieldName('catalog_product_attribute');

        $this->getMassactionBlock()->addItem('mass_edit', [
             'label' => Mage::helper('adminhtml')->__('Edit'),
             'url'  => $this->getUrl('*/extendattribute_mass/edit')
        ]);

        $this->getMassactionBlock()->addItem('mass_delete', [
             'label' => Mage::helper('adminhtml')->__('Delete'),
             'url'  => $this->getUrl('*/extendattribute_mass/delete')
        ]);

        return $this;
    }
}

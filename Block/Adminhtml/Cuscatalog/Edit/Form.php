<?php
namespace MyCompany\ExampleAdminNewPage\Block\Adminhtml\Cuscatalog\Edit;

use \Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('cuscatalog_form');
        $this->setTitle(__('Catalog Information'));
    }

    /**
     * Prepare form
     *
     * @return Generic
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {

        /** @var \Magento\Catalog\Model\Product $model */
        $model = $this->_coreRegistry->registry('cuscatalog_product');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setFieldContainerIdPrefix("cuscatalog_'");

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Add Product'), 'class' => 'fieldset-wide']
        );

        if ($model) {
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        }

        $fieldset->addField(
            'name',
            'text',
            ['name' => 'name', 'label' => __('Product Name'), 'title' => __('Product Name'), 'required' => true]
        );

        $fieldset->addField(
            'sku',
            'text',
            ['name' => 'sku', 'label' => __('Sku '), 'title' => __('SKU '), 'required' => true]
        );

        $fieldset->addField(
            'vpn_number',
            'text',
            ['name' => 'vpn_number', 'label' => __('VPN Number'), 'title' => __('VPN Number'), 'required' => false]
        );

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();


        /** @var \Magento\Catalog\Model\Product\AttributeSet\Options $options */
        $options = $objectManager->create(\Magento\Catalog\Model\Product\AttributeSet\Options::class);



        $fieldset->addField(
            'copy_write_info',
            'text',
            ['name' => 'copy_write_info', 'label' => __('Copy Write Info'), 'title' => __('Copy Write Info'), 'required' => false]
        );

        $fieldset->addField(
            'price',
            'text',
            ['name' => 'price', 'label' => __('Price'), 'title' => __('Price'), 'required' => true]
        );

        $fieldset->addField(
            'attribute_set_id',
            'select',
            [
                'name' => 'attribute_set_id',
                'label' => __('Attribute Set'),
                'title' => __('Attribute Set'),
                'required' => true,
                'values' => $options->toOptionArray()
            ]
        );


        if ($model){
            $form->setValues($model->getData());
        }

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
<?php
namespace MyCompany\ExampleAdminNewPage\Model\ResourceModel\CusCatalog;

use Magento\Catalog\Api\Data\ProductInterface;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'mycompany_exampleadminnewpage_cusproduct_collection';
    protected $_eventObject = 'cusproduct_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Magento\Catalog\Model\Product::class, \Magento\Catalog\Model\ResourceModel\Product::class);
    }




}
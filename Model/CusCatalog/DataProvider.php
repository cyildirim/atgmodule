<?php

namespace MyCompany\ExampleAdminNewPage\Model\CusCatalog;



use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;



class DataProvider extends  AbstractDataProvider
{


    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []

    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection */
        $this->collection  = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\Collection');

    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();


        $this->loadedData = array();
        foreach ($items as $product) {

            $this->loadedData[$product->getId()]['cuscatalog'] = $product->getData();
        }

        return $this->loadedData;
    }


}


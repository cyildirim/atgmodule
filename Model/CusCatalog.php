<?php

namespace MyCompany\ExampleAdminNewPage\Model;


use MyCompany\ExampleAdminNewPage\Api\CusCatalogInterface;

class CusCatalog implements CusCatalogInterface{

    var $publisher;

    /**
     * @param \Rcason\Mq\Api\PublisherInterface $publisher
     */
    public function __construct(
        \Rcason\Mq\Api\PublisherInterface $publisher
    ) {
        $this->publisher = $publisher;
    }

    /**
     * Returns greeting message to user
     *
     * @api
     * @param string $vpnNumber VPN Number.
     * @return array.
     */
    public function getByVPN($vpnNumber)
    {

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection */
        $productCollection  = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\Collection');

        $productCollection->addAttributeToFilter("vpn_number",$vpnNumber,true);

        return $productCollection->getData();
    }

    /**
     *
     * @inheritdoc
     */
    public function updateProduct($entityId, $copyWriteInfo, $vpn)
    {
        $productToUpdate = array(
            "entity_id" => $entityId,
            "copy_write_info" => $copyWriteInfo,
            "vpn_number" => $vpn
        );

        $this->publisher->publish("customcatalog.product.update",json_encode($productToUpdate));

        return true;
    }
}
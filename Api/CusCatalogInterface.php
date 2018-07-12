<?php

namespace MyCompany\ExampleAdminNewPage\Api;

interface CusCatalogInterface
{
    /**
     * Returns greeting message to user
     *
     * @api
     * @param string $vpnNumber VPN Number.
     * @return \Magento\Catalog\Model\Product $productArray ProductList.
     */
    public function getByVPN($vpnNumber);


    /**
     * @api
     * @param int $entityId
     * @param string $copyWriteInfo
     * @param string $vpn
     * @return boolean
     */
    public function updateProduct($entityId,$copyWriteInfo,$vpn);
}
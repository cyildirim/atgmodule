<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MyCompany\ExampleAdminNewPage\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * Eav setup factory
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Init
     * @param CategorySetupFactory $categorySetupFactory
     */
    public function __construct(\Magento\Eav\Setup\EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }


    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {


          $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'vpn_number',
            [
                'group' => 'General',
                'type' => 'varchar',
                'label' => 'VPN Number',
                'input' => 'text',
                'source' => null,
                'frontend' => null,
                'backend' => null,
                'required' => false,
                'sort_order' => 10,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'visible' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true
            ]
        );


        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'copy_write_info',
            [
                'group' => 'General',
                'type' => 'text',
                'label' => 'CopyWriteInfo',
                'input' => 'text',
                'source' => null,
                'frontend' => null,
                'backend' => null,
                'required' => false,
                'sort_order' => 11,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'visible' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true
            ]
        );




    }
}
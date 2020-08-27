<?php
namespace Trezo\Frenet\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'volume_length',
            [
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label'    => 'Comprimento (cm)',
                'input'    => 'text',
                'class' => '',
                'source' => '',
                'global'   => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'visible' => true,
                'required' => true,
                'user_defined' => false,
                'default' => 16,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => true,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'simple,bundle,grouped,configurable',
                'note'     => 'Comprimento da embalagem do produto (Para cálculo de frete, mínimo de 16cm)'
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'volume_height',
            [
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label'    => 'Altura (cm)',
                'global'   => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'input'    => 'text',
                'class' => '',
                'source' => '',
                'default'  => 2,
                'visible' => true,
                'required' => true,
                'user_defined' => false,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => true,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'simple,bundle,grouped,configurable',
                'note'     => 'Altura da embalagem do produto (Para cálculo de frete, mínimo de 2cm)'
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'volume_width',
            [
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label'    => 'Largura (cm)',
                'global'   => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'input'    => 'text',
                'class' => '',
                'source' => '',
                'visible' => true,
                'required' => true,
                'user_defined' => false,
                'default' => 11,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => true,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'simple,bundle,grouped,configurable',
                'note'     => 'Largura da embalagem do produto (Para cálculo de frete, mínimo de 11cm)'
            ]
        );
    }
}

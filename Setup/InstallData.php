<?php

namespace DavidUmoh\Auth0\Setup;

use Magento\Customer\Model\Customer;
use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Setup\CustomerSetup;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{

    const ATTR_CODE = 'gloo_sso_auth0';

    const ATTR_LABEL = 'Auth0 SSO';
    /**
     * Customer setup factory
     *
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * Init
     *
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(\Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory)
    {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        $setup->startSetup();

        // insert attribute
        $customerSetup->addAttribute(
            Customer::ENTITY,
            self::ATTR_CODE,  [
            'label' => self::ATTR_LABEL,
            'type' => 'text',
            'input' => 'text',
            'visible' => true,
            'required' => false,
            'system' => 0,
            'backend'=>'Magento\Eav\Model\Entity\Attribute\Backend\Serialized',
            'note'=>'Stores serialized Auth0 user data'
        ]);

        $MyAttribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, self::ATTR_CODE);

        $MyAttribute->save();

        $setup->endSetup();
    }
}
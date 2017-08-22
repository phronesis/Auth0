<?php
namespace DavidUmoh\Auth0\Block;

use Magento\Framework\View\Element\Template;
use DavidUmoh\Auth0\Helper\Config;

class Auth extends Template{

    /**
     * @var Config
     */
    private $config;

    public function __construct
    (
        Template\Context $context,
        Config $config,
        array $data = []
    )
    {
        $this->config = $config;
        parent::__construct($context, $data);
    }

    /**
     * @see Config::getConfigDataObject()
     * @return \stdClass
     */
    public function getConfigData(){
        return $this->config->getConfigDataObject();
    }

}
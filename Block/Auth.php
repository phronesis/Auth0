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
     * Returns a class of Config options that can be easily json encoded for use in javascript.
     * Currently has the following options:
     * - domain - Auth0 domain
     * - clientId
     * - callbackUrl
     *
     * @return \stdClass
     */
    public function getConfigData(){
        $config = new \stdClass();
        $config->domain = $this->config->getDomain();
        $config->clientId = $this->config->getClientId();
        $config->callbackUrl = $this->config->getCallbackUrl();
        return $config;
    }

}
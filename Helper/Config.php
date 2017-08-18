<?php
namespace DavidUmoh\Auth0\Helper;

use Magento\Framework\App\Helper\AbstractHelper;


class Config extends AbstractHelper{

    const CONFIG_PATH = 'auth0_sso_config/general/';
    const CLIENT_ID = 'client_id';
    const CLIENT_SECRET = 'client_secret';
    const CALLBACK_URL = 'callback_url';
    const AUTH0_DOMAIN = 'domain';

    protected function getModuleConfig($path){
        return $this->scopeConfig->getValue(self::CONFIG_PATH.$path);
    }

    /**
     * Get Auth0 Client Id
     * @return string
     */
    public function getClientId(){
        return $this->getModuleConfig(self::CLIENT_ID);
    }

    /**
     * Get Client Secret
     * @return string
     */
    public function getClientSecret(){
        return $this->getModuleConfig(self::CLIENT_SECRET);
    }

    /**
     * Get Auth0 domain
     * @return string
     */
    public function getDomain(){
        return $this->getModuleConfig(self::AUTH0_DOMAIN);
    }

    /**
     * Get url to be redirected to after authentication
     * @return string
     */
    public function getCallbackUrl(){
        return $this->getModuleConfig(self::CALLBACK_URL);
    }

}
<?php
namespace DavidUmoh\Auth0\Helper;

use Magento\Framework\App\Helper\AbstractHelper;


class Config extends AbstractHelper{

    const CONFIG_PATH = 'auth0_sso_config/general/';
    const CLIENT_ID = 'client_id';
    const CLIENT_SECRET = 'client_secret';
    const CALLBACK_URL = 'callback_url';
    const AUTH0_ACCOUNT = 'account';
    const SILENT_AUTH = 'silent_auth';
    const AUTH_GROUP_ID = "group_id";
    const AUTH_NAME_FORMAT = "name_format";
    const OAUTH_SCOPE = "oauth_scope";
    const AUTH_REDIRECT_URL_LOGIN = "redirect_url_after_login";

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
        return $this->getModuleConfig(self::AUTH0_ACCOUNT).'.auth0.com';
    }

    /**
     * Get Auth0 Group ID
     * @return string
     */
    public function getDefaultGroupID(){
        return $this->getModuleConfig(self::AUTH_GROUP_ID);
    }

    /**
     * Get url to be redirected to after authentication
     * @return string
     */
    public function getCallbackUrl(){
        return $this->getModuleConfig(self::CALLBACK_URL);
    }

    public function getAccount(){
        return $this->getModuleConfig(self::AUTH0_ACCOUNT);
    }
    public function getSilentAuth(){
        return (bool) $this->getModuleConfig(self::SILENT_AUTH);
    }

    public function getNameLocationFormat() {
        return $this->getModuleConfig(self::AUTH_NAME_FORMAT);
    }

    public function getSuccessLoginRedirectURL() {
        return $this->getModuleConfig(self::AUTH_REDIRECT_URL_LOGIN);
    }

    public function getScope() {
        return $this->getModuleConfig(self::OAUTH_SCOPE);
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
    public function getConfigDataObject(){
        $config = new \stdClass();
        $config->domain = $this->getDomain();
        $config->clientId = $this->getClientId();
        $config->callbackUrl = $this->getCallbackUrl();
        $config->silentAuth = $this->getSilentAuth();
        $config->scope = $this->getScope();
        return $config;
    }

}
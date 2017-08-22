<?php
/**
 *
 * This file is part of Magento Auth0
 * Created by dave
 * Copyright © David Umoh. All rights reserved.
 * Check composer.json for license details
 *
 */

namespace DavidUmoh\Auth0\Controller;

use DavidUmoh\Auth0\Helper\Config;
use Gloo\SSO\Controller\Auth;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use \Riskio\OAuth2\Client\Provider\Auth0 as Auth0Client;

abstract class Auth0 extends Auth {


    private $config;
    private $code;
    protected $pageFactory;

    public function __construct
    (
        Context $context,
        Auth0Client $auth0Client,
        Config $config,
        PageFactory $pageFactory
    )
    {
        parent::__construct($context);
        $this->client = $auth0Client;
        $this->config = $config;
        $this->pageFactory = $pageFactory;
        $this->initClient();

    }

    protected function initClient(){
        $this->client->clientId = $this->config->getClientId();
        $this->client->clientSecret = $this->config->getClientSecret();
        $this->client->redirectUri = $this->config->getCallbackUrl();
        $this->client->account = $this->config->getAccount();
    }



}
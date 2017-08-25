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
use DavidUmoh\Auth0\Factory\Auth0ClientFactory;

abstract class Auth0 extends Auth {


    private $config;
    private $code;
    protected $auth0ClientFactory;
    protected $pageFactory;


    public function __construct
    (
        Context $context,
        Auth0ClientFactory $auth0ClientFactory,
        Config $config,
        PageFactory $pageFactory
    )
    {
        parent::__construct($context);
        $this->auth0ClientFactory = $auth0ClientFactory;
        $this->config = $config;
        $this->pageFactory = $pageFactory;
        $this->initClient();
    }

    protected function initClient(){
        $options = [
            'clientId'=>$this->config->getClientId(),
            'clientSecret'=>$this->config->getClientSecret(),
            'redirectUri'=>$this->config->getCallbackUrl(),
            'account'=>$this->config->getAccount()
        ];
        $this->client = $this->auth0ClientFactory->create(['options'=>$options]);
    }



}
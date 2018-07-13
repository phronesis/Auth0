<?php
/**
 *
 * This file is part of Magento Auth0
 * Created by dave
 * Copyright © David Umoh. All rights reserved.
 * Check composer.json for license details
 *
 */

namespace DavidUmoh\Auth0\Block;
use DavidUmoh\Auth0\Helper\Config;
use Riskio\OAuth2\Client\Provider\Auth0 as Auth0Client;


use Magento\Framework\View\Element\Template;

class Index extends Template{

    private $auth0Client;
    private $config;
    private $code;

    public function __construct
    (
        Template\Context $context,
        Auth0Client $auth0Client,
        Config $config,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->auth0Client = $auth0Client;
        $this->config = $config;
        //$this->initClient();
    }



    public function getUserData(){

    }


}
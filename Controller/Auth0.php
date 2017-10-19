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
use Gloo\SSO\Model\AuthInterface;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use Magento\Customer\Model\Account\Redirect;
use Magento\Customer\Model\Data\Customer;
use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\ResourceModel\CustomerRepository;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\PageFactory;
use DavidUmoh\Auth0\Factory\Auth0ClientFactory;
use Riskio\OAuth2\Client\Provider\Auth0ResourceOwner;

abstract class Auth0 extends Auth {

    private $config;
    private $code;
    protected $auth0ClientFactory;
    protected $pageFactory;
    protected $customerFactory;
    protected $customerRepository;

    public function __construct
    (
        Context $context,
        AuthInterface $authModel,
        CustomerFactory $customerFactory,
        CustomerRepository $customerRepository,
        Session $session,
        Redirect $redirect,
        Auth0ClientFactory $auth0ClientFactory,
        Config $config,
        PageFactory $pageFactory
    )
    {
        parent::__construct($context,$authModel,$session,$redirect);
        $this->auth0ClientFactory = $auth0ClientFactory;
        $this->config = $config;
        $this->pageFactory = $pageFactory;
        $this->customerFactory = $customerFactory;
        $this->customerRepository = $customerRepository;
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

    protected function getCustomer(ResourceOwnerInterface $resourceOwner){
        
        try{
          $customer = $this->customerRepository->get($resourceOwner->getEmail()) ;
        }catch (NoSuchEntityException $e){
            $customer = $this->customerFactory->create();
            $customer->setEmail($resourceOwner->getEmail());
            list($firstName,$lastName) = explode(" ",$resourceOwner->getName());
            $customer->setFirstname($firstName);
            $customer->setLastname($lastName);
        }

        return $customer;
    }


}
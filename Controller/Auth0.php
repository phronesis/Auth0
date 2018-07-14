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
use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\ResourceModel\CustomerRepository;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\PageFactory;
use DavidUmoh\Auth0\Factory\Auth0ClientFactory;
use Riskio\OAuth2\Client\Provider\Auth0 as Auth0Client;

abstract class Auth0 extends Auth {

    private $config;
    private $code;
    protected $auth0ClientFactory;
    protected $pageFactory;
    protected $customerFactory;
    protected $customerRepository;
    protected $authorizeParams = [];

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
        if($this->config->getSilentAuth()){
            $this->authorizeParams['prompt'] = 'none';
        }
        $this->client = new Auth0Client($options);
    }

    protected function getCustomer(ResourceOwnerInterface $resourceOwner){

        //After logging in or Creating a new USER, redirect to the appropriate location
        $this->setRedirectURL();
        try{
            $email = $this->getEmail($resourceOwner);
            $customer = $this->customerRepository->get($email) ;
        }catch (NoSuchEntityException $e){
            $newCustomer = $this->customerFactory->create();
            $newCustomer->setEmail($email);
            $name = $this->getName($resourceOwner);
            list($firstName, $lastName) = explode(" ", $name);
            $newCustomer->setFirstname($firstName);
            $newCustomer->setLastname($lastName);
            $newCustomer->setGroupId($this->config->getDefaultGroupID());
            $customer = $newCustomer->getDataModel();
        }

        return $customer;
    }

    protected function getError(){
        return $this->getRequest()->getParam('error');
    }

    protected function getName(ResourceOwnerInterface $resourceOwner) {
        $configValue = $this->config->getNameLocationFormat();
        return $this->getResourceValueByDotNotation($resourceOwner,$configValue);
    }

    protected function getEmail(ResourceOwnerInterface $resourceOwner){
        $configValue = $this->config->getEmailLocationFormat();
        return $this->getResourceValueByDotNotation($resourceOwner,$configValue);
    }

    protected function getResourceValueByDotNotation($resourceOwner, $configValue){
        $format = explode("#", $configValue);
        if(count($format) === 1) {
            return $resourceOwner->toArray()[$format[0]];
        }
        
        $resources = $resourceOwner->toArray();
        
        for ($i = 0; $i < count($format); $i++) {
            if(array_key_exists($format[$i], $resources)) {
                $resources = $resources[$format[$i]];
            }
        }
        return $resources;
    }

    protected function setRedirectURL() {
        $redirectURL = $this->config->getSuccessLoginRedirectURL();
        if(!empty($redirectURL)) {
            $this->redirectUrl = $redirectURL;
        }
    }

}
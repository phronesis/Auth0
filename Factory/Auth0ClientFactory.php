<?php
/**
 *
 * This file is part of DavidUmoh_Auth0
 * Created by dave
 * Copyright © David Umoh. All rights reserved.
 * Check composer.json for license details
 *
 */
namespace DavidUmoh\Auth0\Factory;

class Auth0ClientFactory {

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Instance name to create
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Factory constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Riskio\\OAuth2\\Client\\Provider\\Auth0')
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \Riskio\OAuth2\Client\Provider\Auth0
     */
    public function create(array $data = array())
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
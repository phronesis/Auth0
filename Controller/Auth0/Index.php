<?php
/**
 *
 * This file is part of Magento Auth0
 * Created by dave
 * Copyright © David Umoh. All rights reserved.
 * Check composer.json for license details
 *
 */
namespace DavidUmoh\Auth0\Controller\Auth0;

use DavidUmoh\Auth0\Controller\Auth0;

class Index extends Auth0{

    public function execute()
    {
        try{

            $code = $this->getAccessCode();
            if(is_null($code)){
                $this->getAuthClient()->authorize();
            }
            $userDetails = $this->getAuthClient()
                ->getResourceOwner($this->getAccessToken($code));

            $this->authenticate($this->getCustomer($userDetails));

        }catch (\Exception $e){
            $this->messageManager->addErrorMessage($e->getMessage());
            return $this->pageFactory->create();
        }
    }
}
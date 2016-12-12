<?php

namespace App\GDrive;

class GoogleD {

	private static $_instance;

    private $_client;

    public function __construct()
    {
    	$this->_client = new \Google_Client();
        $this->_client->setClientId(config('services.drive.client_id'));
        $this->_client->setClientSecret(config('services.drive.client_secret'));
        $this->_client->setRedirectUri(config('services.drive.redirect_url'));
        $this->_client->setScopes(explode(',', config('services.drive.scopes')));
        $this->_client->setApprovalPrompt(config('services.drive.approval_prompt'));
        $this->_client->setAccessType(config('services.drive.access_type'));
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance))
        {
            self::$_instance = new GoogleD();
        }
        return self::$_instance;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->_client;
    }

    /**
     * @param mixed $_client
     */
    public function setClient($client)
    {
        $this->_client = $client;
    }

    public function googleDrive()
    {
        $drive = new \Google_Service_Drive(self::getInstance()->getClient());
        return $drive;
    }

}

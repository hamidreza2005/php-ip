<?php
namespace hamidreza2005\phpIp;

use GuzzleHttp\Client as Http;

class Ipapi extends DriverAbstract
{

    const URL = "http://api.ipapi.com/";

    private $API_TOKEN;

    public function __construct($API_TOKEN,$DebugMode=false,$IP = null)
    {
        $this->API_TOKEN = $API_TOKEN;
        $this->setIp($DebugMode,$IP);
        $this->setLocation();
    }

    public function country()
    {
        return $this->location->country_name;
    }

    /**
     * Set Location
     * @return void
     * @throws \Exception
     */
    public function setLocation()
    {
        $client = new Http();
        $response = $client->get(self::URL.$this->ip()."?access_key=".$this->API_TOKEN."&security=1:wq");
        if ($response->getStatusCode() != 200){
            throw new \Exception(json_decode($response->getBody())->error->info);
        }
        $this->location = json_decode($response->getBody());
    }
}

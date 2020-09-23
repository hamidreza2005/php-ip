<?php
namespace hamidreza2005\phpIp;

use GuzzleHttp\Client as Http;

class Geojs extends DriverAbstract
{
    const URL = 'https://get.geojs.io/v1/ip/geo/';

    public function __construct($DebugMode=false,$IP = null)
    {
        $this->setIp($DebugMode,$IP);
        $this->setLocation();
    }
    /**
     * Set Location
     * @return void
     * @throws \Exception
     */
    public function setLocation()
    {
        $client = new Http();
        $response = $client->get(self::URL.$this->ip().'.json');
        if ($response->getStatusCode() !== 200){
            throw new \Exception($response);
        }
        $location = json_decode($response->getBody());

        $this->location = $location;
    }
}

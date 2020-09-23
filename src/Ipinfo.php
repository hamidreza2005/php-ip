<?php
namespace hamidreza2005\phpIp;

use GuzzleHttp\Client as Http;

class Ipinfo extends DriverAbstract
{
    const URL = 'https://www.ipinfo.io/';

    private $API_TOKEN;
    private $JSON_FILE_PATH;

    public function __construct($API_TOKEN,$JSON_FILE_PATH=null,$DebugMode=false,$IP = null)
    {
        $this->API_TOKEN = $API_TOKEN;
        $this->JSON_FILE_PATH = $JSON_FILE_PATH;
        $this->setIp($DebugMode,$IP);
        $this->setLocation();
    }

    public function countryCode()
    {
        return $this->location->country;
    }

    public function coordinates():array
    {
        return explode(',',$this->location->loc);
    }

    public function country()
    {
        if (is_null($this->JSON_FILE_PATH)){
            return $this->countryCode();
        }
        $fullnames = (array) json_decode(file_get_contents($this->JSON_FILE_PATH));
        return $fullnames[$this->countryCode()] ?? $this->countryCode();
    }

    /**
     * Set Location
     * @return void
     * @throws \Exception
     */
    public function setLocation()
    {
        $client = new Http();
        $response = $client->get(static::URL.$this->ip()."?token=".$this->API_TOKEN,[
            "headers"=>["Accept"=>"application/json"]
        ]);
        if ($response->getStatusCode()!= 200){
            throw new \Exception($response->getBody());
        }
        $this->location = json_decode($response->getBody());
    }
}

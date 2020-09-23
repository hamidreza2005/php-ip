<?php
namespace hamidreza2005\phpIp;

use GuzzleHttp\Client as Http;

abstract class DriverAbstract
{
    protected $location;

    protected $ip;

    /**
     * Get Client's Ip
     * @return string
     * @throws \Exception
     */
    public function ip():string
    {
        return $this->ip;
    }

    /**
     * Get all Details about client's location
     */
    public function all()
    {
        return $this->location;
    }

    /**
     * Get client's Coordinates
     * @return array
     */
    public function coordinates():array
    {
        return [$this->location->latitude,$this->location->longitude];
    }

    /**
     * Get client's CountryCode e.g US
     * @return string
     */
    public function countryCode()
    {
        return $this->location->country_code;
    }

    /**
     * Get Client ip if site is in Debug mode.
     * @throws \Exception
     * @return string
     */
    protected function getClientIpInDebugMode(){
        $client = new Http();
        $res = $client->get("https://get.geojs.io/v1/ip.json");
        if ($res->getStatusCode()!= 200){
            throw new \Exception($res->getBody());
        }
        return json_decode($res->getBody())->ip;
    }

    public function country()
    {
        return $this->location->country;
    }

    /**
     * @param bool $DebugMode
     * @param null $IP
     * @throws \Exception
     * @return void
     */
    public function setIp($DebugMode=false,$IP = null):void
    {
        if ($DebugMode){
            $this->ip = $this->getClientIpInDebugMode();
        }else if (!is_null($IP)){
            $this->ip = $IP;
        }else{
            $this->ip = $_SERVER["REMOTE_ADDR"];
        }
    }
}

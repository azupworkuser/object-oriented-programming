<?php

interface iIpChecker
{
    public function __construct($apiKey, $ip);

    public function getIp();
    public function getCity();
    public function getState();
    public function getCountry();
}

class IpChecker implements iIpChecker {

	private $apiKey;
	private $ip;
    private $data;

	public function __construct($apiKey,$ip=null){

        /* Setting the API Key */
        
        $this->setKey($apiKey);
    }

	public function setKey($apiKey){
        
        /* set the API Key array*/
        
		if(!empty($apiKey)) $this->apiKey = $apiKey;
	}

	public function setIp($ip){
        
        /* set the ip address array*/
        
        if(!empty($ip)) $this->ip = $ip;
        $this->data=null;
	}
    
	public function getIp(){

        /* returns the ip address array*/
        
        return $this->ip;
	}
    
    
	public function getCity(){

        /* calling getData to get the city for the given ip addresses in an array*/
        
        return $this->getData("city");
        
    }
    
	public function getState(){

        /* calling getData to get the states for the given ip addresses in an array*/
        
        return $this->getData("state");
        
    }
    
	public function getCountry(){

        /* calling getData to get the countries for the given ip addresses in an array*/
        
        return $this->getData("country");
	}
    
    public function returnData($loc){
    
        /* returning the data from the data variables */
        
        if($loc == "city"){
           return $this->data["cityName"];
        }
        elseif($loc == "state"){
           return $this->data["regionName"]; 
        }
        elseif($loc == "country"){
           return $this->data["countryName"]; 
        }
    }
    
    public function getData($loc){
    
        /* Check if the data is already available */
        
        if(!empty($this->data)){
            return $this->returnData($loc);
        }
        else {
            
            if(filter_var($this->getIp(), FILTER_VALIDATE_IP)){

                /* call the API */  

                $json =  @file_get_contents('http://api.ipinfodb.com/v3/ip-city/?key=' . $this->apiKey . '&ip=' . $this->getIp() . '&format=json');

                if($json){

                    $response = json_decode($json,true);

                    foreach($response as $field=>$value){
                        $result[$field] = $value;
                    }

                }
                else {

                    /* Data not getting return */

                }
            }
            else {

                /* Invalid IP Address error */

            }
            $this->data = $result;
            return $this->returnData($loc);
        }
    }
}
?>
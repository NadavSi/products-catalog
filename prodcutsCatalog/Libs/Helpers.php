<?php

class HelperFunctions {
    public function __construct(){}

    /*
    * function for parsing of url
    * return array of params 
    *   [0] - base url, [1] to [x] - path folders [x+1] - params
    */
    public function getUrl(){
        if(isset($_GET['url'])){
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
        }
    }

    /*
    * function request data from outside source and receives back xml format
    * $url - http url for request
    * return array
    */
    public function xmlRequests($url) {
        try {
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_COOKIE, "username=user;password=pass"); //specific to assingment but can be wrapped with if statement and params can be retreived from config file
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch);
            $xml = simplexml_load_string($data);
            if ($xml === false) {
                throw new Exception(curl_error($ch), curl_errno($ch));
            }
            curl_close($ch);
            return json_decode(json_encode($xml),TRUE);
        } catch (Exception $e) {
            self::debug("error: " . $e->getMessage());
        }
    }

    /*
    * function for debuging
    * $obj - object to be printed on screen
    */
    public function debug($obj) {
        echo '<pre>';
        print_r($obj);
        echo'</pre>';
    }
}
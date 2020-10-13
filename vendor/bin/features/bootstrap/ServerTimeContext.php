<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class KrakenAPIException extends \ErrorException {
    
}

;

class FeatureContext implements Context {

    protected $response;
    protected $curl;    // curl handle

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct() {
        $this->curl = curl_init();

        curl_setopt_array($this->curl, array(
            CURLOPT_SSL_VERIFYPEER => 'true',
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_USERAGENT => 'Kraken PHP API Agent',
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true)
        );
    }

    function __destruct() {
        curl_close($this->curl);
    }

    /**
     * @Given User calls Kraken Public api
     */
    public function userCallsKrakenPublicApi() {

        $url = "https://api.kraken.com/0/public/Time";
        // check if URL is valid or not
        if (!$url || !is_string($url) || !preg_match('/^http(s)?:\/\/[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(\/.*)?$/i', $url)) {
            throw new Exception("Invalid url-> " . $url);
        }
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array());
        $this->response = curl_exec($this->curl);
        $httpcode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        if ($httpcode != 200) {
            throw new Exception("Invalid Response! -> " . $httpcode);
        }
        return true;
    }

    /**
     * @When User request Time from :arg1
     */
    public function userRequestTimeFrom($arg1) {
        curl_setopt($this->curl, CURLOPT_URL, $arg1);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array());
        $this->response = curl_exec($this->curl);
        $httpcode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        if ($httpcode != 200) {
            throw new Exception("Invalid Response! -> " . $httpcode);
        }
        return true;
    }

    /**
     * @Then User should get Time with unixtime 
     */
    public function userShouldGetTimeWithUnixtime() {
        $result = json_decode($this->response, true);

        if (!is_array($result)) {
            throw new KrakenAPIException('JSON decode error');
        }
        $unixtime = $result['result']['unixtime'];

        if ($unixtime === $unixtime && ($unixtime <= PHP_INT_MAX) && ($unixtime >= ~PHP_INT_MAX)) { // check if api returns unix time
            return true;
        } else {
            throw new Exception("Invalid Response! Unix timestamp not found at-> " . $unixtime);
        }
    }

}

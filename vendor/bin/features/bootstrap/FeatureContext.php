<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;

/**
 * Defines application features from the specific context.
 */
class KrakenAPIException extends \ErrorException {
    
};

class FeatureContext implements Context {

    protected $response;
    protected $curl;    // curl handle
    protected $key = 'nO94XLgdKFwfuQY8k+imaCkzO+GaRkKu/mp/JtKdYIpuCRQQ5AQkrq66';
    protected $secret = 'jVUkkzu9+5B/ghBOkFrVmM+cJHH+465ZqLzdgO14w+Bk88/YIhNE9kxwIZXt+eaJwA8L8Zf9a5j3SG92PKp3eg==';

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct() {
        $this->curl = curl_init();
        $this->key = $this->key;
        $this->secret = $this->secret;

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

    /**
     * @When User requests XBT\/USD trading pair from :arg1
     */
    public function userRequestsXbtUsdTradingPairFrom($arg1) {
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
     * @Then User should get List of array
     */
    public function userShouldGetListOfArray() {

        $result = json_decode($this->response, true);
        if (!is_array($result)) { // check if There is any result back?
            throw new KrakenAPIException('JSON decode error');
        } else if (!empty($result['error'])) {
            throw new Exception("Error! as -> " . implode(",", $result['error'])); //kraken api error.
        }

        foreach ($result['result'] as $key => $res) {
            if ($key=='XXBTZUSD'){
                if (!sizeof($res) < 8){
                 return true;
                }
            }
            else{
                throw new Exception("Error in result as no XBT/USD pair found -> " . implode(",", $result['result'])); //
            }
        }
    }
      /**
     * @Given User calls Kraken Private api
     */
      public function userCallsKrakenPrivateApi() {
        $url = "https://api.kraken.com";

        // check if URL is valid or not
        if (!$url || !is_string($url) || !preg_match('/^http(s)?:\/\/[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(\/.*)?$/i', $url)) {
            throw new Exception("Invalid url-> " . $url);
        }
        
        if (!isset($request['nonce'])) {
            // generate a 64 bit nonce using a timestamp at microsecond resolution
            // string functions are used to avoid problems on 32 bit systems
            $nonce = explode(' ', microtime());
            $request['nonce'] = $nonce[1] . str_pad(substr($nonce[0], 2, 6), 6, '0');
        }

        // build the POST data string
        $postdata = http_build_query($request, '', '&');
$version = 0;
        // set API key and sign the message
        $path = '/'.$version.'/private/OpenOrders';
        $sign = hash_hmac('sha512', $path . hash('sha256', $request['nonce'] . $postdata, true), base64_decode($this->secret), true);
        $headers = array(
            'API-Key: ' . $this->key,
            'API-Sign: ' . base64_encode($sign)
        );

        // make request
        curl_setopt($this->curl, CURLOPT_URL, $url );
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
        $this->response = curl_exec($this->curl);
        $httpcode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        if ($httpcode != 200) {
            throw new Exception("Invalid Response! -> " . $httpcode);
        }
        return true;    
        
    }

 

}

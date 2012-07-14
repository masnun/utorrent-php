<?php

require_once 'lib/simple_html_dom.php';

class WebUIAPI
{
    private $rootUrl;
    private $token;
    private $username;
    private $password;
    private $cookieJar = "cookies.txt";

    public function __construct($rootUrl)
    {
        $rootUrl = rtrim($rootUrl, "/");
        $this->rootUrl = $rootUrl;
    }

    public function setLoginCredentials($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function fetchToken()
    {
        $tokenHtml = $this->makeHTTPRequest("/token.html");
        $dom = str_get_html($tokenHtml);
        $tokenDivs = $dom->find("div#token");
        $token = $tokenDivs[0]->text();
        $this->token = $token;

    }

    public function callApi($params)
    {
        if (count($params) > 0)
        {
            $params["token"] = $this->token;
        }

        $finalParams = array();

        foreach ($params as $key => $val)
        {
            $finalParams[] = "{$key}={$val}";
        }

        $path = "/?" . join("&", $finalParams);
        return json_decode($this->makeHTTPRequest($path));

    }

    private function makeHTTPRequest($path)
    {
        $url = $this->rootUrl . $path;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_USERPWD, $this->username . ":" . $this->password);
        curl_setopt($curl, CURLOPT_COOKIEJAR, $this->cookieJar);
        curl_setopt($curl, CURLOPT_COOKIEFILE, $this->cookieJar);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
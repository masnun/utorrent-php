<?php
require_once 'WebUIAPI.php';

// Construct a new API Object
// The URL must include the "gui" part
$webApi = new WebUIAPI("http://localhost:34674/gui/");

// Set the username and password
$webApi->setLoginCredentials("admin", "masnun");

// This call complies with the recent CSRF protection scheme
$webApi->fetchToken();

// Pass the parameters as array
$response = $webApi->callApi(array(
    "list" => 1
));

var_dump($response);
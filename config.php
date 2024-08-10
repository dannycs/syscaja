<?php


//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID | Copiar "ID DE CLIENTE"
$google_client->setClientId('113325378922-18mb6p4bb417cm9uf7eanemfe3h14rka.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI | URL AUTORIZADO
$google_client->setRedirectUri('http://localhost:81/caja/index.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>
<?php

session_start();

//logout.php

include('config.php');

//Reset OAuth access token
$google_client->revokeToken();

session_destroy();

header("location: login.php");

?>
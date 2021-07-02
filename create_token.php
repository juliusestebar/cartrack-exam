<?php

require 'vendor/autoload.php';
require "bootstrap.php";

use Firebase\JWT\JWT;

$key = $_ENV['API_KEY'];
$payload = array(
    "iss" =>  $_ENV['API_URL'],
    "aud" =>  $_ENV['API_URL'],
    "iat" => 1356999524,
    "nbf" => 1357000000
);


$jwt = JWT::encode($payload, $key);
echo json_encode( array(
    'token' => $jwt,
    'expires' => 1357000000
));
//$decoded = JWT::decode($jwt, $key, array('HS256'));

//print_r($jwt);

//print_r($decoded);


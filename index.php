<?php

// Config
$url = "http://dev.liip.ch";
$username = "foo";
$password = "bar";







$getPart = $_SERVER['REQUEST_URI'];
$filename = dirname(__FILE__).'/cache/'.urlencode($getPart);

if (file_exists($filename)) {
    echo file_get_contents($filename);
    die;
}

if (!file_exists(dirname(__FILE__).'/cache')) {
    mkdir(dirname(__FILE__).'/cache');
}

$ch = curl_init( $url.$getPart );

$options = array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERPWD => $username . ":" . $password,
);
curl_setopt_array( $ch, $options );

$result =  curl_exec($ch);
file_put_contents($filename,$result);

echo $result;

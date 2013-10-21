<?php

// Config
$url = "http://dev.liip.ch";
$username = "foo";
$password = "bar";



$headers = apache_request_headers();

$newHeaders = array();
foreach ($headers as $header => $value) {
    $newHeaders[] = "$header: $value";
}

$lang = (isset($headers['Accept-Language'])) ? $headers['Accept-Language'] : 'de';

$getPart = $_SERVER['REQUEST_URI'];
$filename = dirname(__FILE__).'/cache/'.sha1($lang.'_'.urlencode($getPart));

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
curl_setopt($ch,CURLOPT_HTTPHEADER, $newHeaders);
$result =  curl_exec($ch);
file_put_contents($filename,$result);

echo $result;
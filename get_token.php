<?php
$client_id = '789244d326c143f9b6a28ac5c140d22f';
$client_secret = '860315605c4349bcb01b60297f7e1ab5';

// Get token
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Basic ' . base64_encode($client_id . ':' . $client_secret)
));
$response = curl_exec($ch);
curl_close($ch);

$token = json_decode($response)->access_token;
?>

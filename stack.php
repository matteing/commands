<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, "http://api.stackexchange.com/2.2/search?order=desc&sort=activity&intitle=".urlencode($query[1])."&site=stackoverflow");
$result = curl_exec($ch);
curl_close($ch);

echo "http://api.stackexchange.com/2.2/search?order=desc&sort=activity&intitle=".$query[1]."&site=stackoverflow";
$obj = json_decode($result);

print_r($obj);

?>
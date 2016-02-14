<?php

$json = file_get_contents("http://api.stackexchange.com/2.2/search?order=desc&sort=activity&intitle=".urlencode($query[1])."&site=stackoverflow");
$obj = json_decode($json);

print_r($obj);

?>
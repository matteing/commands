<?php

$result=file_get_contents("http://api.stackexchange.com/2.2/search?order=desc&sort=activity&intitle=".urlencode($query[1])."&site=stackoverflow");

$obj = json_decode($result,true);
print_r($obj);

?>
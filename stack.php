<?php

function gzdecoder($d){
    $f=ord(substr($d,3,1));
    $h=10;$e=0;
    if($f&4){
        $e=unpack('v',substr($d,10,2));
        $e=$e[1];$h+=2+$e;
    }
    if($f&8){
        $h=strpos($d,chr(0),$h)+1;
    }
    if($f&16){
        $h=strpos($d,chr(0),$h)+1;
    }
    if($f&2){
        $h+=2;
    }
    $u = gzinflate(substr($d,$h));
    if($u===FALSE){
        $u=$d;
    }
    return $u;
}

if ($query[1]!=""){
	$result=gzdecoder(file_get_contents("http://api.stackexchange.com/2.2/search?order=desc&sort=activity&intitle=".urlencode($query[1])."&site=stackoverflow"));
	$obj = json_decode($result,true);
	//--print_r($obj); //--uncomment for debug
	
	foreach ($obj["items"] as $value){
		if ($value["owner"]["user_type"]=="registered"){
			$tags="";
			foreach ($value["tags"] as $val){
				if ($tags!=""){
					$tags="".$tags.", ".$val[0]."";
				}else{
					$tags="".$val[0]."";
				}
			}
			echo "<div class='result_case'><div style='background:url(\"https://twiicdn.com/imgcache/?url=".urlencode($value["owner"]["profile_image"])."&size=100\");background-size: cover;background-position: 50% 50%;' class='result_image'></div><a href='".$value["link"]."' rel='nofollow'><div class='result_title'>".$value["title"]."</div></a><div class='result_description'>Asked by ".$value["owner"]["display_name"]." ".processtime($value["creation_date"])." ago.</div><div class='result_link'></div></div>";
		}
	}
}else{
	echo "<h2 style='text-align:center;'>We need more info</h2>We can search StackOverflow for you, but we need something to search for";
}

?>
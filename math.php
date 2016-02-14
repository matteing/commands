<?php

//-----Check More Than
preg_match_all("|([0-9]+) more than ([0-9]+)|i",  $query[1], $out,PREG_PATTERN_ORDER);
for ($i=0;$i < count($out[1]);$i++) {
	$var1=$out[1][$i]; $var2=$out[2][$i];
	if ($var1>$var2){
		echo "<h2 style='text-align:center;'>Yes, ".$var1." is more than ".$var2.".</h2>";
	}
	if ($var1<$var2){
		echo "<h2 style='text-align:center;'>Sorry no, ".$var1." is less than ".$var2.".</h2>";
	}
	if ($var1==$var2){
		echo "<h2 style='text-align:center;'>Sorry no, ".$var1." is equal to ".$var2.".</h2>";
	}
}

//-----Check less Than
preg_match_all("|([0-9]+) less than ([0-9]+)|i",  $query[1], $out,PREG_PATTERN_ORDER);
for ($i=0;$i < count($out[1]);$i++) {
	$var1=$out[1][$i]; $var2=$out[2][$i];
	if ($var1<$var2){
		echo "<h2 style='text-align:center;'>Yes ".$var1." is less than ".$var2.".</h2>";
	}
	if ($var1>$var2){
		echo "<h2 style='text-align:center;'>Sorry no, ".$var1." is more than ".$var2.".</h2>";
	}
	if ($var1==$var2){
		echo "<h2 style='text-align:center;'>Sorry no, ".$var1." is equal to ".$var2.".</h2>";
	}
}

//--Math System
$question = $query[1];
$answer = 0;
/*
 Using this regex we can split the string into an array based on the 4 math operators (+,-,/,*). 
 PREG_SPLIT_DELIM_CAPTURE returns the operators as part of the array.
*/
$stack = preg_split('/ *([+\-\/*]) */',$question,-1,PREG_SPLIT_DELIM_CAPTURE);

//The stack array must have a minimum of 3 elements to form a valid math operation: [A] [OPERATOR] [B]
while(sizeof($stack)>=3){
	switch($stack[1]){
		case "+":
			$answer = addition($stack[0], $stack[2]);
			break;
		case "-":
			$answer = subtract($stack[0], $stack[2]);
			break;
		case "*":
			$answer = multiply($stack[0], $stack[2]);
			break;
		case "/":
			$answer = divide($stack[0], $stack[2]);
			break;
	}
	//Remove the first 3 elements from the stack as they have been processed
	$stack = array_slice($stack, 3);
	//Add the current answer total to the beginning of the array for any further processes
	array_unshift($stack, $answer);
}

function addition($val1, $val2){
	return $val1 + $val2;
}

function subtract($val1, $val2){
	return $val1 - $val2;
}

function multiply($val1, $val2){
	return $val1 * $val2;
}

function divide($val1, $val2){
	return $val1 / $val2;
}

if($answer!=0){ echo "<h2 style='text-align:center;'>".$answer."</h2>"; }

?>
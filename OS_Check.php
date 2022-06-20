<?php 


// $formatter = new NumberFormatter('en_US', NumberFormatter::DECIMAL);

$str =  '**+#234324223#xxF**+234324242**+23432';
$str = explode('+', $str)[1];
$final = substr($str, 0, -5);
var_dump($final);
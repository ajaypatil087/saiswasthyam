<?php
$api_key = '45F4E7592348BD';

$api_url = "http://webmsg.smsbharti.com/app/miscapi/".$api_key."/getBalance/true/";

$credit_balance = file_get_contents( $api_url);
echo $credit_balance;
?>
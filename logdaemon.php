<?php
set_time_limit(0);
$server = "";
$user = "";
$pass = "";
$db = "";
$connection = mysql_connect($server, $user, $pass) or die ("Could not connect to server ... \n" . mysql_error ());
mysql_select_db($db) or die ("Could not connect to database ... \n" . mysql_error ());
$f = fopen("http://example.com:20059/api/subscribe?source=chat&username=admin&password=test","r");
while(!feof($f)) {
$output = fread($f,8192);
$arr = json_decode($output,true);
if(isset($arr['data']['message'])) {
$query = mysql_query("INSERT INTO logs (player, message, source, date) VALUES ('".$arr['data']['player']."', '".$arr['data']['message']."', '".$arr['source']."', '".date('r')."')");
}
}
fclose($f);
?>

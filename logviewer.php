<?php
$server = "";
$user = "";
$pass = "";
$db = "";
$connection = mysql_connect($server, $user, $pass) or die ("Could not connect to server ... \n" . mysql_error ());
mysql_select_db($db) or die ("Could not connect to database ... \n" . mysql_error ());
if(isset($_GET['sort'])) {
$query = mysql_query("SELECT * FROM logs ORDER BY ".$_GET['sort']." DESC");
} else {
$query = mysql_query("SELECT * FROM logs ORDER BY id DESC");
}
$num = mysql_num_rows($query);
function plural($num) {
	if ($num != 1)
		return "s";
}

function getRelativeTime($date) {
	$diff = time() - strtotime($date);
	if ($diff<60)
		return $diff . " second" . plural($diff) . " ago";
	$diff = round($diff/60);
	if ($diff<60)
		return $diff . " minute" . plural($diff) . " ago";
	$diff = round($diff/60);
	if ($diff<24)
		return $diff . " hour" . plural($diff) . " ago";
	$diff = round($diff/24);
	if ($diff<7)
		return $diff . " day" . plural($diff) . " ago";
	$diff = round($diff/7);
	if ($diff<4)
		return $diff . " week" . plural($diff) . " ago";
	return "on " . date("F j, Y", strtotime($date));
}
?>
<!DOCTYPE HTML> 
<html> 
	<head> 
		<title>Minecraft Chat Logs</title> 
		<meta http-equiv='refresh' content='60' > 
		<style type='text/css'> 
		body {
		font-family: Helvetica;
		}
			h1 {
				font: bold 24px helvetica, verdana, arial, sans-serif;
				color: #363636;
				text-align:center;
				width: 80%;
				margin-left: 10%;
				margin-right: 10%;
				min-width: 600px;
			}
 
 			a {
 			text-decoration: none;
 			color: #000;
 			}
 			
			table {
				border-collapse: collapse;
				border: 1px solid #666666;
				font: normal 11px helvetica, verdana, arial, sans-serif;
				color: #363636;
				background: #f6f6f6;
				text-align:left;
				width: 80%;
				margin-left: 10%;
				margin-right: 10%;
				min-width: 600px;
			}
 
			thead {
				background: #cfe7fa; /* old browsers */
				background: -moz-linear-gradient(top, #cfe7fa 0%, #6393c1 100%); /* firefox */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#cfe7fa), color-stop(100%,#6393c1)); /* webkit */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cfe7fa', endColorstr='#6393c1',GradientType=0 ); /* ie */
				text-align:left;
				height:30px;
			}
 
			th {
				background-repeat: no-repeat;
				background-position: center right;
				cursor: pointer;
				padding-right: 20px;
			}

 
			tr.odd {
				background: #f1f1f1;
			}
 			tr.odd:hover{background-color: #ccc} 
			td {
				padding:5px;
				border-right: 1px ridge #d2d2d2;
				white-space:nowrap;
			}
 
			th.header {
				background-image:url(data:image/gif;base64,R0lGODlhFQAJAIAAACMtMP///yH5BAEAAAEALAAAAAAVAAkAAAIXjI+AywnaYnhUMoqt3gZXPmVg94yJVQAAOw%3D%3D);
			}
  

		</style> 
	</head> 
	<body> 
		<h1>Minecraft Chat Logs</h1> 

<table>
<thead>
<tr>
<th class="header"><a href="logviewer.php?sort=player">Player</a></th>
<th class="header"><a href="logviewer.php?sort=message">Message</a></th>
<th class="header"><a href="logviewer.php?sort=source">Source</a></th>
<th class="header"><a href="logviewer.php?sort=date">Date</a></th>
</tr>
</thead>
<?php
$i = 0; 
while($arr = mysql_fetch_assoc($query)) {

    if($i % 2) { //this means if there is a remainder
        echo "<tr class='odd'>";
    } else { //if there isn't a remainder we will do the else
        echo "<tr>";
    }
    

echo "<td>".$arr['player']."</td><td>".$arr['message']."</td><td>".$arr['source']."</td><td>".getRelativeTime($arr['date'])."</td></tr>";
$i++;
}
?>
</table>
<center><p><?php echo $num; ?> rows</p></center>
</body>
</html>


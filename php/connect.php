<?php
$username = "smme2013";
$dbname = "smme2013";
$password = "sMMe33#sMMe";

$dbconnect = mysql_connect("localhost", $username, $password) or die ( mysql_error() );
mysql_select_db($dbname, $dbconnect) or die ( mysql_error() );
?>
<?php

require_once('../connect.php');

$process = $_REQUEST['process'];
$id = $_REQUEST['id'];
$emails = $_REQUEST['emails'];

$sql = "ALTER TABLE artists AUTO_INCREMENT = 1";
$result = mysql_query($sql) or die( mysql_error() );

if($process == 'disable')
{
	$sql = "UPDATE artists SET active='0' WHERE id='".$id."'";
	$result = mysql_query($sql) or die( mysql_error() );
	echo "success";
}
if($process == 'enable')
{
	$sql = "UPDATE artists SET active='1' WHERE id='".$id."'";
	$result = mysql_query($sql) or die( mysql_error() );
	echo "success";
}

if($process == 'lock')
{
	$sql = "UPDATE current_artist SET artist_locked='".$id."'";
	$result = mysql_query($sql) or die( mysql_error() );
	echo "success";
}

if($process == 'lockcount')
{
	$sql = "UPDATE current_artist SET artist_locked_total='".$id."'";
	$result = mysql_query($sql) or die( mysql_error() );
	echo "success";
}

if($process == 'add')
{
	if(stripos($emails, ','))
	{
		$_add = explode(',' , $emails);
		
		foreach( $_add as $item )
		{
			$sql = "INSERT INTO artists (email, active) VALUE('".$item."','1')";
			$result = mysql_query($sql) or die( mysql_error() );
		}
		echo "success";		
	} 
	else
	{
	
		$sql = "INSERT INTO artists (email, active) VALUE('".$emails."','1')";
		$result = mysql_query($sql) or die( mysql_error() );
		echo "success";
	}
}
?>
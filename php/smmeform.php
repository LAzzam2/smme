<?php

header("Content-Type: text/html; charset=utf-8");  

require_once('connect.php');

//isset($_GET['nameAddress']) ? $nameAddress = $_REQUEST['nameAddress'] : $nameAddress = '';
//isset($_GET['customOption']) ? $customOption = $_REQUEST['customOption'] : $customOption = '';
//isset($_GET['email']) ? $email = $_REQUEST['email'] : $email = '';
//isset($_GET['message']) ? $message = $_REQUEST['message'] : $message = '';

$name = urldecode($_REQUEST['name']);
$address1 = urldecode($_REQUEST['address1']);
$address2 = urldecode($_REQUEST['address2']);
$address3 = urldecode($_REQUEST['address3']);
$customOption = urldecode($_REQUEST['customOption']);
$email = urldecode($_REQUEST['email']);
$message = urldecode($_REQUEST['message']);


//QUERY FOR EMAIL ADDRESS FIRST
$sql = "SELECT email FROM letters WHERE email='$email'";
$result = mysql_query($sql) or die( mysql_error() );
$user_row = mysql_fetch_assoc( $result );

if($user_row)
{
	//USER EXISTS
	echo 'declined';
	exit();
}
else
{
	$name = mysql_real_escape_string( $name );
	$address1 = mysql_real_escape_string( $address1 );
	$address2 = mysql_real_escape_string( $address2 );
	$address3 = mysql_real_escape_string( $address3 );
	$customOption = mysql_real_escape_string( $customOption );
	$email = mysql_real_escape_string( $email );
	$message = mysql_real_escape_string( $message );
	
	mysql_query("set names 'utf8'");
	$sql = "INSERT INTO letters (name, address1,address2,address3,custom_option,email,message,confirmed) VALUES ('".$name."','".$address1."','".$address2."','".$address3."','".$customOption."','".$email."','".$message."','false')";
	$result = mysql_query($sql) or die( mysql_error() );
	
	$id = mysql_insert_id();
	
	if($id)
	{
		$confirmationURL = "http://snailmailmyemail.org/userConfirmation.php?letterId=".$id;
		
		$msg = "Please click below to confirm your letter request submission to Snail Mail My Email.\n".$confirmationURL;
		
		$headers = "From: confirmation@snailmailmyemail.org\n";
		
		if(	mail( $email, 'Snail Mail My Email Confirmation', $msg, $headers ) )
		{
			echo 'success';
			exit();
		};	
	}
	
	//echo 'success';
	//exit();
}

?>
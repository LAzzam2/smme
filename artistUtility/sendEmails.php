<?php 

	require_once('../connect.php');
	
	$sql = "SELECT * FROM letters WHERE confirmed='true'";
	$result = mysql_query($sql) or die( mysql_error() );
	
	$letters = Array();
	while($row = mysql_fetch_array($result))
	{
	  array_push($letters, $row);
	}	
	
	
	foreach( $letters as $letter)
	{
		$msg = "Hey Volunteers!\n\nWe had some issues with our server/online submission form this morning, which has since been fixed, but some of you may have received letter requests with illegible text/characters. If you did, please reference this email. If not, please disregard.\n\nThe new, legible letter request should be included below. We apologize for the inconvenience and appreciate your flexibility!\n\nBest, \nThe Snail Mail My Email Team\n\n";
		
		$msg .= "Yay! You have a new letter to draw! Thanks again for participating.\n\n************************\nNAME & ADDRESS:\n************************\n".$letter['name']."\n".$letter['address1']."\n".$letter['address2']."\n".$letter['address3']."\n\n"."************************\nCUSTOM OPTION:\n************************\n".$letter['custom_option']."\n\n"."************************\nMESSAGE:\n************************\n".$letter['message']."\n\nNOTE: Please do not reply to this email. If you have a question about a letter request, please contact your organizer.";
		$headers = "From:confirmation@snailmailmyemail.org\n";
			
		if(	mail( $letter['artist'], 'Snail Mail My Email Confirmation', $msg, $headers ) )
		{
			echo '<html><body>'.$msg.'<br></body></html>';	
		};
		
		
	}
	
	
	
?>
<?php

require_once('connect.php');

isset($_GET['letterId']) ? $letterId = $_GET['letterId'] : $letterId = '';


$sql = "SELECT * FROM artists WHERE active='1' ORDER BY id ASC";
$result = mysql_query($sql) or die( mysql_error() );
$count = mysql_num_rows( $result );

$artists = Array();

while($row = mysql_fetch_array($result))
{
  array_push($artists, $row);
}

$sql = "SELECT * FROM letters WHERE id='$letterId'";
$result = mysql_query($sql) or die( mysql_error() );
$letter = mysql_fetch_assoc( $result );


if($letter['confirmed'] == 'true')
{
	echo '<html>
			<body>
			<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=502070146470475";
  fjs.parentNode.insertBefore(js, fjs);
  }(document, "script", "facebook-jssdk"));</script>
				<div style="float:left;width:150px;height:151px;margin:50px;">
					<a href="http://snailmailmyemail.org/"><img src="http://snailmailmyemail.org/images/logo.png" width="150" height="151"></a>
				</div>
				<div style="float:left;margin:50px;width:500px;height:200px;">
				<p style="font-size:24px; font-family:Arial, Helvetica; width:500px; color:#626262;">This email has already been confirmed.<br>Your letter is with an artist now.</p>
					<div class="fb-like" data-href="https://www.facebook.com/snailmailmyemail" data-colorscheme="light" data-layout="standard" data-action="like" data-show-faces="true" data-send="true"></div>
				</div>
			</body>
		</html>';
		exit();
}
if( sizeof($letter) == 1)
{
	echo '<html>
			<body>
				<div style="float:left;width:150px;height:151px;margin:50px;">
					<a href="http://snailmailmyemail.org/"><img src="http://snailmailmyemail.org/images/logo.png" width="150" height="151"></a>
				</div>
				<div style="float:left;margin:50px;width:500px;height:200px;">
					<p style="font-size:24px; font-family:Arial, Helvetica; width:500px; color:#626262;">Sorry, thats not going to work. Please make sure you have copied the link correctly.</p>
				</div>
			</body>
		</html>';
		exit();	
}
else
{
	$sql = "SELECT * FROM current_artist";
	$result = mysql_query($sql) or die( mysql_error() );
	$row = mysql_fetch_assoc( $result );
	
	$lockid = $row["artist_locked"];
	$lockcount = $row["artist_locked_count"];
	$locktotal = $row["artist_locked_total"];
	
	//echo $lockid." > lockid";
	//echo $lockcount." > lockcount";
	//echo $locktotal." > locktotal";
	
	$id = $row['artist_id'];	

	if($lockid > 0 && $lockcount < $locktotal)
	{
		//echo "LOCKED ARTIST >";
		$id = $lockid;
		$sql = "UPDATE current_artist SET artist_locked_count = artist_locked_count + 1";
		$result = mysql_query($sql) or die( mysql_error() );
	}
	else
	{
		//echo "NO LOCKED ARTIST > ";
		
		$sql = "UPDATE current_artist SET artist_locked_count = 0";
		$result = mysql_query($sql) or die( mysql_error() );
		
		$sql = "UPDATE current_artist SET artist_locked = 0";
		$result = mysql_query($sql) or die( mysql_error() );
		
		
		if($id >= $count)
		{
			$id = 1;
		}
		else
		{
			$id++;
		}
	}
	
	//echo "Sending letter to: ";
	//print_r( $artists[$id-1] );
	
	
	$artist = $artists[$id-1];
	
	$sql = "UPDATE current_artist SET artist_id='".$id."'";
	$result = mysql_query($sql) or die( mysql_error() );

	$sql = "UPDATE letters SET confirmed='true' WHERE id='$letterId'";
	$result = mysql_query($sql) or die( mysql_error() );
	
	$sql = "UPDATE letters SET artist='".$artist['email']."' WHERE id='".$letterId."'";
	$result = mysql_query($sql) or die( mysql_error() );
	
		
	$msg = "You have a new letter to write from Snail Mail My Email!\n\n************************\nNAME & ADDRESS:\n************************\n".$letter['name']."\n".$letter['address1']."\n".$letter['address2']."\n".$letter['address3']."\n\n"."************************\nCUSTOM OPTION:\n************************\n".$letter['custom_option']."\n\n"."************************\nMESSAGE:\n************************\n".$letter['message']."\n\nNOTE: Please do not reply to this email. If you have a question about a letter request, please contact your organizer.";
	$headers = "From:confirmation@snailmailmyemail.org\n";
	
	if(	mail( $artist['email'], 'Snail Mail My Email Confirmation', $msg, $headers ) ){  };
	
	echo '<html>
				<body>
				<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=502070146470475";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
				<div style="float:left;width:150px;height:151px;margin:50px;">
					<a href="http://snailmailmyemail.org/"><img src="http://snailmailmyemail.org/images/logo.png" width="150" height="151"></a>				
				</div>
				<div style="float:left;margin:50px;width:500px;height:200px;">
					<p style="float:left;font-size:24px; font-family:Arial, Helvetica; width:500px; color:#626262;">Congratulations, your letter is being processed, handwritten, and sent out! Tell your peeps about Snail Mail My Email.</p>
					<div class="fb-like" data-href="https://www.facebook.com/snailmailmyemail" data-colorscheme="light" data-layout="standard" data-action="like" data-show-faces="true" data-send="true"></div>
				</div>
			</body>';
		echo '</html>';
		exit();
}
		

	
?>
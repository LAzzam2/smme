<html>
	<head>
		<style type="text/css">
			body{
				margin: 50px;				
				}
			#artist-list{
				margin: 50px 0 0 0;
				}	
			#artist-entry{
				margin: 40px 0;
				}
			#artist-list-item{
				width: 900px;
				height: 60px;
				line-height: 60px;
				font-family: Arial, Helvetica;
				margin: 10px 0;
				background: #eaeaea;
				padding: 20px;
				}
			
				#artist-list-item div{
					float: left;
					}
				#artist-email{
					width: 400px;
					}
				#artist-id{
					width: 100px;
					}
				#artist-enabled{
					width: 140px;
					}
				.remove-button{
					float: right;
					width: 140px;
					height: 40px;
					line-height: 40px;
					background: #007c24;
					color: white;
					text-align: center;
					cursor: pointer;
					margin: 10px 0 0 0 ;
					}
					.remove-button.disabled{
						background: #ac0000;
						}	
				#emails{
					width: 500px;
					line-height: 30px;
					font-size: 22px;
					}
				#lockid, #lockcount{
					width: 50px;
					line-height: 30px;
					font-size: 22px;
					}	
					
					
		</style>
		
		<script src="../javascripts/jquery.2.0.3.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function() 
			{
				$("#submit-button").click(function(){ 
					add();					
				});
				
				function add()
				{
					var emails = $("#emails").val();
					var process = 'add';
					
					console.log(emails);
					
					$.post("artist-tool.php",{ emails:emails, process:process }).done(function(data){
					console.log( data );
					
					if(data == "success")
					{
						location.reload(true);
					}
					});
				}
				
				$("#lockcount-button").click(function(){
					lockcount();	
				});
				
				function lockcount( item )
				{
					console.log( item );
					var id= $("#lockcount").val();
					
					$.post("artist-tool.php",{ id:id, process:"lockcount" }).done(function(data){
					console.log( data );
					
					if(data == "success")
					{
						location.reload(true);
					}
					});
				}
				
				$("#lock-button").click(function(){
					lock();	
				});
				
				function lock( item )
				{
					console.log( item );
					var id= $("#lockid").val();
					
					$.post("artist-tool.php",{ id:id, process:"lock" }).done(function(data){
					console.log( data );
					
					if(data == "success")
					{
						location.reload(true);
					}
					});
				}
				
				$(".remove-button").each(function(){
					$(this).click(function(){ process( $(this) ); });
				});
				
				function process( item )
				{
					console.log( item );
					var id= $(item).attr('data-id');
					var process = $(item).attr('data-process');
					
					$.post("artist-tool.php",{ id:id, process:process }).done(function(data){
					console.log( data );
					
					if(data == "success")
					{
						location.reload(true);
					}
					});
				}
			});				
		</script>
		
	</head>
	<body>
		<div id="artist-entry">
			<div id="title">
				Add New Artist. Add multiple emails separated by commas.					
			</div>
			<input type="text" value="" name="emails" id="emails" />
			<input id="submit-button" type="submit" type="button">
		</div>	
		
		<div id="artist-entry">
			<div id="title">
				Send how many emails to:					
			</div>
			<input type="text" value="" name="lockcount" id="lockcount" />
			<input id="lockcount-button" type="submit" type="button">
			<?php 
				require_once('../connect.php');
				$sql2 = "SELECT * FROM current_artist";
				$result2 = mysql_query($sql2) or die( mysql_error() );
				$row = mysql_fetch_assoc( $result2 );
				
				echo '<br><br><div id="locked-id">Current Number: '.$row['artist_locked_total'].'</div>';
			?>
		</div>	
		
		<div id="artist-entry">
			<div id="title">
				This artist id:					
			</div>
			<input type="text" value="" name="lockid" id="lockid" />
			<input id="lock-button" type="submit" type="button">
			<?php 
				require_once('../connect.php');
				$sql2 = "SELECT * FROM current_artist";
				$result2 = mysql_query($sql2) or die( mysql_error() );
				$row = mysql_fetch_assoc( $result2 );
				
				echo '<br><br><div id="locked-id">Current Locked ID: '.$row['artist_locked'].' <br>NOTE: Setting to 0 will cycle through all artists.</div>';
			?>
		</div>	
		
		<div id="artist-list">
			<div id="title">Artist list</div>
			<?php
				require_once('../connect.php');
				$sql = "SELECT * FROM artists";
				$result = mysql_query($sql) or die( mysql_error() );
				
				while( $artist =  mysql_fetch_array( $result ) )
				{
					if($artist['active'] == 1)
					{
						echo '<div id="artist-list-item" class="enabled"><div id="artist-email">EMAIL: '.$artist['email'].'</div><div id="artist-id">ID: '.$artist['id'].'</div><div id="artist-enabled">ACTIVE: '.$artist['active'].'</div>';
						echo '<div class="remove-button enabled" data-process="disable" data-id="'.$artist['id'].'">DISABLE</div>';
						echo '</div>';	
					}
					else
					{
						echo '<div id="artist-list-item" class="disabled"><div id="artist-email">EMAIL: '.$artist['email'].'</div><div id="artist-enabled">ACTIVE: '.$artist['active'].'</div>';
						echo '<div class="remove-button disabled" data-process="enable" data-id="'.$artist['id'].'">ENABLE</div>';
						echo '</div>';	
					}
					
				}
					
			?>			
		</div>
		
	</body>
</html>



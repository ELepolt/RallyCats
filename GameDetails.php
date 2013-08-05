<?php 
	include 'Controls/init.php'; 
	
	$gameID = $_GET['gid'];
	
	$result = GetGame_ID($gameID);					// Get the details of the game
	while ($rows = mysql_fetch_array($result))
	{
		$gameType = $rows['GameTypeFull'];
		$gameTime = $rows['GameTime'];
		$opponent = $rows['Opponent'];
		$homeAway = $rows['HomeAway'];
		$gameDate = $rows['GameDate'];
	}
?>









<html>
<head>
	<link rel="stylesheet" type="text/css" href="StyleSheets/GameDetails.css" />
	<script type="text/javascript">
		$(function() {
	  		$('.nyroModal').nyroModal();
		});
		
		function closeWin(){
			
		}
	</script>
</head>
<body style="position:relative">
	<table>
		<thead><tr><td colspan="2"><h2 class="center"><?php echo $gameType.' ('.HomeAway($homeAway).')'; ?></h2></td></tr></thead>
		<tr>
			<td class="left">Game Time:</td>
			<td><?php echo $gameTime.' '.$gameDate; ?></td>
		</tr>
		<tr>
			<td class="left">Opponent:</td>
			<td><?php echo $opponent; ?></td>
		</tr>
		<tr>
			<td class="left">Notes:</td>
			<td><?php echo ''; ?></td>
		</tr>
		
		<tr>
			<td colspan="2">
				<a target="_blank" href="https://www.google.com/calendar/embed?src=h5096ummauq621nso94014ik2g%40group.calendar.google.com&ctz=America/New_York"
				   class="gCalButton">
				</a>
			</td>
		</tr>
	</table> 
</body>
</html>
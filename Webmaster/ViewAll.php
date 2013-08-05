<html>
<head>
	<link rel="stylesheet" type="text/css" href="global.css" />
</head>

<body>
<?php 


include '../Controls/init.php';
if(!logged_In())
{
	header('location: login.php');
	exit();
}

	$sport =  $_GET['sport'];
	$view =  $_GET['view'];
	
	if ($sport == null)
		$sport = -1;
	if ($view == null)
		$view = -1;
?>
	<div>View All Games</div>
	<div class="VPCommLinks">
		<a href="ViewAll.php">View All</a>
		<a href="Update.php">Update</a>
		<a href="default.php">Home Page</a>
	</div>
	<?php include '../Controls/WebControls/SportViewSelector.php'; ?>
<?php


$result = GetSeasonData($sport, $view);
?>
<table class="standard">
	<tr>
		<th>Opponent</th>
		<th>Time</th>
		<th>Date</th>
		<th>Result</th>
	</tr>
	
<?php 
//This is the while loop.
while ($rows = mysql_fetch_array($result))
{
    $GameType = GetGameType($rows['GameType']);
	$_gameType = $rows['GameType'];
    $HomeAway = $rows['HomeAway'];
    $Opponent = $rows['Opponent'];
    $GameTime = $rows['GameTime'];
    $GameDate = $rows['GameDate'];
	$UCScore = $rows['UCScore'];
	$OppScore = $rows['OppScore'];
?>
	<tr class="<?php echo SetClass($_gameType) ?>" title="<?php echo HomeAway($HomeAway);?>">
		<td><?php echo $Opponent; ?></td>
		<td><?php echo $GameTime; ?></td>
		<td><?php echo $GameDate; ?></td>
		<td><?php echo WinLose($UCScore, $OppScore); ?></td>
	</tr>
<?php 
} //While loop ends here. ?>
</table>


</body>
</html>

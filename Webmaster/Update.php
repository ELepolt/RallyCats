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
<p>When you hit 'Submit,' you will not see updated scores until you refresh the page.</p>
<form action="" method="post">
<table class="standard">
	<tr>
		<th>Opponent</th>
		<th>Time</th>
		<th>Date</th>
		<th>UC Score</th>
		<th>Opp Score</th>
		<th>Update?</th>
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
	$maxGameID = ($GameID > $rows['GameID']) ? $GameID : $maxGameID;
	$GameID = $rows['GameID'];
	
	//Name the text inputs
	$UCScore_Name = "UC".$GameID;
	$OppScore_Name = "Opp".$GameID;
	$GameTime_Name = "Time".$GameID;
	$Update_Name = "Update".$GameID;
?>
	<tr class="<?php echo SetClass($_gameType) ?>" title="<?php echo HomeAway($HomeAway);?>">
		<td><?php echo $Opponent; ?></td>
		<td><input type="text" name="<?echo $GameTime_Name;?>" value="<?php echo $GameTime; ?>"</td>
		<td><?php echo $GameDate; ?></td>
		<td><input type="text" name="<?echo $UCScore_Name;?>" value="<?php echo $UCScore; ?>"></td>
		<td><input type="text" name="<?echo $OppScore_Name;?>" value="<?php echo $OppScore; ?>"></td>
		<td><input type="checkbox" name="<?echo $Update_Name;?>" value="update"/></td>
	</tr>
	<tr>
		<td><input type="hidden" name="MaxGameID" value="<?php echo $maxGameID;?>" /></td>
	</tr>
<?php 
} //While loop ends here. */?>
	</table>
	<input type="submit" value="Submit" />
</form>

<?php
//echo $maxGameID."<br />";
$i = 0;
while ($i < $maxGameID)
{
	$i++;
	
	if (isset($_POST["Update".$i]))
	{
		$GameID = $i;
		$UCScore_Name = "UC".$GameID;
		$OppScore_Name = "Opp".$GameID;
		$GameTime_Name = "Time".$GameID;
		if (isset($_POST[$UCScore_Name], $_POST[$OppScore_Name]))
		{
			$UCScore = $_POST[$UCScore_Name];
			$OppScore = $_POST[$OppScore_Name];
			
			if (!empty($UCScore) && !empty($OppScore))
			{
				UpdateScore($UCScore, $OppScore, $GameID);
			}
		}
		if (isset($_POST[$GameTime_Name]))
		{
			echo "<br />";
			$GameTime = $_POST[$GameTime_Name];
			if (!empty($GameTime))
			{	
				UpdateGameTime($GameTime, $GameID);
			}
		}
	} 	
}

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{
	header('Location: Update.php');
	exit;
}  

?>
</body>
</html>

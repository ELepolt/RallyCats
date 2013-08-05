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
?>


	<div>Yearly Top Point Getters</div>
	<?php include '../WebControls/WebmasterNav.php'; ?>
	
<?php
	$result = GetYearlyTopPointGetters();
?>
<p>When you hit 'Submit,' you will not see updated top point getters until you refresh the page.</p>
<form action="" method="post">
<table class="standard">
	<tr>
		<th>Rank</th>
		<th>Name</th>
		<th>Points</th>
		<th>Update</th>
	</tr>
	
<?php 

$id = 0;
//This is the while loop.
while ($rows = mysql_fetch_array($result))
{
	$id++;
 	$Name = $rows['Name'];
 	$Points = $rows['Points'];
    
    //Name the text inputs
	$TPG_Name = "Name".$id;
	$TPG_Points = "Points".$id;
	$Update_Name = "Update".$id;
?>
	<tr class="<?php echo SetClass($_gameType) ?>" title="<?php echo HomeAway($HomeAway);?>">
		<td><?php echo $id; ?></td>
		<td><input type="text" name="<?echo $TPG_Name;?>" value="<?php echo $Name; ?>"</td>
		<td><input type="text" name="<?echo $TPG_Points;?>" value="<?php echo $Points; ?>"</td>
		<td><input type="checkbox" name="<?echo $Update_Name;?>" value="update"/></td>
	</tr>
<?php 
} //While loop ends here. */?>
	</table>
	<input type="submit" value="Submit" />
</form>

<?php
//echo $maxGameID."<br />";
$i = 0;
while ($i < $id)
{
	$i++;
	
	if (isset($_POST["Update".$i]))
	{
		$id = $i;
		$TPG_Name = "Name".$id;
		$TPG_Points = "Points".$id;
		
		$Name = $_POST[$TPG_Name];
		$Points = $_POST[$TPG_Points];
			
		UpdateWeeklyTPG($Name, $Points, $id);
	} 	
}

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{
	header('Location: YearlyTopPointGetters.php');
	exit;
}  

?>
</body>
</html>


function UpdateWeeklyTPG($Name, $id)
{
	$SQL = "UPDATE `Schedule_Data` 
			SET `Name`=".$Name.", 
				`Points`=".$Points.",
			WHERE `Schedule_Data`.`ID` = ".$id;
	mysql_query($SQL);
}
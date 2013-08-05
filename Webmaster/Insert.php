<html>
<body>
<?php


//Detects end of line if reading a file from mac/unix.
ini_set('auto_detect_line_endings',true);

include '../Controls/init.php';
if(!logged_In())
{
	header('location: login.php');
	exit();
}

//Delete last years information.
$pastSQL = "SELECT MAX(GameID) as MaxGameID FROM `Schedule_Data`";
$result = mysql_query($pastSQL,$con);

while($row = mysql_fetch_array($result))
  {
	$maxGameID = $row['MaxGameID'];
  }

if ($maxGameID != "0" || $maxGameID != null)
{
  for ($d="1";$d<=$maxGameID;$d++)
  {
    $delSQL = "DELETE FROM `group_rallycats`.`Schedule_Data` WHERE `Schedule_Data`.`GameID` = $d";
    mysql_query($delSQL,$con);
  }
}

//Opens file to insert data.

$filename = "../Schedules/FullSchedule.csv";
$file = fopen ($filename, "r");
$delim = ",";
$i = 0;
$errors = 0;
while(!feof($file))
{
  $i++;
  $contents = fgets($file);
  $splitContents = explode($delim, $contents);

  $format = "Y/m/d";
  $fullTime = strtotime($splitContents[0]);
  $GameDate = date($format, $fullTime);

  $GameTime = $splitContents[1];
  if ($GameTime == "TBA" || $GameTime == "TBD")
  {
	$GameTime = "NULL";
  }
  $Opponent = $splitContents[2];
  $HomeAway = $splitContents[3];
  $GameType = $splitContents[4];
  $UCScore = $splitContents[5];// != null ? $splitContents[5] : null);
  $OppScore = $splitContents[6];// != null ? $splitContents[6] : null);
  $Notes = ''.$splitContents[7];// != null ? $splitContents[7] : null);
  
  $sql = "INSERT INTO `group_rallycats`.`Schedule_Data` (`GameID`,
  														   `GameType`, 
  														   `HomeAway`, 
  														   `Opponent`, 
  														   `GameTime`, 
  														   `GameDate`,
  														   `UCScore`,
  														   `OppScore`,
  														   `Notes`) 
  												   VALUES ('$i', 
  												   		  '$GameType', 
  												   		  '$HomeAway', 
  												   		  '$Opponent', 
  												   		  '$GameTime', 
  												   		  '$GameDate',
  												   		  '$UCScore',
  												   		  '$OppScore',
  												   		  '$Notes')";
 
if (!mysql_query($sql,$con))
  {
    echo "There was a failure with $Opponent. <br />";
	$errors++;
  }
}

if($errors > 0)
{
?>
	<div>
		<p>If there were any failures, go back and check all your data in the excel sheet.</p>
		<ul><li>Check to make sure any apostrophies have a '\' in front of it (ie St. John\'s)</li>
		<li>Check to see if you have any text where numbers should be.</li></ul>
	</div>
	
<?php		
}
?>
	<div>
		<a href="ViewAll.php">View All Games</a>
	</div>
<?php
fclose($file);

mysql_close($con);
?>
</body>
</html>

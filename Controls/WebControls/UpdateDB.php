<!DOCTYPE html 
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">

<body>
  
<?php
include 'init.php';

//Delete all the data
$SQL = "DELETE FROM `TSchedule_Data`";
mysql_query($SQL);

//All the data!
//http://www.gobearcats.com/data/cinn-event-info-2012.xml

	/*
	$URL = "http://www.gobearcats.com/data/cinn-event-info-2012.xml";
	$xml = simplexml_load_file($URL,'SimpleXMLElement', LIBXML_NOCDATA);
	
	foreach($xml->children() as $event)
	{
		$gameID = 0;
		$gameType = 0;
		$gameHomeAway = "";
		$gameHomeAway = "";
		$gameOpponent = "";
		$gameTime = "";
		$gameDate = "";
	
		$gameID = $event->attributes()->id."<br />";
		foreach($event->children() as $gameInfo)
		{
			$childName = $gameInfo->getName();
			switch($childName)
			{
				case "event_date":
					$gameDate = date_format($gameInfo, "Y-m-d");
					break;
				case "home_visitor":
					$gameHomeAway = $gameInfo;
					break;
				case "opponent":
					$gameOpponent = $gameInfo;
					break;
				case "time":
					$gameTime = $gameInfo;
					break;
				case "sport_abbr_name":
					$gameType = $gameInfo;
					break;
				default:
					break;
			}
		}
		$sql = "INSERT INTO `TSchedule_Data` 
					(
						`GameID`,
						`GameType`,
						`HomeAway`,
						`Opponent`,
						`GameTime`,
						`GameDate`
					)
					values(
						'".$gameID."',
						'".$gameType."',
						'".$gameHomeAway."',
						'".$gameOpponent."',
						'".$gameTime."',
						'".$gameDate."'
					)";
		echo mysql_real_escape_string($sql)."<br>";
		mysql_query($sql);
	}
	
	
	//$event = $xml->event[0];
	//echo $event->opponent;
	?>
	*/

	$date = date(now)
	echo $date;
	?>

	</body>
</html>
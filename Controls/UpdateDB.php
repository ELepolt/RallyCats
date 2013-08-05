<?php
$con = mysql_connect("localhost","group_rallycats","db4rc@uc");
$conDB = mysql_select_db("group_rallycats");

//include 'init.php';

//Delete all the data
$SQL = "DELETE FROM `Schedule_Data`";
mysql_query($SQL);

//All the data!
//http://www.gobearcats.com/data/cinn-event-info-2013.xml

	
	$URL = "http://www.gobearcats.com/data/cinn-event-info-2013.xml";
	$xml = simplexml_load_file($URL,'SimpleXMLElement', LIBXML_NOCDATA);
	
	foreach($xml->children() as $event)
	{
		$gameID = 0;
		$gameType = "";
		$gameTypeFull = "";
		$gameHomeAway = "";
		$gameHomeAway = "";
		$gameOpponent = "";
		$gameLocation = "";
		$gameTime = "";
		$gameDate = date("Y-m-d", mktime(0,0,0,0,0,0));
	
		$gameID = $event->attributes()->id."<br />";
		foreach($event->children() as $gameInfo)
		{
			$childName = $gameInfo->getName();
			switch($childName)
			{
				case "event_date":
					$gameDate = date("Y-m-d", strtotime($gameInfo));
					break;
				case "home_visitor":
					$gameHomeAway = $gameInfo;
					break;
				case "opponent":
					$gameOpponent = $gameInfo;
					break;
				case "location":
					$gameLocation = $gameInfo;
					break;
				case "time":
					$gameTime = $gameInfo;
					break;
				case "sport_abbr_name":
					$gameType = $gameInfo;
					break;
				case "sport_fullname";
					$gameTypeFull = $gameInfo;
					break;
				default:
					break;
			}
		}
		$sql = "INSERT INTO `Schedule_Data` 
					(
						`GameID`,
						`GameType`,
						`GameTypeFull`,
						`HomeAway`,
						`Opponent`,
						`Location`,
						`GameTime`,
						`GameDate`,
						`Test`
					)
					values(
						'".$gameID."',
						'".$gameType."',
						'".addslashes($gameTypeFull)."',
						'".$gameHomeAway."',
						'".addslashes($gameOpponent)."',
						'".addslashes($gameLocation)."',
						'".$gameTime."',
						'".$gameDate."',
						'".date("Y-m-d h:i:s")."'
					)";
		$insert = mysql_query($sql);
		if(!$insert)
		{
			echo $sql."<br />"; 
			$failure = $failure."GameID ".$gameID."<br />";
			$failure = $failure."GameType ".$gameType."<br />";
			$failure = $failure."GameTypeFull ".$gameTypeFull."<br />";
			$failure = $failure."HomeAway ".$gameHomeAway."<br />";
			$failure = $failure."Opponent ".$gameOpponent."<br />";
			$failure = $failure."Location ".$gameLocation."<br />";
			$failure = $failure."GameTime ".$gameTime."<br />";
			$failure = $failure."GameDate ".$gameDate;
			$failure = $failure."<br /><br />";
			echo $failure;
			$failure = "";
		}
	}
	?>


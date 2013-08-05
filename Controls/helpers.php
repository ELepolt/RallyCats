<?php
//Used for webmaster log in
function logged_In()
{
	//TODO this is not working.
	return true;// isset($_SESSION['user_id']);
}

//Changes H to Home, V to Visitor
function HomeAway($HomeAway)
{
	switch($HomeAway)
	{
		case "H":
			$HomeAway = "Home";
			break;
		case "V":
			$HomeAway = "Visitor";
			break;
            case "T":
                  $HomeAway = "Neutral";
                  break;
	}
	return $HomeAway;
}

//Looks like it's used for the scoop of the week control
function GetDay($addDays)
{
	$day  = mktime(0, 0, 0, date("m")  , date("d")+$addDays, date("Y"));
	
	return $day;
}
function GetMonthName($month)
{
	$monthName = '';
	switch($_gameType)
    	{
      		case 1:
      			$monthName = "MBB";
      			break;
      		case 2:
				$monthName = "Baseball";
      			break;
      		case 3:
      			$monthName = "Volleyball";
      			break;
      		case 4:
      			$monthName = "MSoccer";
      			break;
      		case 5:
      			$monthName = "WSoccer";
      			break;
      		case 6:
      			$monthName = "Football";
      			break;
      		case 7:
      			$monthName = "MBB";
      			break;
      		case 8:
      			$monthName = "MBB";
      			break;
      		case 9:
      			$monthName = "MBB";
      			break;
      		case 10:
      			$monthName = "MBB";
      			break;
      		case 11:
      			$monthName = "MBB";
      			break;
      		case 12:
      			$monthName = "MBB";
      			break;
    	}
}

//Compares UCScore to OppScore to determine win or loss
function WinLose($UC, $Opp)
{
	if ($UC == "" || $Opp == "")
		return "";
	elseif ($UC > $Opp)
		return "W: ".$UC." - ".$Opp;
	else
		return "L: ".$UC." - ".$Opp;
}

?>
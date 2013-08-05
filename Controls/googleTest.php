<?php
/********************************************************************
*							Contstants								*
********************************************************************/
$CalendarID = "h5096ummauq621nso94014ik2g@group.calendar.google.com";

/*******************************************************************/



require_once "googleApi/src/Google_Client.php";
require_once "googleApi/src/contrib/Google_CalendarService.php";

session_start();

$client = new Google_Client();

$client->setApplicationName("Google Calendar PHP Starter Application");

// Visit https://code.google.com/apis/console?api=calendar to generate your
// client id, client secret, and to register your redirect uri.
$client->setClientId('1005293494524.apps.googleusercontent.com');
$client->setClientSecret('bygH_-_l3sPO9XWQPUpIWU4O');
$client->setRedirectUri('http://www.UCRallyCats.com/callback.php');
$client->setDeveloperKey('AIzaSyA_9ZWhZsQfijIPE8M0MLW6HfHbmaFsJgI');
$cal = new Google_CalendarService($client);

if (isset($_GET['logout'])) {
  unset($_SESSION['token']);
}

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

if ($client->getAccessToken()) {
	
	//Calendar ID
	$calendar = $cal->calendars->get($CalendarID);
	echo "Calendar ID: " . $calendar["id"] . "<br />";

	//Delete all the events currently in the calendar.
	$events = $cal->events->listEvents($CalendarID);
  
  	echo "<pre>";
  	echo var_dump($events);
  	echo "</pre>";
  	
  	var_dump($events["items"]);
  	echo $events["nextPageToken"];
  	 
  	//Cycle through and delete events
  	while(true) {
  		foreach ($events["items"] as $event) {
      		echo "I'm an item! <br />";
      		try{
        		//Deletes the event
        		$cal->events->delete($CalendarID, $event["id"]);
      		}
      		catch(Exception $e){
        		echo "Error deleting event. <br />";
        	}
    	}
    
    	$pageToken = $events->getNextPageToken();
    	if ($pageToken) {
      		$optParams = array('pageToken' => $pageToken);
  	    	$events = $service->events->listEvents($CalendarID, $optParams);
  	  	}
  		else { break; }
  	}

	//UTC offset
	$UTCOffsetValue = intval(date('Z')/60/60);
	if ($UTCOffsetValue < 0)
	{
		$UTCOffset = "-0".abs($UTCOffsetValue). ":00";
	}
	else
	{
		$UTCOffset = "+0".abs($UTCOffsetValue). ":00";
	}
	//Connect to DB
	$con = mysql_connect("localhost","group_rallycats","db4rc@uc");
	$conDB = mysql_select_db("group_rallycats");

	//Select All Events and add to calendar
	$SQL = "SELECT * FROM `Schedule_Data` WHERE GameID > 2000000";
	$result = mysql_query($SQL);
	while ($rows = mysql_fetch_array($result))
	{
		//echo $rows["GameTypeFull"]." vs ".$rows["Opponent"]."<br />";
	
		$event = new Google_Event();						//Create new event
		$event->setSummary($rows["GameTypeFull"]." vs. ".$rows["Opponent"]);			//Set summary (GameTypeFull)
		$event->setLocation($rows["Location"]);				//Set location (Location)
		$event->setAttendees = array();
		/*Create start/end time
			If there is no time: setDate('YYYY-mm-dd')
			Else setDateTime('YYYY-mm-ddThh:mm:ss.nnn-utcHoffset:00);
		*/
		
		$start = new Google_EventDateTime();
		$end = new Google_EventDateTime();
		
		$gameTime = $rows["GameTime"];
		if($gameTime != "All Day" && $gameTime != "TBA")
		{
			$AMPMExplode = explode(" ", $gameTime);// substr($gameTime, strlen($gameTime-2));	//Parse AMPM
			$AMPM = $AMPMExplode[1];
			$gameTime = substr($gameTime, 0, strlen($gameTime)-3);				//Get rid of PM/AM
			
			//Convert to 24 hour clock
			if ($AMPM == "PM")
			{
				//Explode to get hours and minutes
				//$hours = explode(":",$gameTime)[0];
				$hoursMinutes = explode(":",$gameTime);
				$hours = $hoursMinutes[0];
				$minutes = $hoursMinutes[1];
				
				if ($hours != 12)
				{
					//Add 12 to hours.
					$starthours = intval($hours) + 12;
					$endHours = intval($hours) + 13;
				}
			}
			//Put that shit back together with UTC Offset
			$startGameTime = $starthours.":".$minutes.":00.000";
			$endGameTime = $endHours.":".$minutes.":00.000";
			$startGameTime = $startGameTime.$UTCOffset;
			$endGameTime = $endGameTime.$UTCOffset;
			
			//Add date and "T"
			$gameDate = $rows["GameDate"];
			$startGameTime = $gameDate."T".$startGameTime;								//Build dateTime
			$endGameTime = $gameDate."T".$endGameTime;
			
			$start->setDateTime($startGameTime);
			$end->setDateTime($endGameTime);
			
			$event->setStart($start);
			$event->setEnd($end);
			$array = array(); //Empty array for optParams
			
		//echo "<br />".$gameDate;
		//echo "<br />".$startGameTime;
		//echo "<br />".$endGameTime;
			
		}
		else
		{
			//If there is no time: setDate('YYYY-mm-dd')
			$gameDate = $rows["GameDate"];
			$start->setDate($gameDate);
			$end->setDate($gameDate);
			
			$event->setStart($start);
			$event->setEnd($end);
			$array = array(); //Empty array for optParams
		}
		
		
		try{
		  //$createdEvent = $cal->events->insert($CalendarID, $event, $array);
		  //echo "<br />" . $createdEvent["id"];
		}
		catch(Exception $e){
			echo "<pre>";
			var_dump($event);
			echo "</pre>";
			
			echo "<pre>";
			//var_dump($test);
			echo "</pre>";
			
			echo $e->getMessage();
		}
	}
	
	
	
		
  	$_SESSION['token'] = $client->getAccessToken();
} 
else {
  $authUrl = $client->createAuthUrl();
  
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}






echo "<br />End<br />";

?>

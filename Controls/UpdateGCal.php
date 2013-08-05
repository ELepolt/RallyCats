<?php



/***************************************************
*		Constants			   *
***************************************************/
$CalendarID = "h5096ummauq621nso94014ik2g@group.calendar.google.com";


/**************************************************/





//All the data!
//http://www.gobearcats.com/data/cinn-event-info-2012.xml
	

//Get the google Api sources
require_once "googleApi/src/Google_Client.php";
require_once "googleApi/src/contrib/Google_CalendarService.php";

session_start();

$client = new Google_Client();

$client->setApplicationName("Google Calendar PHP Starter Application");

//Set client info
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

//This is where you do shit.
if ($client->getAccessToken()) {
  $calendar = $cal->calendars->get("h5096ummauq621nso94014ik2g@group.calendar.google.com");
  //Calendar ID
  echo "Calendar ID: " . $calendar["id"];
/*
  //Get every event in the calendar
  $events = $cal->events->listEvents($CalendarID);
  
  /* 
  //Cycle through and delete events
  while(true) {
    foreach ($events["items"] as $event) {
      //echo "I'm an item! <br />";
      try{
        //Deletes the event
        //$cal->events->delete($CalendarID, $event["id"]);
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
  */
}
else{
  $authURL = $client->createAuthUrl();
  print "<a class='login' href='$authURL'>Connect</a>";
}


















/*



$URL = "http://www.gobearcats.com/data/cinn-event-info-2012.xml";
$xml = simplexml_load_file($URL,'SimpleXMLElement', LIBXML_NOCDATA);

foreach($xml->children() as $event)
{
	$gameType = "";
	$gameTypeFull = "";
	$gameHomeAway = "";
	$gameHomeAway = "";
	$gameOpponent = "";
	$gameTime = "";
	$gameTimeZone = "";
	$gameDate = date("Y-m-d", mktime(0,0,0,0,0,0));

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
			case "time":
				$gameTime = $gameInfo;
				break;
			case "time_zone":
				$gameTimeZone = $gameInfo;
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

	//Build calendar shit
	$event = new Google_Event();
	
	//Build Summary
	$eventSummary = "";
	if($gameHomeAway == "H"){
		$eventSummary = $gameTypeFull . "vs. " . $gameOpponent;
	} else{
		$eventSummary = $gameTypeFull . "@ " . $gameOpponent;
	} 
	$event->setSummary($eventSummary->text);
	$event->setLocation($gameLocation->text);
	
	//Set Start/End info
	$start = new Google_EventDateTime();
	$end = new Google_EventDateTime();
	if($gameTime != 'All Day' && $gameTime != "" && $gameTime != "TBA")
	{	//GameTime has been set
		//Parse the AM/PM
		$gameTime = substr($gameTime, 0, strlen($gameTime)-3);

		//Find utc offset
		$utcOffset = "-0".abs(date('Z')/60/60);
		$startOffset = $utcOffset.":00";
		$dateTime = $gameDate."T".$gameTime.":00.000".$startOffset;
		$start->setDateTime($dateTime);

		$utcOffset = $utcOffset + 1; 
		$endOffset = $utcOffset.":00";
		$dateTime = $gameDate."T".$gameTime.":00.000".$endOffset;
		$end->setDateTime($dateTime);
	}
	else
	{	//Set for general day
		$start->setDate($gameDate);
		$end->setDate($gameDate);	
	}
	$event->setStart($start);
	$event->setEnd($end);

	try{
		//$newEvent = $cal->events-insert($CalendarID, $event, array());
	}
	catch(Exception $e){
		echo "Error creating event. <br/>";
	}
}

*/

echo "<br /> The end! <br />";

?>


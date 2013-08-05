<!--Script to add modal capability to the links on the calendar-->
<script type="text/javascript">
	$(function() {
	  $('.nyroModal').nyroModal();
	});
</script>
	
	
<?php
function draw_calendar($month,$year){

  /* draw table */
  $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

  /* table headings */
  $headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
  $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

  /* days and weeks vars now ... */
  $running_day = date('w',mktime(0,0,0,$month,1,$year));
  $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
  $days_in_this_week = 1;
  $day_counter = 0;
  $dates_array = array();

  /* row for week one */
  $calendar.= '<tr class="calendar-row">';

  /* print "blank" days until the first of the current week */
  for($x = 0; $x < $running_day; $x++):
    $calendar.= '<td class="calendar-day-np">&nbsp;</td>';
    $days_in_this_week++;
  endfor;

  /* keep going with days.... */
  for($list_day = 1; $list_day <= $days_in_month; $list_day++):
    $calendar.= '<td class="calendar-day">';
      /* add in the day number */
      $calendar.= '<div class="day-number">'.$list_day.'</div>';

      //Set the date in the format used for games in database
      $format = "Y-m-d";
      $gameDate = $year.'/'.$month.'/'.$list_day;
      
	  /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
      $result = GetGames_Date($gameDate);
	  while ($rows = mysql_fetch_array($result))
	  { //While there is another value, mark it down on the calendar.
	    $gameDetailsURL = 'GameDetails.php?gid='.$rows['GameID']; 	//Set game details url for jquery popup window.
		$gameType = '';												//Reset game type
		if($rows['HomeAway'] == 'V')
		{
			$gameType = '@'.$gameType;
		}
		
		$gameType = $gameType.$rows['GameTypeFull'];
		$calendar .= '<p><a href="'.$gameDetailsURL.'" title="Game Details" target="_blank" class="nyroModal">'.$gameType.'</a></p>'; //Add opponent to calendar & add jquery
      	
      }
      
    $calendar.= '</td>';
    if($running_day == 6):
      $calendar.= '</tr>';
      if(($day_counter+1) != $days_in_month):
        $calendar.= '<tr class="calendar-row">';
      endif;
      $running_day = -1;
      $days_in_this_week = 0;
    endif;
    $days_in_this_week++; $running_day++; $day_counter++;
  endfor;

  /* finish the rest of the days in the week */
  if($days_in_this_week < 8):
    for($x = 1; $x <= (8 - $days_in_this_week); $x++):
      $calendar.= '<td class="calendar-day-np">&nbsp;</td>';
    endfor;
  endif;

  /* final row */
  $calendar.= '</tr>';

  /* end the table */
  $calendar.= '</table>';
  /* all done, return result */
  return $calendar;
}


$month = $_GET['m']; //Request Month from url
if ($month == 0)
{
	$month = date('m');
	$monthTitle = date('M');
}
else
{
	$monthTitle = date('M', mktime(0, 0, 0, $month, 0, 0));
}
$year = date('Y');
?>
<?php
/* Build Calendar */
echo draw_calendar($month,$year);
?>


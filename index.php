<?php include 'Controls/header.php'; ?>
<?php 
	/*$result = ScoopOfTheWeek();
	while($row = mysql_fetch_array($result))
	{
		$gameDate = strtotime($row['GameDate']);
		$dayNumber = date("w", $gameDate);
		
		switch($dayNumber)
		{
			case '0':
				$Sunday[] = $row;
				break;
			case '1':
				$Monday[] = $row;
				break;
			case '2':
				$Tuesday[] = $row;
				break;
			case '3':
				$Wednesday[] = $row;
				break;
			case '4':
				$Thursday[] = $row;
				break;
			case '5':
				$Friday[] = $row;
				break;
			case '6':
				$Saturday[] = $row;
				break;
		}
	}*/
?>
		<div class="ScoopOfTheWeekBackground"></div>		
		<div class="content">
		<!----------- Insert any announcments you have here ---------->
		<div class="Announcements">
			<div class="AnnounementsHeader">Announcements</div>
			<p>
				It's basketball season again, make sure to pick your tickets up at <a href="http://www.catstix.com">CatsTix.com</a> or the ticket office at Lindner.
			</p>
		</div>
		<!------------------------------------------------------------>
		<div class="WhatIsRC">
			<div class="WhatIsRCHeader">What is RallyCats?</div>
			<p>
				We are a group of students that are very spirited and loyal to Bearcats Athletics. 
				You can find RallyCats at almost every UC sporting event. 
				We attend all home games and travel to see our Bearcats on the road every chance that we get! 
				We have traveled all around the Big East Conference and more to see our Bearcats compete. 
				As our motto says, "They Play the Game, We Make the Noise", we are committed to cheering 
				on the Bearcats and creating a spirited environment for our teams. 
				We are always looking for spirited and loyal Bearcats Fans to join us in our mission. 
				Be a part of the UC RallyCats today!
			</p>
			<p>
				Follow us on Twitter @UCRallyCats
				If you have any questions or general comments, 
				please contact any of our Executive member from the
				<a href="Contact.php">Contact Us</a> page.
			</p>
		</div>
		<?php include 'Controls/WebControls/IndexScoop.php'; ?>
		
		<div class="indexClearer"></div>

<?php include 'Controls/footer.php'; ?>

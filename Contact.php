<?php include 'Controls/header.php'; 

	$i=0;
	
	$execLevel = array("President:", "Internal:", "External:", "Finance and Records:", "Spirit:", "Recruitment:", "Social:");
	$execMembers;// = array(7);
	$execMemberEmails;// = array(7);
	
	$result = GetExecInfo(); 
	while ($rows = mysql_fetch_array($result))
	{
		//echo $execMembers[$i];
		$execMembers[] = $rows['Name'];
		$execMemberEmails[] = $rows['Email'];
		$i = $i + 1;
	}
?>

	<div class="ScoopOfTheWeekBackground"></div>
	<div class="content">
	<table class="contactUsTable">
		<?php
			$i = 0;
			while($i < 7)
			{ ?>
			<tr>
				<td class="execLevel"><?php echo $execLevel[$i]; ?></td>
				<td><a target="blank" href="<?php echo "mailto:".$execMemberEmails[$i]; ?>"><?php echo $execMembers[$i]; ?></a></td>
			</tr>
			<?php $i = $i + 1;
			 } 
		?>
	</table>
	
 	<div class="contactUsEmail">
		<form method="post" action="">
		<table width="450px">
			<tr class="contactUsFormTD">
				<td>
					Select Member
				</td>
				<td>
					<select name="execMemberDD">
						<?php
							$i = 0;
							while($i < 7)
							{
								echo "<option value=\"$execMemberEmails[$i]\">$execMembers[$i]</option>";
								$i = $i + 1; 
							} 
						?>
							
					</select>
				</td>
			</tr>
			<tr>
 				<td class="contactUsFormTD">
  					<label>Name</label>
 				</td>
 				<td>
  					<input type="text" name="name" maxlength="50" size="30">
 				</td>
			</tr>
			<tr>
 				<td class="contactUsFormTD">
  					<label>Email</label>
 				</td>
 				<td>
  					<input type="text" name="email" maxlength="50" size="30">
 				</td>
			</tr>
			<tr>
 				<td class="contactUsFormTD">
  					<label>Message</label>
 				</td>
 				<td valign="top">
  					<textarea name="comments" maxlength="1000" cols="25" rows="6"></textarea>
 				</td>
			</tr>
			<tr>
 				<td colspan="2" style="text-align:center">
  					<input type="submit" value="Send">
 				</td>
			</tr>
		</table>
		</form>
	</div>
	
	<?php if(isset($_POST['comments'])) {
		//Get the drop down value
   	 	$email_to = $_POST["execMemberDD"];
     
    	// validation expected data exists
    	if(!isset($_POST['name']) || !isset($_POST['comments'])) {
      	 	died('We are sorry, but there appears to be a problem with the form you submitted.');       
   		 }
     
    	$name = $_POST['name']; // required
    	$email = $_POST['email']; // required
    	$headers = "From: RallyCatsSite";
    	$comments = "From: ".$name."\n\n";
    	$comments = $comments."Email: ".$email."\n\n";
    	$comments = $comments.$_POST['comments']; // required
		
		mail($email_to, "Contact Us Ticket: ", $comments, $headers);
		
		// Now show a Thank you message:	
		?>
		<p class="contactUsThankYou">Thank you for the email. The member that you emailed will be in contact with you as soon as possible.</p> 
 		
 		<?php } ?>
 		
	<div class="contactUsClearer"></div>

	

<?php include 'Controls/footer.php'; ?>
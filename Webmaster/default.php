<html>
<body>

<?php
include '../Controls/init.php';

if(!logged_In())
{
	//header('location: login.php');
	//exit();
}

?>

<div class='Header'>
		<p>
			Welcome VP of Recruitment. I hope that past VP has gone through
			what needs to be done. If not, you have a few options:
		</p>
			<ul>
				<li>Yell at them and tell them to do their job</li>
				<li>Go read the <a href="ReadMe.txt">ReadMe.txt</a> file</li>
				<li>Email me and I'll try to help you out: Evan.Lepolt@gmail.com</li>
			</ul>
	</div>
	<p>Use this to view all data, make sure it's correct on here.</p>
	<a href='ViewAll.php'>View all games</a>
	
	<p>Use this to update results/gametimes/etc</p>
	<a href='Update.php'>Update database</a>
	
	<p>Use this at the beginning of the season</p>
	<a href='Insert.php'>Create new season</a>
	
	<p>
		Hope everything works and that RallyCats is thriving.
		If you ever need anything feel free to email me.
		If you're a computer engineer, stick with it. If not, change majors.
	</p>

	<div class='Footer'>
		<p>They play the games, we make the noise.</p>
	</div>
</body>
</html>

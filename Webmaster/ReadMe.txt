ReadME

Greetings fellow RallyCat. Congratulations on your election, now it's time to get to work.

You really can't do anything until the athletic schedules for next year have been released, but you can read through this so that when it's time to update everything, you can be efficient.

So what you will need to do is go download the schedules for each sport. As of 2012, they are located at http://www.gobearcats.com/ot/sched-download.html.

Next you need to edit each excel document a little bit. Here's what you need to do:
  -DELETE the columns with the title 'END DATE' and 'END TIME'. Don't just delete the info, highlight the column, right click, choose delete.
  -Under the 'SUBJECT' column, get rid of everything except the opponent's name.
				
				*****IMPORTANT*****
Make sure that where ever there is an apostrophe (IE: St. John's) that you put a backward slash in front of it (IE: St. John\'s)
				*****</IMPORTANT>*****
				
  -Under the 'LOCATION' column, change them all to H or A (Home or Away) depending on whether… well, if it's home or away.
  -Under the 'DESCRIPTION' column, change it to the following:
    if
	Football = 0
	Men's Basketball = 1
	Women's BB = 2
	Men's Soccer = 3
	Women's Soccer = 4
	Volleyball = 5
	Swimming&Diving = 6
	Women's Lax = 7
	Women's Tennis = 8
	Baseball = 9
  -If there is no game time, make sure that it says TBA (don't forget to update this when the time is announced from UCRallyCats.com/webmaster/update.php)
****************************** Please Note ****************************************
If a new sport has been added, this website might be fucked, so you should either contact me (Evan.Lepolt@gmail.com) or someone that knows how to program websites (I'll try to comment the actual pages to make it easy to update).
***********************************************************************************

  -DELETE the top row that has all the things like STARTDATE and shit like that.
		
  -Once you finish all that, you need to combine them all into one single excel document.
  -This should be saved as a .csv file. If not, go back into excel and save it as such. Right click the file, open it with some text editor. It should contain all the data, separated by columns. If there are extra commas that's ok, just make sure the first five are correct.

				*****IMPORTANT*****
  -Rename the file "FullSchedule.csv"
				*****</IMPORTANT>*****

Upload FullSchedule.csv to the database.
//TODO: Explain the database a little bit, or depend on the prior vp of comm.

visit UCRallyCats.com/webmaster/default.php
-View All Games. 
  This is just to make sure all the information has been entered correctly into the database, click it whenever you want.

-Update database
  When a new time has been released, or a game is finished and you want to update the score, visit this page to insert it.

-Create new season
  This is what you will do at the beginning of the season. This deletes last years data, and creates new data based on the FullSchedule.csv.
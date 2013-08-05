		<div class="ScoopOfTheWeek">
			<div class="ScoopOfTheWeekHeader">
				Scoop of the Week
			</div>
			<div>
				<table class="standard">
				<!--If $array > 0 then a foreach loop is entered which enters all the data
				    Else a NoInfo column is inserted-->
					<?php
						$format = "Y-m-d";								//Format for the database
						for($i=0;$i<=6;$i++)							//Loops through today + next six days
						{
							$NextDay = date($format, GetDay($i));		//Used to get the games on a certain day of the week
							$result = GetGames_Date($NextDay);				//Results of query
							
							$temp=0;    								//reset $temp
							$array = null;								//reset $array		
							while ($rows = mysql_fetch_array($result))
							{						
								//This loop uses an arbitrary value to add into an array
								//The only purpose of the array is to decide later if there
								//is a game on this date.
								$array[$temp] = $temp;
								$temp++;
							}
					?>
							<tr>
								<td class="headerTD" colspan="4"><?php echo date("D M j", GetDay($i));?></td>
							</tr>
						
							<?php 
							if(count($array)>0)						//Based on the while loop above
							{
								
								$result = GetGames_Date($NextDay);		//Need to requery DB. Gotta be a way around this.
								while ($rows = mysql_fetch_array($result))
								{ //While there is another value, mark it down on the scoop of the week.
								$gameType = $rows['GameType'];
								$gameTime = $rows['GameTime'];
								$opponent = '';
								if($rows['HomeAway'] == 'V')
								{
									$opponent = '@'.$opponent;
								}
								$opponent = $opponent.$rows['Opponent'];
							?>
								<tr title="<?php echo HomeAway($val['HomeAway']);?>">
									<td class="Sport"><?php echo $gameType;?></td>
									<td class="Opponent"><?php echo $opponent;?></td>
									<td><?php echo $gameTime;?></td>
								</tr>
							<?php 
								} /*end while, add spacer*/ ?>
								<tr><td class="ScoopTableSpacer" colspan="3"></td></tr>
							<?php 
							} //end if
						else
						{ /*Else put a 'NoInfo' row*/ ?> 	
							<tr><td class="noInfoTD" colspan="3">No Games</td></tr>
							<tr><td class="ScoopTableSpacer" colspan="3"></td></tr>
						<?php 
						} 
					}	//close for loop
					 	?>
					
				</table>
			</div>
		</div>

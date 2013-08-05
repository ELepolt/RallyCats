<?php include 'Controls/header.php'; ?>

	<div class="ScoopOfTheWeekBackground"></div>
	<div class="content">
	<!--
	Credits:
	PHP Calendar: http://davidwalsh.name/php-calendar
	Used nyroModal for the popup: http://lmgtfy.com/?q=nyroModal
	-->
		
	<div class="calendarHolder">
		<table>
			<tr>
				<?php
				for($i=1;$i<=12;$i++)
				{
					$monthTitle = date('M', mktime(0, 0, 0, $i, date("d"), date("Y")));
					echo '<td><a class="calendarMonthLink" href="?m='.$i.'">'.$monthTitle.'</a></td>';
				}
				?>
				<td>
					<a target="_blank" href="https://www.google.com/calendar/embed?src=h5096ummauq621nso94014ik2g%40group.calendar.google.com&ctz=America/New_York"
					   class="gCalButton">
					</a>
				</td>
			</tr>
		</table>
		<?php include 'Calendar.php'; ?>
	</div>
<?php include 'Controls/footer.php'; ?>
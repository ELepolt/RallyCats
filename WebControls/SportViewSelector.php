	<div class="FilterBar">
		<ul>
			<li <?php if($sport == -1){?> class="Selected" <?php } ?>>
				<a href="<?php echo "ViewAll.php?sport=-1&view=".$view;?>">All Sports</a>
			</li>
			<li <?php if($sport == 0){?> class="Selected" <?php } ?>>
				<a href="<?php echo "ViewAll.php?sport=0&view=".$view;?>">Men's Basketball</a>
			</li>
			<li <?php if($sport == 1){?> class="Selected" <?php } ?>>
				<a href="<?php echo "ViewAll.php?sport=1&view=".$view;?>">Baseball</a>
			</li>
		</ul>
		<ul>
			<li <?php if($view == -1){?> class="Selected" <?php } ?>>
				<a href="<?php echo "ViewAll.php?sport=".$sport."&view=-1";?>">All Games</a>
			</li>
			<li <?php if($view == 0){?> class="Selected" <?php } ?>>
				<a href="<?php echo "ViewAll.php?sport=".$sport."&view=0";?>">Remaining Games</a>
			</li>
			<li <?php if($view == 1){?> class="Selected" <?php } ?>>
				<a href="<?php echo "ViewAll.php?sport=".$sport."&view=1";?>">Results</a>
			</li>
		</ul>
	</div>

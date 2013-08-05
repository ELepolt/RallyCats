<?php
function GetExecInfo(){
	$SQL = "SELECT * FROM `ExecBoard` ORDER BY `Rank` ASC";
	
	return mysql_query($SQL);
}
function GetSeasonData($sport, $view){
	if ($sport == -1 && $view == -1){
		$SQL = "SELECT * FROM `Schedule_Data` ORDER BY `GameDate` ASC";
	}
	elseif($sport >= 0 && $view == -1){
		$SQL = "SELECT * FROM `Schedule_Data` WHERE GameType =".$sport." ORDER BY `GameDate` asc";
	}
	elseif($sport == -1 && $view == 0){
		$SQL = "SELECT * FROM `Schedule_Data` WHERE GameDate >= CURDATE() order by `GameDate` asc";
	}
	elseif($sport == -1 && $view == 1){
		$SQL = "SELECT * FROM `Schedule_Data` WHERE GameDate < CURDATE() order by `GameDate` asc";
	}
	elseif($sport >= 0 && $view == 1){
		$SQL = "SELECT * FROM `Schedule_Data` WHERE GameType =".$sport." AND GameDate < CURDATE() ORDER BY `GameDate` asc";
	}
	else{
		$SQL = "SELECT * FROM `Schedule_Data` WHERE GameType =".$sport." AND GameDate >= CURDATE() ORDER BY `GameDate` asc";
	}
	
	return mysql_query($SQL);
}


function ScoopOfTheWeek()
{
	$format = "Y/m/d";
	$Today = date($format);
	$NextWeek = date($format,mktime(0,0,0,date("m"),date("d")+6,date("Y")));

	$SQL = "SELECT * FROM `Schedule_Data` WHERE `GameDate` >= '$Today' AND `GameDate` <= '$NextWeek' ORDER BY `GameDate` asc";
	return mysql_query($SQL);
}
function GetGames_Date($date)
{
	$newDate = date("Y-m-d", strtotime($date));
	$SQL = "SELECT * FROM `Schedule_Data` where GameDate = '$newDate'";
	return mysql_query($SQL);
}
function GetGame_ID($id)
{
	$SQL = "SELECT * FROM `Schedule_Data` where GameID = '$id'";
	return mysql_query($SQL);
}



?>
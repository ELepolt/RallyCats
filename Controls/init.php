<?php
ob_start();
session_start();
//$con = mysql_connect("localhost","root","password");
$con = mysql_connect("localhost","group_rallycats","db4rc@uc");


if(!$con)
{
  echo "<p>Error connecting to database.</p>";
}
//select DB
$conDB = mysql_select_db("group_rallycats");
if(!$conDB)
{
  echo "Error connecting to table.";
}
else
{
  mysql_select_db("group_rallycats");
}

include 'db_Queries.php';
include 'helpers.php';



?>

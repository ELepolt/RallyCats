<html>

<body>
<?php include 'init.php'; ?>

<?php 
// Define your username and password 
$username = "webmaster"; 
$password = "password"; 

if ($_POST['txtUsername'] != $username || $_POST['txtPassword'] != $password) {
?> 
<h1>Login</h1> 

<form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
    <p><label for="txtUsername">Username:</label> 
    <br /><input type="text" title="Enter your Username" name="txtUsername" /></p> 

    <p><label for="txtpassword">Password:</label> 
    <br /><input type="password" title="Enter your password" name="txtPassword" /></p> 

    <p><input type="submit" name="Submit" value="Login" /></p> 

</form> 
<? } 
else
{ 
	$inTwoMonths = 60 * 60 * 24 * 60 + time(); 
	$_SESSION['user_id'] = 1;
	echo $_SESSION['user_id'];
	header('location: default.php');
	exit();
	
}
?>
</body>
</html>

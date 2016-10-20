<?php
	include_once('process.php');
?>

<html>
	<head>
		<title>Jelszó változtatás</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
	
<form action="main.php" method="post">
	Régi jelszó: 	<input type="password" name="oldpw" /><br />
	Új jelszó:		<input type="password" name="newpw" /><br />
	Új jelszó újra: <input type="password" name="newpw2" /><br />
	<input type="submit" name="change" value="Megváltoztat" />
	<input type="submit" name="return"  value="Vissza a főoldalra" />
</form>	

	</body>
</html>
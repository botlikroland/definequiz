<?php
    include_once('process.php');

?>

<html>
<head>
    <title>Főoldal</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
echo "Üdvözöllek ". $_SESSION['username'] . "!";
?>

<form action="main.php" method="post">
    <input type="submit" name="changepw" value="Jelszó változtatás" />
    <input type="submit" name="logout"  value="Kijelentkezés" /><br />
</form>




</body>
</html>

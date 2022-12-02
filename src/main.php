<?php

	session_start();
	
	if (!isset($_SESSION['loggedIn']))
	{
		header('Location: index.php');
		exit();
	}
	
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/svg+xml" href="./src/Img/favicon-dark.png" media="(prefers-color-scheme: light)" />
  <link rel="icon" type="image/svg+xml" href="./src/Img/favicon-light.png" media="(prefers-color-scheme: dark)" />
    <title>Typer</title>
  </head>
  <body>
  <?php

echo "<p>Witaj ".$_SESSION['imie'].'! [ <a href="logout.php">Wyloguj się!</a> ]</p>';

?>
  </body>
</html>

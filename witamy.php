<?php

	session_start();
	
	if (!isset($_SESSION['udanarejestracja']))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		unset($_SESSION['udanarejestracja']);
	}
	
	//Usuwanie zmiennych pamiętających wartości wpisane do formularza
	if (isset($_SESSION['fr_imie'])) unset($_SESSION['fr_imie']);
	if (isset($_SESSION['fr_nazwisko'])) unset($_SESSION['fr_nazwisko']);
	if (isset($_SESSION['fr_haslo'])) unset($_SESSION['fr_haslo']);
	if (isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
	if (isset($_SESSION['fr_login'])) unset($_SESSION['fr_login']);
	
	//Usuwanie błędów rejestracji
	if (isset($_SESSION['e_imie'])) unset($_SESSION['e_imie']);
	if (isset($_SESSION['e_nazwisko'])) unset($_SESSION['e_nazwisko']);
	if (isset($_SESSION['e_haslo'])) unset($_SESSION['e_haslo']);
	if (isset($_SESSION['e_login'])) unset($_SESSION['e_login']);
	if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
	
?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/svg+xml" href="Img/favicon-dark.png" media="(prefers-color-scheme: light)" />
  <link rel="icon" type="image/svg+xml" href="Img/favicon-light.png" media="(prefers-color-scheme: dark)" />
  <link rel="stylesheet" href="./Styles/styles.css">
  <title>Typer</title>
  <script src="main.js" defer></script>
</head>
<body>
  <div class="container">
    <h2 class="header">Zaloguj się</h2>
    <a href="index.php"><button>Zaloguj się</button></a>
  </div>
  <div class="footer">
  </div>
  </div>
</body>

</html>
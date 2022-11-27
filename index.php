<?php

	session_start();
	
	if ((isset($_SESSION['loggedIn'])) && ($_SESSION['loggedIn']==true))
	{
		header('Location: main.php');
		exit();
	}

?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/svg+xml" href="./Img/favicon-dark.png" media="(prefers-color-scheme: light)" />
  <link rel="icon" type="image/svg+xml" href="./Img/favicon-light.png" media="(prefers-color-scheme: dark)" />

    <title>Typer</title>
  </head>
  <body>
  <div className={styles.container}>
        <h2 className={styles.header}>Zaloguj się</h2>
        <form  action="./auth.php" method="POST">
          <div className={styles.input}>
            <input type="text" name="login" placeholder="Login" required />
          </div>
          <div className={styles.input}>
            <input type="password" name="haslo" placeholder="Hasło" required />
          </div>
          <div className={styles.form_container}>
            <button type="submit" className={styles.button}>
              Zaloguj się
            </button>
          </div>
          <?php
	if(isset($_SESSION['eror']))	echo $_SESSION['eror'];
?>
      
            
        </form>
        <span >Nie masz jeszcze konta?</span> <br />
              <a href="register.php"><button >Zarejestruj się</button></a>
          </div>

  </body>
</html>

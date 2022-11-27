<?php

session_start();

if ((isset($_SESSION['loggedIn'])) && ($_SESSION['loggedIn'] == true)) {
  header('Location: main.php');
  exit();

} ?>
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
    <form method="POST">
      <div class="input">
        <input type="text" name="login" placeholder="Login" required />
      </div>
      <div class="input">
        <input type="password" name="haslo" placeholder="Hasło" required />
      </div>
      <div class="form_container">
        <button type="submit" class="button">
          Zaloguj się
        </button>
        <?php
                if (isset($_SESSION['eror']))
                  echo $_SESSION['eror'];
        ?>
    </form>
  </div>
  <div class="footer">
    <span class="span">Nie masz jeszcze konta?</span> <br />
    <a href="register.php">
      <button   class="button">Zarejestruj się</button>
    </a>
  </div>
  </div>
</body>

</html>
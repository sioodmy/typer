<?php

session_start();

if ((isset($_SESSION['loggedIn'])) && ($_SESSION['loggedIn'] == true)) {
  header('Location: main.php');
  exit();
}

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
</head>
<body>
  <div class="container">
    <h2 class="header">Zarejestruj się</h2>
    <form action="registraction.php" method="POST">
      <div class="input">
        <input type="text" name="imie" value="<?php
        if (isset($_SESSION['fr_imie'])) {
          echo $_SESSION['fr_imie'];
          unset($_SESSION['fr_imie']);
        }
        ?>" placeholder="Imię" required /><br>
        <?php
    if (isset($_SESSION['e_imie'])) {
      echo '<div class="error">' . $_SESSION['e_imie'] . '</div>';
      unset($_SESSION['e_imie']);
    }
    ?>
      </div>
      <div class="input">
        <input type="text" name="nazwisko" value="<?php
        if (isset($_SESSION['fr_nazwisko'])) {
          echo $_SESSION['fr_nazwisko'];
          unset($_SESSION['fr_nazwisko']);
        }
        ?>" placeholder="Nazwisko" required /><br>
        <?php
    if (isset($_SESSION['e_nazwisko'])) {
      echo '<div class="error">' . $_SESSION['e_nazwisko'] . '</div>';
      unset($_SESSION['e_nazwisko']);
    }
    ?>
      </div>
      <div class="input">
        <input type="text" name="login" value="<?php
        if (isset($_SESSION['fr_login'])) {
          echo $_SESSION['fr_login'];
          unset($_SESSION['fr_login']);
        }
        ?>" placeholder="Login" required /><br>
        <?php
        if (isset($_SESSION['e_login'])) {
          echo '<div class="error">' . $_SESSION['e_login'] . '</div>';
          unset($_SESSION['e_login']);
        }
        ?>
      </div>
      <div class="input">
        <input type="email" name="email" value="<?php
        if (isset($_SESSION['fr_email'])) {
          echo $_SESSION['fr_email'];
          unset($_SESSION['fr_email']);
        }
        ?>" placeholder="Email" required /><br>
        <?php
    if (isset($_SESSION['e_email'])) {
      echo '<div class="error">' . $_SESSION['e_email'] . '</div>';
      unset($_SESSION['e_email']);
    }
    ?>
      </div>
      <div class="input">
        <input type="password" name="haslo" value="<?php
        if (isset($_SESSION['fr_haslo'])) {
          echo $_SESSION['fr_haslo'];
          unset($_SESSION['fr_haslo']);
        }
        ?>" placeholder="Hasło" required /><br>
        <?php
    if (isset($_SESSION['e_haslo'])) {
      echo '<div class="error">' . $_SESSION['e_haslo'] . '</div>';
      unset($_SESSION['e_haslo']);
    }
    ?>
      </div>
    </form>
    <div class="form_container">
      <button type="submit">Zarejestruj się</button>
    </div>
    <div class="footer">
      <span class="span">Masz już konto?</span> <br />
      <a href="index.php">
        <button>Zaloguj się</button>
      </a>
    </div>
  </div>
</body>
</html>
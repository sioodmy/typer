<?php

session_start();

if ((isset($_SESSION['loggedIn'])) && ($_SESSION['loggedIn'] == true)) {
  header('Location: main.php');
  exit();
}
	
	
	if (isset($_POST['email']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		//Sprawdź poprawność nickname'a
		$login = $_POST['login'];
		
		//Sprawdzenie długości nicka
		if ((strlen($login)<3) || (strlen($login)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_login']="Login musi posiadać od 3 do 20 znaków!";
		}
		
		if (ctype_alnum($login)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_login']="Login może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		
		// Sprawdź poprawność adresu email
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}
		
		//Sprawdź poprawność hasła
		$haslo = $_POST['haslo'];
		
		if ((strlen($haslo)<8) || (strlen($haslo)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
		}
	

		$haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);
		
	
		
		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_login'] = $nick;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_haslo'] = $haslo;
		$_SESSION['fr_imie'] = $imie;
		$_SESSION['fr_nazwisko'] = $nazwisko;
		
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//Czy email już istnieje?
				$rezultat = $polaczenie->query("SELECT id FROM dane WHERE email='$email'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
				}		

				//Czy nick jest już zarezerwowany?
				$rezultat = $polaczenie->query("SELECT id FROM dane WHERE login='$nick'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_loginow = $rezultat->num_rows;
				if($ile_takich_loginow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_login']="Istnieje już gracz o takim Loginie! Wybierz inny.";
				}
				
				if ($wszystko_OK==true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
					
					if ($polaczenie->query("INSERT INTO dane VALUES (NULL, '$imie', '$nazwisko', '$login', '$haslo_hash', '$email', 1)"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: witamy.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
				}
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
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
    <form  method="POST">
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
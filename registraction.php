<?php
session_start();

if (isset($_POST['email']))
{
  //Udana walidacja? Załóżmy, że tak!
  $wszystko_OK=true;
  
  //Sprawdź poprawność nickname'a
  $login = $_POST['login'];
  
  // //Sprawdzenie długości nicka
  // if (($login < 3) || ($login>20))
  // {
  //   $wszystko_OK=false;
  //   $_SESSION['eror']="Nick musi posiadać od 3 do 20 znaków!";
  //   header('Location: index.php');
  // }
  
  

  $email = $_POST['email'];
  $imie = $_POST['imie'];
  $nazwisko = $_POST['nazwisko'];
  $haslo = $_POST['haslo'];
  
  // if ((strlen($haslo)<8) || (strlen($haslo)>20))
  // {
  //   $wszystko_OK=false;
  //   $_SESSION['eror']="Hasło musi posiadać od 8 do 20 znaków!";
  //   header('Location: index.php');
  // }

  $haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);

  require_once "connect.php";
  mysqli_report(MYSQLI_REPORT_STRICT);
  
  
    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
    if ($polaczenie->connect_errno!=0)
    {
      throw new Exception(mysqli_connect_errno());
    }
    else
    {
      //Czy email już istnieje?
      $rezultat = $polaczenie->query("SELECT id FROM dane WHERE email='$email'");
      
      // if (!$rezultat) throw new Exception($polaczenie->error);
      
      $ile_takich_maili = $rezultat->num_rows;
      if($ile_takich_maili>0)
      {
        $wszystko_OK=false;
        $_SESSION['eror']="Istnieje już konto przypisane do tego adresu e-mail!";
        header('Location: index.php');
      }		

      //Czy nick jest już zarezerwowany?
      $rezultat = $polaczenie->query("SELECT id FROM dane WHERE login='$login'");
      
      // if (!$rezultat) throw new Exception($polaczenie->error);
      
      $ile_takich_nickow = $rezultat->num_rows;
      if($ile_takich_nickow>0)
      {
        $wszystko_OK=false;
        $_SESSION['eror']="Istnieje już gracz o takim nicku! Wybierz inny.";
        header('Location: index.php');
      }
      
      if ($wszystko_OK==true)
      {
        //Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
        
        if ($polaczenie->query("INSERT INTO dane VALUES (NULL, '$imie', '$nazwisko', '$login', '$haslo_hash', '$email', 1)"))
        {

          $_SESSION['eror'] = '<span style="color:green">Brawo udało ci się zarejestrować</span>';
				header('Location: index.php');

        }
        else
        {
          throw new Exception($polaczenie->error);
        }
        
      }
      
      $polaczenie->close();
    }
    
  }
?>

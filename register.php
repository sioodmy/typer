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
    <div id="root"></div>
      <div className={styles.container}>
        <h2 className={styles.header}>Zarejestruj się</h2>
        <form action="registraction.php" method="POST">
          <div className={styles.input}>
            <input type="text" name="imie" placeholder="Imię" required />
          </div>

          <div className={styles.input}>
            <input
              type="text"
              name="nazwisko"
              placeholder="Nazwisko"
              required
            />
          </div>
          <div className={styles.input}>
            <input type="text" name="login" placeholder="Login" required />
          </div>
          <div className={styles.input}>
            <input type="email" name="email" placeholder="Email" required />
          </div>
          <div className={styles.input}>
            <input type="password" name="haslo" placeholder="Hasło" required />
          </div>
          <div className={styles.form_container}>
            <button type="submit">Zarejestruj się</button>
          </div>
          
        </form>   
            <span className={styles.span}>Masz już konto?</span> <br />
              <a href="index.php" ><button>Zaloguj się</button></a>
      </div>
  </body>
</html>

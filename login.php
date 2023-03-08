<?php 
    session_start();

    if(isset($_SESSION['user'])){
        header('Location: user-profile.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Publiczna galeria</title>
</head>
<body>
    <header> 
        <div class="logo">
            <a href="index.php">strona główna</a>
        </div>

        <nav>
            <a href="register.php">rejestracja</a>
            <a href="#about">o projekcie</a>            
        </nav>
    </header>

    <main class="login-form"> 
        <section class="login">
            <h1>Zaloguj się</h1>
            
            <form action="login.php" method="POST">
                <label for="username">Login</label>
                <input type="text" name="username" required><br>
                
                <label for="password">Hasło</label>
                <input type="password" name="password" required><br>
                <input type="submit" id="btn" name="submit" value="wyślij">  
            </form>
        </section>
    </main>
    
    <?php 
        include 'dbConfig.php';

        if($_POST)
        {
            if (isset($_POST['submit']))
            {
                $username = $_POST['username'];
                $password = $_POST['password'];
                
                $query = 'SELECT `id`, `username`, `password` FROM `users` WHERE `username` = ?';
                $result = $db->execute_query($query, [$username]);
                
                if($result->num_rows > 0)
                {
                    $row = $result->fetch_assoc();
                    if(password_verify($password, $row['password']))
                    {
                        $_SESSION['user'] = $row['username'];
                        $_SESSION['userId'] = $row['id'];
                        header("Location: user-profile.php");
                        die();
                    }else 
                    {
                        echo "błędne hasło";
                        header("Refresh: 0");
                        die();
                    }
                }else 
                {
                    echo "Podany użytkownik nie istnieje!";
                }
                
            }
        }
    ?>

    <footer>
        <section class="about" id="about">
            <h2>o projekcie</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                 when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                 It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                 It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                 and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </section>
    </footer>
</body>
</html>
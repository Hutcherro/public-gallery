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
            <a href="login.php">logowanie</a>
            <a href="#about">o projekcie</a>            
        </nav>
    </header>

    <main class="reg-form"> 
        <section class="register-form">
            <h1>Zarejestruj się</h1>
            <form action="register.php" method="POST">
                <label for="username">Login</label>
                <input type="text" name="username" required>
                
                <label for="password-1">Hasło</label>
                <input type="password" name="password-1" required>

                <label for="password-2">Powtórz hasło</label>
                <input type="password" name="password-2" required>
                <br>

                <input type="submit" id="btn" name="submit" value="wyślij">  
            </form>
        </section>
    </main>
    
    <?php 
        include 'dbConfig.php';

        if($_POST){
            if (isset($_POST['submit'])){
                if( $_POST['password-1'] == $_POST['password-2']){
                    $username = $_POST['username'];
                    $secure_pass = password_hash($_POST['password-1'], PASSWORD_BCRYPT);
                    
                    $sql = "INSERT INTO `users`(`username`,`password`) VALUES('$username', '$secure_pass')";
                    $result = $db->execute_query($sql);
                    
                    if($result == false){
                        // echo "Spróbuj ponownie";
                        header("Refresh:0");
                        die();
                        // echo '<a href="register.php"> zarejestruj się tutaj </a>';
                    }else {
                        header("Location: login.php");
                        die();
                    }
                }  else {
                    // echo "Podane hasła są różne!";
                    header("Refresh:0");
                    die();
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
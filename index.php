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
            <a href="login.php">logowanie</a>
            <a href="#about">o projekcie</a>            
        </nav>
    </header>

    <main> 
        <section class="gallery">
            <h1>Witaj w galerii obrazów!</h1>
                <?php 
                    require_once 'dbConfig.php'; 
                    $result = $db->execute_query('SELECT `image` FROM `images` ORDER BY `id` DESC');
                ?>
                <?php if($result->num_rows > 0){ ?> 
                    <?php while($row = $result->fetch_assoc()){ ?>                        
                            <img src="data:image/jpg;base64,<?php echo base64_encode($row['image']); ?>" /> 
                    <?php } ?> 
                       
                    <?php }else{ ?> 
                        <p class="status error">Nie znaleziono obrazów...</p> 
                <?php } ?>
        </section>
    </main>
    
    <footer>
        <section class="about" id="about">
            <h2>O projekcie</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                 when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                 It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                 It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                 and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </section>
    </footer>

</body>
</html>
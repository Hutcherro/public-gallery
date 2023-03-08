<?php 
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: index.php');
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
            <!-- <a href="index.php">strona główna</a> -->
        </div>

        <nav>
            <a href="logout.php">wyloguj</a>
            <a href="#about">na temat</a>            
        </nav>
    </header>

    <main class="user-profile-main"> 
        <section class="upload-holder">
            <h1>
              Witaj <?php echo $_SESSION['user']; ?>!
            </h1>
            <form action="upload.php" method="POST" action="upload.php" enctype="multipart/form-data">
                <label for="img"> Wybierz zdjęcie którym chcesz się podzielić!</label>
                <p>Dozwolone są typy zdjęć: jpg, png, jpeg, gif</p>
                <input name="img" type="file"  id="img-upload" required>
                <input type="submit" value="Wyślij">
            </form>
        </section>
        <section class="gallery">
            <h1>Dodane przez Ciebie:</h1>

                <?php 
                    require_once 'dbConfig.php'; 
                
                    $query = 'SELECT `id`, `image` FROM `images` WHERE `owner` = ?';
                    $result = $db->execute_query($query, [$_SESSION['userId']]);
                ?>
                
                <?php if($result->num_rows > 0){ ?> 
                    <?php while($row = $result->fetch_assoc()){ ?>            
                                <img src="data:image/jpg;base64,<?php echo base64_encode($row['image']); ?>" /> 
                                
                                <form action="edit.php" method="POST">
                                    <input type="hidden" name="img-id" value="<?php echo $row['id']; ?>">
                                    <input type="submit" value="Edytuj">
                                </form>
                    <?php } ?> 
                       
                    <?php }else{ ?> 
                        <p class="status error">Brak dodanych zdjęć...</p> 
                    <?php } ?>            
        </section>
    </main>
    
    <footer>
        <section class="about" id="about">
            <h2>About</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                 when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                 It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                 It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                 and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </section>
    </footer>
</body>
</html>
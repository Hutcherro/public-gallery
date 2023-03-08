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
            <a href="index.php">powrót</a>
        </div>

        <nav>
            <a href="logout.php">wyloguj</a>
            <a href="#about">o projekcie</a>            
        </nav>
    </header>

    <main> 
        <section class="gallery">
                <?php 
                    require_once 'dbConfig.php'; 

                    if($_POST['img-id'])
                    {
                        $query = 'SELECT `image` FROM `images` WHERE `id` = ?';
                        $result = $db->execute_query($query, [$_POST['img-id']]);
                        if($result->num_rows > 0)
                        {
                            $row = $result->fetch_assoc();
                            echo "<h3>Aktualne zdjęcie:</h3><br>";
                            echo "<img src=data:image/jpg;base64," . base64_encode($row['image']);
                        }else 
                        {
                            echo "Nie znaleziono obrazu.";
                        }
                    }else 
                    {
                        echo "Wystąpił błąd!";
                    }
                ?>
                <section class="delete-section">
                    <form action="delete.php" method="POST">
                        <input type="hidden" name="img-id" value="<?php echo $_POST['img-id']; ?>">
                        <input type="submit" value="Usuń aktualne">
                    </form>
                </section>
                

                <section class="upload-holder-edit">
                    <form action="update.php" method="POST" id="update" enctype="multipart/form-data">
                        <h3>Lub wybierz zdjęcie do aktualizacji!</h3>
                        <!-- <label for="img"> Lub wybierz zdjęcie do aktualizacji!</label> -->
                        <p>Dozwolone są typy zdjęć: jpg, png, jpeg, gif</p>
                        <input type="hidden" name="img-id" value="<?php echo $_POST['img-id']; ?>">
                        <input type="file" name="img" id="img-upload" required>
                        <input type="submit" value="Aktualizuj">
                    </form>
                </section>

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
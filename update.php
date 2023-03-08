<?php 
    require_once 'dbConfig.php';

    if(isset($_FILES["img"]))
    { 
        $status = 'error'; 
        // echo $status;
        if(!empty($_FILES["img"]["name"]) && !empty($_POST['img-id'])) 
        { 
            $fileName = basename($_FILES["img"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
             
            $allowTypes = array('jpg','png','jpeg','gif'); 

            if(in_array($fileType, $allowTypes))
            { 
                $image = $_FILES['img']['tmp_name']; 
                $imgContent = addslashes(file_get_contents($image)); 

                $query = "UPDATE `images` SET `image` = '{$imgContent}' WHERE `id` = ?";
                $result = $db->execute_query($query, [$_POST['img-id']]);
    
                if($result)
                { 
                    // $status = 'success'; 
                    // $statusMsg = "File uploaded successfully."; 
                    header("Location: user-profile.php");
                    exit;
                }else{ 
                    // $statusMsg = "File upload failed, please try again."; 
                }  
            }else{ 
                // $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
            } 
        }else{ 
            // $statusMsg = 'Please select an image file to upload.'; 
        } 
    } 
?>
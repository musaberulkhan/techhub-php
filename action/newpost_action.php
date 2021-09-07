<?php
	require_once("../db_config.php");
    //Get Form Info
      
        $get_postTitle = $_REQUEST["postTitle"];        
        $get_postCategory = $_REQUEST["postCategory"];        
        $get_postBody = $_REQUEST["postBody"];
        $get_fileToUpload= $_FILES["fileToUpload"]["name"];
        $get_authorId= $_REQUEST["authorId"];
        
     

        //**********************************************************************/
        //  Upload Data to MySQL
         
        if(empty($get_postTitle)){
            header("location:../newPost.php?action=Post title cannot be empty");
        }
        elseif(empty($get_postCategory)){
            header("location:../newPost.php?action=Category cannot be empty");
        }   
        elseif(empty($get_postBody)){
            header("location:../newPost.php?action=Post body cannot be empty");
        }   
        elseif(empty($get_fileToUpload)){
            header("location:../newPost.php?action=Please upload a post thumbnail");
        }   
        else{
            //Insert to Database
            $sql_insert = "INSERT INTO `technews`(`title`, `description`, `image`, `author`, `category`) VALUES ('".$get_postTitle."','".$get_postBody."','".$get_fileToUpload."','".$get_authorId."', '".$get_postCategory."')";

            $run_cmd_insert = mysqli_query($conn, $sql_insert);
            
            if($run_cmd_insert == true){
                header("location:../newPost.php?actiondone=Category Inserted");
            }else{
                header("location:../newPost.php?action=Error Occured");
            }
        }





        $target_dir = "../uploads/";
        $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        }
        
    // if(empty($get_email)){
    //     header("location:../".$get_pagename.".php?action=User Name can not be empty");
    // }
    // else if(empty( $get_password)){
    //     header("location:../".$get_pagename.".php?action=Password can not be empty");
    // }    
    // else{
        
    //     $getPassword = "SELECT password FROM author WHERE email='".$get_email."'";        
    //     $runDataQuery = mysqli_query($conn, $getPassword);
        
    //     if($runDataQuery==true){
    //         while($my_data = mysqli_fetch_array($runDataQuery)){
    //          $receivedPassword= $my_data["password"];
    //         }           
    //     }
    //     echo $receivedPassword;
    //     //Checking for correct or wrong password
        
    //     if($get_password == $receivedPassword){
    //        header("location:../admin.php");
    //        setcookie("LOGGEDUSER", md5($get_email), time() + (86400 * 30), "/");

    //     }else{
    //         header("location:../".$get_pagename.".php?action=Wrong Username or Password");
    //     }
    // }   
    
    
?>


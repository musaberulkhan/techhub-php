<?php
	require_once("../db_config.php");
    //Get Form Info
      
        $get_email = $_REQUEST["email"];        
        $get_password = $_REQUEST["password"];
        $get_pagename= $_REQUEST["pagename"];
        
    if(empty($get_email)){
        header("location:../".$get_pagename.".php?action=User Name can not be empty");
    }
    else if(empty( $get_password)){
        header("location:../".$get_pagename.".php?action=Password can not be empty");
    }    
    else{
        
        $getPassword = "SELECT password FROM author WHERE email='".$get_email."'";        
        $runDataQuery = mysqli_query($conn, $getPassword);
        
        if($runDataQuery==true){
            while($my_data = mysqli_fetch_array($runDataQuery)){
             $receivedPassword= $my_data["password"];
            }           
        }
        echo $receivedPassword;
        //Checking for correct or wrong password
        
        if($get_password == $receivedPassword){
           header("location:../admin.php");
           setcookie("LOGGEDUSER", md5($get_email), time() + (86400 * 30), "/");

        }else{
            header("location:../".$get_pagename.".php?action=Wrong Username or Password");
        }
    }   
    
    
?>


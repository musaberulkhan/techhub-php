<?php
    if(!isset($_COOKIE["LOGGEDUSER"]))    
    {
        header("location:login.php");        
    }

    require_once("../db_config.php");

    $getEmail = "SELECT email,id FROM author";        
    $runEmailDataQuery = mysqli_query($conn, $getEmail);
    
    if($runEmailDataQuery==true){
        while($my_data = mysqli_fetch_array($runEmailDataQuery)){
         if(md5($my_data["email"])==$_COOKIE["LOGGEDUSER"]){
             $LOGGEDUSER_Email= $my_data["email"];            
             $LOGGEDUSER_Id= $my_data["id"];            
            }
        }
    }  

    
    $get_id = $_REQUEST["id"]; 
    $deleteDataSQL = "DELETE FROM technews WHERE id='$get_id'";    
    $runQuery = mysqli_query($conn, $deleteDataSQL);    
    if ($runQuery  == true){
         header("location:../allpost.php");
    }else{
         header("location:../allpost.php?action=Error Occured");
    }

?>
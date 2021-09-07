<?php
	require_once("../db_config.php");
    //Get Form Info
      
        $get_postId = $_REQUEST["postId"];  
        $get_postTitle = $_REQUEST["postTitle"];        
        $get_postCategory = $_REQUEST["postCategory"];        
        $get_postBody = $_REQUEST["postBody"];        
     

        //**********************************************************************/
        //  Upload Data to MySQL
         
        if(empty($get_postTitle)){
            header("location:../editpost.php?action=Post title cannot be empty");
        }
        elseif(empty($get_postCategory)){
            header("location:../editpost.php?action=Category cannot be empty");
        }   
        elseif(empty($get_postBody)){
            header("location:../editpost.php?action=Post body cannot be empty");
        }           
        else{
            //update to Database
            $sql_update= "UPDATE `technews` SET `title`='".$get_postTitle."',`description`='".$get_postBody."',`category`='".$get_postCategory."' WHERE `id`='".$get_postId."'";

            $run_cmd_update = mysqli_query($conn, $sql_update);
            
            if($run_cmd_update == true){
                header("location:../allpost.php?actiondone=Category Inserted");
            }else{
                header("location:../allpost.php?action=Error Occured");
            }
        }


    
?>


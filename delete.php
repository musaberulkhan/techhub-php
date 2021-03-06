<?php
    if(!isset($_COOKIE["LOGGEDUSER"]))    
    {
        header("location:login.php");        
    }

    require_once("db_config.php");

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechHub Admin Panel</title>
    <link rel="icon" href="images/fav-icon.png" sizes="32x32" type="image/png">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome CDN  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="stylesheet/dashboard.css">
</head>

<body>

    <div class="side">
        <div class="side-menu">
            <?php 
                include "sidebar.html"
            ?>
        </div>
    </div>
    <div class="main-body">
        <?php 
            include "topNav.html"
        ?>
        <div class="delete-post row p-4">
            <h3 id="delete-heading">Are you sure you want to delete this post?</h3>
            <div>
                <button id="delete-yes" class="yes">Yes</button>
                <button id="delete-no" class="no">No</button>
            </div>
        </div>
    </div>



    <script>
    document.getElementById('delete-no').addEventListener('click', function() {
        window.location.href = "allpost.php";
    });

    document.getElementById('delete-yes').addEventListener('click', function() {
        window.location.href = "action/delete_action.php?id=<?php echo $_REQUEST["id"]?>";
    })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
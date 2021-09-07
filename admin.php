<?php
    if(!isset($_COOKIE["LOGGEDUSER"]))    
    {
        header("location:login.php");        
    }

    require_once("db_config.php");

    $getEmail = "SELECT email, id FROM author";        
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="stylesheet/dashboard.css">
</head>

<body style="background-color:#f5f5f5">

    <div class="side">
        <div class="side-menu">
            <?php 
                include "sidebar.html";
                include("db_config.php");
            ?>
        </div>
    </div>
    <div class="main-body">
        <?php 
            include "topNav.html"
        ?>



        <div class="dashboard row p-4">
            <h2 class="dashboard-title mb-4">Dashboard</h2>
            <div class="col-md-4 col-sm-12 col-12">
                <h3 class="mb-3">Recent Post</h3>
                <?php
                    $showLastPostSQL = "SELECT TN.`id`, TN.`title`, TN.`description`, TN.`image`, TN.`views`, CT.category, TN.views FROM `technews` AS TN INNER JOIN author AS AU ON TN.author = AU.id INNER JOIN category AS CT ON TN.category=CT.id WHERE TN.author=$LOGGEDUSER_Id ORDER BY id DESC LIMIT 1";
                    $runShowLastPostQuery = mysqli_query($conn, $showLastPostSQL);
                    if($runShowLastPostQuery==true){                                                
                        while($my_data = mysqli_fetch_array($runShowLastPostQuery)){
                        ?>
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top p-3" src="uploads/<?php echo $my_data["image"] ?>" alt="">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $my_data["title"] ?></h5>
                                    <p class="card-text"><?php echo substr($my_data["description"],0, strpos($my_data["description"], ' ', 200))."......"; ?></p>
                                    <p class="card-text"><i class="fas fa-eye"></i> Views: <?php echo $my_data["views"] ?></p>                                    
                                    <a href="post.php?id=<?php echo $my_data["id"] ?>" class="btn btn-warning w-100">View Post</a>
                                </div>
                            </div>
                        <?php
                        }
                    }
                    ?>


            </div>
            <div class="col-md-4 col-sm-12 col-12">
                <h3>Analytics</h3>
            </div>
            <div class="col-md-4 col-sm-12 col-12">
                <h3>Trips and Tricks</h3>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
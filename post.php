<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechHub</title>
    <link rel="icon" href="images/fav-icon.png" sizes="32x32" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="stylesheet/stylesheet.css">
</head>

<?php 

    
    include("db_config.php");
    include("navigation-front.html");

    $get_Post_Id = $_REQUEST['id'];  // Storing Selected Value In Variable    
    $showPostSQL = "SELECT TN.`id`, TN.`title`, TN.`description`, TN.`image`, TN.`views`, AU.name, CT.category FROM `technews` AS TN INNER JOIN author AS AU ON TN.author = AU.id INNER JOIN category AS CT ON TN.category=CT.id WHERE TN.id=".$get_Post_Id;
    $runPostQuery = mysqli_query($conn, $showPostSQL);

    $Title ="";
    $Description ="";
    $Image ="";
    $Views="";
    $Author="";
    $Category="";

    if($runPostQuery==true){                       
        while($my_data = mysqli_fetch_array($runPostQuery)){            
            $Title =$my_data["title"];
            $Description =$my_data["description"];
            $Image =$my_data["image"];
            $Views=$my_data["views"];
            $Author=$my_data["name"];
            $Category=$my_data["category"];
        }
    }
    
   
    /* Increse Views */
     //Insert to Database
     $Views_New = $Views + 1;     
     $sql_update = "UPDATE `technews` SET `views`='$Views_New' WHERE id=".$get_Post_Id;
     $run_cmd_update = mysqli_query($conn, $sql_update);      
   
?>

<body>
    <div class="container">
        <div class="post-details">
            <h1><?php echo $Title ?></h1>
            <p><i class="fas fa-user"></i> লেখক : <span><?php echo $Author ?></span></p>
            <p><i class="fas fa-eye"></i>মোট দেখা হয়েছে : <span><?php echo $Views ?> বার</span></p>
            <p><i class="fas fa-list"></i> ক্যাটাগরী : <span><?php echo $Category ?></span></p>
            <img src="uploads/<?php echo $Image ?>" alt="">
            <p class="description">
                <?php echo nl2br($Description);?>
            </p>
        </div>


        <div class="similar-post">
            <h5>এ সম্পর্কিত আরও পড়ুন</h5>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php                    
                    $showSimilarPostSQL = "SELECT TN.`id`, TN.`title`, TN.`description`, TN.`image`, TN.`views`, AU.name, CT.category FROM `technews` AS TN INNER JOIN author AS AU ON TN.author = AU.id INNER JOIN category AS CT ON TN.category=CT.id WHERE CT.category='$Category' LIMIT 8;";
                    $runSimilarPostQuery = mysqli_query($conn, $showSimilarPostSQL);

                    if($runSimilarPostQuery==true){                       
                        while($my_data = mysqli_fetch_array($runSimilarPostQuery)){
                        ?>
                        <div class="post col-md-3">
                            <a href="post.php?id=<?php echo $my_data["id"];?>">
                            <div class="card h-100 post-card">
                            <img src="uploads/<?php echo $my_data["image"];?>" class="img-fluid card-img-top" alt="...">
                            <div class="card-body post-body">
                                <h6 class="card-title pt-2"><?php echo $my_data["title"];?></h6>
                            </div>
                            <div class="card-footer post-footer">
                                <div class="author-views">
                                    <div class="author">
                                        <p><i class="fas fa-user"></i><?php echo $my_data["name"];?></p>
                                    </div>
                                    <div class="views">
                                        <p><i class="fas fa-eye"></i><?php  echo "Views: ".$my_data["views"];?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            </div>                           
                            </a>

                </div>
                <?php }
                        }
                ?>

            </div>

        </div>


    </div>
    <?php 
        include("footer.html");        
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
</body>

</html>
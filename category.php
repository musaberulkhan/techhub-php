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

<body>
    <?php 
        include("db_config.php");
        include("navigation-front.html");
        if(isset($_REQUEST["category"]))
        $categoryId = $_REQUEST["category"]; 
        else {
            $categoryId = "all";
        }
        
    ?>
    <div class="container mb-5">
        <!----------- Get Category Name and Display ----------->
        <?php
            if($categoryId == "all"){
            ?>
        <h2 class="text-center my-4">সকল ক্যাটাগরী </h2>
        <?php               
            }
            else{    
                $getCategoryNameSQL = "SELECT `category` FROM `category` WHERE id='".$categoryId."'";                
                $getCategoryNameQuery = mysqli_query($conn, $getCategoryNameSQL);
                if($getCategoryNameQuery==true){                       
                    while($my_data = mysqli_fetch_array($getCategoryNameQuery)){
                    ?>
                        <h2 class="text-center my-4">ক্যাটাগরী: <?php echo $my_data['category'] ?> </h2>
                    <?php  
                    } 
                }    
            }                     

        ?>
        <h2></h2>
        <!--*****************************     All Post       ***************************************-->
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php 
                if($categoryId == "all"){                   
                    $showAllPostSQL = "SELECT TN.`id`, TN.`title`, TN.`description`, TN.`image`, TN.`views`, AU.name, CT.category FROM `technews` AS TN INNER JOIN author AS AU ON TN.author = AU.id INNER JOIN category AS CT ON TN.category=CT.id ORDER BY id DESC;";
                }
                else{   
                    $showAllPostSQL = "SELECT TN.`id`, TN.`title`, TN.`description`, TN.`image`, TN.`views`, AU.name, CT.category FROM `technews` AS TN INNER JOIN author AS AU ON TN.author = AU.id INNER JOIN category AS CT ON TN.category=CT.id WHERE TN.category='".$categoryId."' ORDER BY id DESC;";
                }                  
                
                $runAllPostQuery = mysqli_query($conn, $showAllPostSQL);
                if($runAllPostQuery==true){                       
                    while($my_data = mysqli_fetch_array($runAllPostQuery)){
                 ?>

            <div class="col px-md-2 px-4">
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
            <?php
                                }
                            }
                                ?>

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
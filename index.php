<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Hub</title>
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
    ?>
    <div class="container">
        <!--*****************************     Featured News        ***************************************-->
        <div class="row">
            <div class="col-lg-9 col-md-12 col-12">
                <?php
                            $showFeaturedPostSQL = "SELECT `id`, `title`, `description`, `image` FROM `technews` ORDER BY id DESC LIMIT 1";
                            $runFeaturedPostQuery = mysqli_query($conn, $showFeaturedPostSQL);

                            if($runFeaturedPostQuery==true){                       
                                while($my_data = mysqli_fetch_array($runFeaturedPostQuery)){
                                    ?>

                <a class="anchor-header" href="post.php?id=<?php echo $my_data["id"];?>">
                    <div class="row featured-post-card mb-5 px-md-1 px-4">
                        <div class="col-md-6 featured-post-thumbnail">
                            <img class="img-fluid card-img-top" src="uploads/<?php echo $my_data["image"];?>" alt="">
                        </div>
                        <div class="col-md-6 featured-post-body mt-md-0 mt-3">
                            <h4><?php echo $my_data["title"];?></h4>
                            <p><?php echo substr($my_data["description"],0, strpos($my_data["description"], ' ', 650))."......"; ?>
                            </p>
                            <button>বিস্তারিত পড়ুন</button>
                        </div>
                    </div>
                </a>

                <?php
                                }
                            }
                        ?>


                <!--*****************************     Regular News        ***************************************-->
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php 
                            $TotalPosts = 0;
                            $showPostCountSQL = "SELECT COUNT(id) FROM `technews`";
                            $runPostCountQuery = mysqli_query($conn, $showPostCountSQL);

                            if($runPostCountQuery==true){
                                while($my_data = mysqli_fetch_array($runPostCountQuery)){
                                    $TotalPosts= $my_data["COUNT(id)"];
                                }
                            } 
                            
                            $showAllPostSQL = "SELECT TN.`id`, TN.`title`, TN.`description`, TN.`image`, TN.`views`, AU.name, CT.category FROM `technews` AS TN INNER JOIN author AS AU ON TN.author = AU.id INNER JOIN category AS CT ON TN.category=CT.id ORDER BY id DESC LIMIT 1,15;";
                            $runAllPostQuery = mysqli_query($conn, $showAllPostSQL);

                            if($runAllPostQuery==true){                       
                                while($my_data = mysqli_fetch_array($runAllPostQuery)){
                             ?>

                    <div class="col px-md-2 px-4">
                        <a href="post.php?id=<?php echo $my_data["id"];?>">
                            <div class="card h-100 post-card">
                                <img src="uploads/<?php echo $my_data["image"];?>" class="img-fluid card-img-top"
                                    alt="...">
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
                <div class="d-flex justify-content-center my-5">
                    <a href="category.php" class="btn btn-primary all-post-btn">সকল পোস্ট</a>
                </div>
            </div>


            <!--*****************************     Most Viwed News        ***************************************-->
            <div class="col-lg-3 col-md-12 col-12 most-views">
                <h5 class="most-views-title">সর্বাধিক পঠিত</h5>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-1 g-3">
                    <?php 
                            $showMostViewdPostSQL = "SELECT TN.`id`, TN.`title`, TN.`description`, TN.`image`, TN.`views`, AU.name, CT.category FROM `technews` AS TN INNER JOIN author AS AU ON TN.author = AU.id INNER JOIN category AS CT ON TN.category=CT.id ORDER BY views DESC LIMIT 5;";
                            $runMostViewdPostQuery = mysqli_query($conn, $showMostViewdPostSQL);

                            if($runMostViewdPostQuery==true){                       
                                while($my_data = mysqli_fetch_array($runMostViewdPostQuery)){
                             ?>

                    <div class="col">
                        <a href="post.php?id=<?php echo $my_data["id"];?>">
                            <div class="card h-100 post-card">
                                <img src="uploads/<?php echo $my_data["image"];?>" class="img-fluid card-img-top"
                                    alt="...">
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
        </div>
    </div>


    <!-- ------------------------------------------------------------------------------------------------------
                                                Top Tech Masters
    ----------------------------------------------------------------------------------------------------------->
    <section class="top-techmasters container">
        <div class="top-techmasters-title">
            <h1>টপ <span>টেক-মাস্টার</span></h1>
        </div>
        <div class="row">
            <!-- -------------------------       Most Post Column             ------------------------------------->
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <h3 class="text-center my-4"><i class="fas fa-file-alt me-2"></i>সর্বোচ্চ পোস্ট</h3>
                <div style="background-color: #f0f0f0;" class="techmaster-list">
                    <table>                        
                            <?php
                            $showMostPostAuthorSQL = "SELECT AU.name, COUNT(TN.id) AS totalpost, AU.image FROM `author` AS AU INNER JOIN `technews` AS TN ON TN.author=AU.id GROUP BY AU.username ORDER BY COUNT(TN.id) DESC LIMIT 3";
                            $runMostPostAuthorQuery = mysqli_query($conn, $showMostPostAuthorSQL);

                            if($runMostPostAuthorQuery==true){ 
                                $crown_increment = 0;                      
                                while($my_data = mysqli_fetch_array($runMostPostAuthorQuery)){
                             ?>
                            <tr>
                            <td>
                                <i style="<?php
                                    $crown_increment++;
                                    if($crown_increment==1){
                                        echo "color:#ffc400";
                                    }
                                    elseif($crown_increment==2){
                                        echo "color:#8f8f8f";
                                    }
                                    elseif($crown_increment==3){
                                        echo "color:#CD7F32";
                                    }                                    
                                ?>" class="fas fa-crown"></i>
                            </td>
                            <td>
                                <div class="techmaster">
                                    <div class="techmaster-image">
                                        <img class="img-fluid" src="images/<?php echo $my_data["image"]?>" alt="">
                                    </div>
                                    <div class="techmaster-details">
                                        <h5><?php echo $my_data["name"]?></h5>
                                        <p>মোট পোস্ট: <span><?php echo $my_data["totalpost"]?></span></p>
                                    </div>
                                </div>
                            </td>
                            <?php
                                }
                                ?>
                                
                                </tr>
                            <?php
                                 }
                            ?>     
                    </table>
                </div>
            </div>

            

            <!-- -------------------------       Most Views             ----------------------------------- -->
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <h3 class="text-center my-4"><i class="fas fa-eye me-2"></i>সর্বোচ্চ ভিউ</h3>
                <div style="background-color: #fffce6;" class="techmaster-list">
                    <table>                        
                            <?php
                            $showMostViewsAuthorSQL = "SELECT AU.name, SUM(TN.views) AS totalviews, AU.image FROM `author` AS AU INNER JOIN `technews` AS TN ON TN.author=AU.id GROUP BY AU.username ORDER BY SUM(TN.views) DESC LIMIT 3";
                            $runMostViewsAuthorQuery = mysqli_query($conn, $showMostViewsAuthorSQL);

                            if($runMostViewsAuthorQuery==true){ 
                                $crown_increment = 0;                      
                                while($my_data = mysqli_fetch_array($runMostViewsAuthorQuery)){
                             ?>
                            <tr>
                            <td>
                                <i style="<?php
                                    $crown_increment++;
                                    if($crown_increment==1){
                                        echo "color:#ffc400";
                                    }
                                    elseif($crown_increment==2){
                                        echo "color:#8f8f8f";
                                    }
                                    elseif($crown_increment==3){
                                        echo "color:#CD7F32";
                                    }                                    
                                ?>" class="fas fa-crown"></i>
                            </td>
                            <td>
                                <div class="techmaster">
                                    <div class="techmaster-image">
                                        <img class="img-fluid" src="images/<?php echo $my_data["image"]?>" alt="">
                                    </div>
                                    <div class="techmaster-details">
                                        <h5><?php echo $my_data["name"]?></h5>
                                        <p>মোট ভিউ: <span><?php echo $my_data["totalviews"]?></span></p>
                                    </div>
                                </div>
                            </td>
                            <?php
                                }
                                ?>
                                
                                </tr>
                            <?php
                                 }
                            ?>       
                    </table>
                </div>
            </div>



             <!-- -------------------------       Trending             ----------------------------------- -->
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <h3 class="text-center my-4"><i class="fas fa-sort-amount-up me-2"></i>ট্রেন্ডিং টেক-মাস্টার</h3>
                <div style="background-color: #f2fdff;" class="techmaster-list">
                    <table>                        
                            <?php
                            $showTrendingAuthorSQL = "SELECT AU.name, (SUM(TN.views) +COUNT(TN.id)*10) AS totalpoint, AU.image FROM `author` AS AU INNER JOIN `technews` AS TN ON TN.author=AU.id GROUP BY AU.username ORDER BY totalpoint DESC LIMIT 3;";
                            $runTrendingAuthorQuery = mysqli_query($conn, $showTrendingAuthorSQL);

                            if($runTrendingAuthorQuery==true){ 
                                $crown_increment = 0;                      
                                while($my_data = mysqli_fetch_array($runTrendingAuthorQuery)){
                             ?>
                            <tr>
                            <td>
                                <i style="<?php
                                    $crown_increment++;
                                    if($crown_increment==1){
                                        echo "color:#ffc400";
                                    }
                                    elseif($crown_increment==2){
                                        echo "color:#8f8f8f";
                                    }
                                    elseif($crown_increment==3){
                                        echo "color:#CD7F32";
                                    }                                    
                                ?>" class="fas fa-crown"></i>
                            </td>
                            <td>
                                <div class="techmaster">
                                    <div class="techmaster-image">
                                        <img class="img-fluid" src="images/<?php echo $my_data["image"]?>" alt="">
                                    </div>
                                    <div class="techmaster-details">
                                        <h5><?php echo $my_data["name"]?></h5>
                                        <p>মোট পয়েন্ট: <span><?php echo $my_data["totalpoint"]?></span></p>
                                    </div>
                                </div>
                            </td>
                            <?php
                                }
                                ?>
                                
                                </tr>
                            <?php
                                 }
                            ?>     
                    </table>
                </div>
            </div>
        </div>
    </section>




    <!-- ------------------------------------------------------------------------------------------------------
                                                Computer Section
    ----------------------------------------------------------------------------------------------------------->

    <section class="computer" id="computer">
        <div class="container-fluid computer-background">
            <img src="images/computer-section-bg.jpg" class="img-fluid" alt="">
            <h1 class="section-title">কম্পিউটার</h1>
        </div>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php 
                            $showAllPostSQL = "SELECT TN.`id`, TN.`title`, TN.`description`, TN.`image`, TN.`views`, AU.name, CT.category FROM `technews` AS TN INNER JOIN author AS AU ON TN.author = AU.id INNER JOIN category AS CT ON TN.category=CT.id WHERE TN.category='1001' ORDER BY id DESC LIMIT 8;";
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
        <div class="d-flex justify-content-center my-5">
            <a href="category.php?category=1001" class="btn btn-primary all-post-btn">সকল কম্পিউটার সংক্রান্ত পোস্ট</a>
        </div>
    </section>


    <!-- ------------------------------------------------------------------------------------------------------
                                                Mobile Section
    ----------------------------------------------------------------------------------------------------------->

    <section class="mobile" id="mobile">
        <div class="container-fluid mobile-background">
            <img src="images/mobile-section-bg.jpg" class="img-fluid" alt="">
            <h1 class="section-title">মোবাইল</h1>
        </div>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php 
                            $showAllPostSQL = "SELECT TN.`id`, TN.`title`, TN.`description`, TN.`image`, TN.`views`, AU.name, CT.category FROM `technews` AS TN INNER JOIN author AS AU ON TN.author = AU.id INNER JOIN category AS CT ON TN.category=CT.id WHERE TN.category='1002' ORDER BY id DESC LIMIT 8;";
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
        <div class="d-flex justify-content-center my-5">
            <a href="category.php?category=1002" class="btn btn-primary all-post-btn">সকল মোবাইল সংক্রান্ত পোস্ট</a>
        </div>
    </section>


     <!-- ------------------------------------------------------------------------------------------------------
                                                Software Section
    ----------------------------------------------------------------------------------------------------------->
    <section class="software" id="software">
        <div class="container-fluid software-background">
            <img src="images/software-section-bg.jpg" class="img-fluid" alt="">
            <h1 class="section-title">সফটওয়্যার</h1>
        </div>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php 
                            $showAllPostSQL = "SELECT TN.`id`, TN.`title`, TN.`description`, TN.`image`, TN.`views`, AU.name, CT.category FROM `technews` AS TN INNER JOIN author AS AU ON TN.author = AU.id INNER JOIN category AS CT ON TN.category=CT.id WHERE TN.category='1003' ORDER BY id DESC LIMIT 8;";
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
        <div class="d-flex justify-content-center my-5">
            <a href="category.php?category=1003" class="btn btn-primary all-post-btn">সকল সফটওয়্যার সংক্রান্ত পোস্ট</a>
        </div>
    </section>


    <?php 
        include("footer.html");        
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
</body>

</html>
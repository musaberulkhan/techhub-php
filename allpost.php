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
        <div class="row p-4">
            <div class="col-12">
                <h2 class="text-center">All Post</h2>
                <table class="allpost-table">
                    <tr>
                        <th>Post Id</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Published Time</th>
                        <th>Views</th>
                        <th>Action</th>
                    </tr>
                    <?php 
                            // $TotalPosts = 0;
                            // $showPostCountSQL = "SELECT COUNT(id) FROM `technews`";
                            // $runPostCountQuery = mysqli_query($conn, $showPostCountSQL);

                            // if($runPostCountQuery==true){
                            //     while($my_data = mysqli_fetch_array($runPostCountQuery)){
                            //         $TotalPosts= $my_data["COUNT(id)"];
                            //     }
                            // } 
                            
                            $showAllPostSQL = "SELECT TN.`id`, TN.`title`, TN.`description`, TN.`image`, TN.`views`, CT.category, TN.time FROM `technews` AS TN INNER JOIN author AS AU ON TN.author = AU.id INNER JOIN category AS CT ON TN.category=CT.id WHERE TN.author=$LOGGEDUSER_Id ORDER BY id DESC";
                            $runAllPostQuery = mysqli_query($conn, $showAllPostSQL);

                            if($runAllPostQuery==true){                       
                                while($my_data = mysqli_fetch_array($runAllPostQuery)){
                            ?>
                    <tr>
                        <td><?php echo $my_data['id']; ?></td>
                        <td class="thumbnail"><img src="uploads/<?php echo $my_data['image'];?>" alt=""></td>
                        <td><?php echo $my_data['title']; ?></td>
                        <td><?php echo substr($my_data["description"],0, strpos($my_data["description"], ' ', 100))."......"; ?>
                        </td>
                        <td><?php echo $my_data['category']; ?></td>
                        <td><?php echo $my_data['time']; ?></td>
                        <td><?php echo $my_data['views']; ?></td>
                        <td class="action"><a href="editpost.php?id=<?php echo $my_data['id']; ?>"><i
                                    class="fas fa-edit"></i></a>||<a
                                href="delete.php?id=<?php echo $my_data['id'];?>"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>

                    <?php
                                }
                            }
                    ?>

                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
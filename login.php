<?php
    if(isset($_COOKIE["LOGGEDUSER"]))    
    {
        header("location:admin.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Hub Admin Login</title>
    <link rel="icon" href="images/fav-icon.png" sizes="32x32" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="stylesheet/login.css">
    
</head>
<body>

    <section>
        <div class="container">
            <h1>Tech Hub Admin Login</h1>
            <img src="images/fav-icon.png" alt="">
            <p>Every moment is a fresh beginning</p>
            <div class="login">
                  <form action="action\login_action.php" method="post">                      
                      <input class="form-textbox" type="email" placeholder="Registered Email Address" name="email">                      
                      <input class="form-textbox" type="password" placeholder="Password" name="password">
                      <input type="" name="pagename" value="login" hidden=true> 
                      <input class="login-button" type="submit" value="Login">
                  </form>
                  <a href="">Forget Password?</a>
                  <a href="">Don't have an Account? Register Now</a>
            </div>
            <div class="login-error">
            <p style="text-align:center; color:red; margin-top:50px; font-size; 16px; font-weight:bold;">
            <?php 
            if(isset($_REQUEST["action"])){
                echo $_REQUEST["action"];
            }
            ?>
        </p>
    </div>
        </div>
    </section>


   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>

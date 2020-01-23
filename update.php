<?php
require 'db_connection.php';
if(isset($_GET['id']) && is_numeric($_GET['id'])){
   
    $userid = $_GET['id'];
    $get_user = mysqli_query($conn,"SELECT * FROM `users` WHERE id='$userid'");
    
    if(mysqli_num_rows($get_user) === 1){
        
        $row = mysqli_fetch_assoc($get_user);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update data</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
     <div class="container">
      
       <!-- UPDATE DATA -->
        <div class="form">
            <h2>Update Data</h2>
            <form action="" method="post">
                <strong>Username : </strong><br>
                <input type="text" autocomplete="off" name="username" placeholder="Enter your full name" value="<?php echo $row['username'];?>" required><br>
<br>
<br>
                <strong>Email : </strong><br>
                <input type="email" autocomplete="off" name="email" placeholder="Enter your email" value="<?php echo $row['user_email'];?>" required><br>
                <br>
<br>
                <strong>Gender : </strong><br>
              
                <input type="radio" name="gender" value="female">Female
                <input type="radio" name="gender" value="male">Male
                <input type="radio" name="gender" value="other">Other
                <br>
                <br>

                
            
                

                <strong>Hobby : </strong><br>

                <input type="checkbox" name="hobby" value="music" />Music
                <input type="checkbox" name="hobby" value="movies" />Movies
                <input type="checkbox" name="hobby" value="games" />Games
                <input type="checkbox" name="hobby" value="travel" />Travel
                <input type="checkbox" name="hobby" value="reading" />Reading


                <br>    
<br>
                <strong>Address : </strong><br>
                <textarea name="address" autocomplete="off"  placeholder="Enter your Address" value="<?php echo $row['user_address'];?>" required></textarea>
                <br>
<br>
<br>       

                <strong>Country : </strong><br>
                <select name="country" autocomplete="off"  value="<?php echo $row['user_country'];?>"required>
                <option value="India">India</option><br>
                    <option value="America">America</option><br>
                    <option value="Japan">Japan</option><br>
                    <option value="Russia">Russia</option><br>
                    <option value="France">France</option><br>
                    <option value="Germany">Germany</option><br>
                    <option value="England">England</option><br>
                    <option value="Italy">Italy</option><br>
                <br>
                <br>

                <strong>Update</strong><br>
                <input type="submit" value="Update">

               
            </form>
        </div>
        <!-- END OF UPDATE DATA SECTION -->
    </div>
</body>
</html>
<?php

    }else{
        // set header response code
        http_response_code(404);
        echo "<h1>404 Page Not Found!</h1>";
    }
    
}else{
    // set header response code
    http_response_code(404);
    echo "<h1>404 Page Not Found!</h1>";
}


/* ---------------------------------------------------------------------------
------------------------------------------------------------------------------ */


// UPDATING DATA

if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['gender']) && isset($_POST['address']) && isset($_POST['hobby']) && isset($_POST['country'])){
    
    // check username and email empty or not
    if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['gender']) && !empty($_POST['address']) && !empty($_POST['hobby']) && !empty($_POST['country'])){
        
        // Escape special characters.
        $username = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username']));
        $user_email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
        $user_gender = mysqli_real_escape_string($conn, htmlspecialchars($_POST['gender']));
        $user_address = mysqli_real_escape_string($conn, htmlspecialchars($_POST['address']));
        $user_hobby = mysqli_real_escape_string($conn, htmlspecialchars($_POST['hobby']));
        $user_country = mysqli_real_escape_string($conn, htmlspecialchars($_POST['country']));
        
        //CHECK EMAIL IS VALID OR NOT
        if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $user_id = $_GET['id'];
            // CHECK IF EMAIL IS ALREADY INSERTED OR NOT
            $check_email = mysqli_query($conn, "SELECT `user_email` FROM `users` WHERE user_email = '$user_email' AND id != '$user_id'");
            
            if(mysqli_num_rows($check_email) > 0){    
                
                echo "<h3>This Email Address is already registered. Please Try another.</h3>";
                
                
            }else{
                
                // UPDATE USER DATA               
                $update_query = mysqli_query($conn,"UPDATE `users` SET username='$username',user_email='$user_email',user_gender='$user_gender',user_address='$user_address',user_hobby='$user_hobby',user_country='$user_country' WHERE id=$user_id");

                //CHECK DATA UPDATED OR NOT
                if($update_query){
                    echo "<script>
                    alert('Data Updated');
                    window.location.href = 'index.php';
                    </script>";
                    exit;
                }else{
                    echo "<h3>Opps something wrong!</h3>";
                }
           
                
                
            }
            
            
        }else{
            echo "Invalid email address. Please enter a valid email address";
        }
        
    }else{
        echo "<h4>Please fill all fields</h4>";
    }
    
}

// END OF UPDATING DATA

?>


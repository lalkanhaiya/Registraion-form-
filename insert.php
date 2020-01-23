<?php
require 'db_connection.php';

//"isset" function on any variable to determine if it has been set or not
if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['gender']) && isset($_POST['address']) && isset($_POST['hobby']) && isset($_POST['country'])){
    
    // check all variables empty or not
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
            
            // CHECK IF EMAIL IS ALREADY INSERTED OR NOT
            $check_email = mysqli_query($conn, "SELECT `user_email` FROM `users` WHERE user_email = '$user_email'");
            
            if(mysqli_num_rows($check_email) > 0){    
                
                echo "<h3>This Email Address is already registered. Please Try another.</h3>";
                
            }else{
                
                // INSERT USERS DATA INTO THE DATABASE
                $insert_query = mysqli_query($conn,"INSERT INTO `users`(username,user_email,user_gender,user_address,user_hobby,user_country) VALUES('$username','$user_email','$user_gender','$user_address','$user_hobby','$user_country')");

                //CHECK DATA INSERTED OR NOT
                if($insert_query){
                    echo "<script>
                    alert('Data inserted');
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
    
}else{
    // set header response code
    http_response_code(404);
    echo "<h1>404 Page Not Found!</h1>";
}
?>
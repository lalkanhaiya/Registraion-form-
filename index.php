<?php
require 'db_connection.php';
// function for getting data from database
function get_all_data($conn){
    $get_data = mysqli_query($conn,"SELECT * FROM `users`");
    if(mysqli_num_rows($get_data) > 0){
        echo '<table>
              <tr>
                <th>Username</th>
                <th>Email</th> 
                <th>Gender</th> 
                <th>Address</th> 
                <th>Hobby</th> 
                <th>Country</th> 
                <th>Action</th> 
              </tr>';
        while($row = mysqli_fetch_assoc($get_data)){
           
            echo '<tr>
            <td>'.$row['username'].'</td>
            <td>'.$row['user_email'].'</td>
            <td>'.$row['user_gender'].'</td>
            <td>'.$row['user_address'].'</td>
            <td>'.$row['user_hobby'].'</td>
            <td>'.$row['user_country'].'</td>
            <td>
             <a href="update.php?id='.$row['id'].'">Edit</a>&nbsp;|
            <a href="delete.php?id='.$row['id'].'">Delete</a>
            </td>
            </tr>';

        }
        echo '</table>';
    }else{
        echo "<h3>No records found. Please insert some records</h3>";
    }
}
?>
<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
      
       <!-- INSERT DATA -->
        <div class="form">
            <h2>Insert Form Data</h2>
            <form action="insert.php" method="post">
                <strong>Username :</strong><br>
                <input type="text" name="username" placeholder="Enter your full name" required><br>
                <br>
                <br>
                <strong>Email :</strong><br>
                <input type="email" name="email" placeholder="Enter your email" required><br>
                <br>
                <br>
                <strong>Gender : </strong>
                <input type="radio" name="gender" value="female">Female
                <input type="radio" name="gender" value="male">Male
                <input type="radio" name="gender" value="other">Other
                 <br>
                <br>
                 <strong>Address : </strong><br>
                 <br>
                
                 <textarea name="address" placeholder="Enter your address" required></textarea><br>
                 <br>
                <br>
                 <strong>Hobby : </strong>
            
                <input type="checkbox" name="hobby" value="music" />Music
                <input type="checkbox" name="hobby" value="movies" />Movies
                <input type="checkbox" name="hobby" value="games" />Games
                <input type="checkbox" name="hobby" value="travel" />Travel
                <input type="checkbox" name="hobby" value="reading" />Reading
                <br>
                <br>
                <br>
                <br>

                <strong>Country : </strong><br>
            
                <select name="country">
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
                <br>
                <br>
                <input type="submit" value="Insert">
                <br>
                <br>
            </form>
        </div>
        <!-- END OF INSERT DATA SECTION -->
        <hr>
        <!-- SHOW DATA -->
        <h2>Show Data</h2>
        <?php 
        // calling get_all_data function
        get_all_data($conn); 
        ?>
        <!-- END OF SHOW DATA SECTION -->
    </div>
</body>

</html>
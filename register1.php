<?php

session_start();

	//session_start();
	//$lifetime = 60 * 60 * 24 * 14; // 2 weeks in seconds
	//session_set_cookie_params($lifetime, '/');
 
   // Used for messages
   $msg = "";

   if (isset($_POST['register'])) {
  
       // If submitting form then process the form
       if ($_POST['username'] == '' || $_POST['password'] == '') {
           $msg = "Please fill in all fields before you click REGISTER!";
       } else {
      
           // Get data from the form
           $input['username'] = trim(htmlentities($_POST['username'], ENT_QUOTES));
           $input['password'] = trim(htmlentities($_POST['password'], ENT_QUOTES));

           $errorMsg = "";

           // Check for valid password
           //if (strlen($input['password']) <= '7') {
           //   $errorMsg = "Your Password Must Contain At Least 8 Characters!";
          // }
           
           if ($errorMsg == "") {

               // Database connecton
               require_once ('database.php');
    
               // Insert Username and Password into table
               $insertUser = "INSERT INTO users (username, password)
                              values (:username, :password)";
               $statement = $db->prepare($insertUser);
               
               //PDO method, prepared statement
               $statement->bindValue(':username',$input['username']);
               $statement->bindValue(':password',$input['password']);
               $statement->execute();
               $user=$statement->fetchAll();
               
                // Database connecton
               require_once ('database.php');
    
               // Get Username and Password from table
               $queryUsers = "SELECT username FROM users
                              WHERE username =:username
                                 AND password =:password";
               $statement1 = $db->prepare($queryUsers);
               
               //pdo method, prepared statement
               $statement1->bindParam(':username',$input['username']);
               $statement1->bindParam(':password',$input['password']);
               $statement1->execute();
               $user=$statement1->fetchAll();
            
           
               if ($statement1->rowCount()>0) {
                   $_SESSION['username'] = $input['username'];
                    
                    //Successful Login display comments
                    echo 'Successful Registration';
                    echo "<br>";
                    echo '<a href="index.php">Go to LOGIN page</a>';

               } else {
                    // Invalid Username or Password
                    $msg = "Invalid Username or Password!";
                }
           }
       }
   }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
	
	<body>
            <?php if ($msg != "") { ?>
            <p><span style="color: red;"><?php echo $msg; ?></span></p>
            <?php } ?>

            <!-- Register Form -->
            <h3> Register here </h3>
                <form action="register.php" method="POST">
                    <p>Username:<input type="text" name="username" required/></p>
                    <p>Password:<input type="password" name="password" required/></p>
                    <p><button type="submit" name="register"> REGISTER </button></p>
                    <br>
                    <!-- link to index page -->
                    <p><a href="index.php">Click here to LOGIN</a></p> 

                </form>
    </body>
</html>
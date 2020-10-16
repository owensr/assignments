<?php
	// Start session
    $lifetime = 60 * 60 * 24 * 14;    // 2 weeks in seconds
    session_set_cookie_params($lifetime, '/');
    session_start();

	// Check if already logged in
	if (isset($_SESSION['login_username'])) {
    	header("Location: index.php");
	}

	$msg1 = "";
	$msg2 = "";

	if (isset($_POST['login'])) {
	
		// If submitting login form then process the form
        if ($_POST['login_username'] == '' || $_POST['login_password'] == '') {
           $msg1 = "Please fill in all fields before you click LOGIN!";
        } else {
		
			// Get data from the login form
            $input['login_username'] = trim(htmlentities($_POST['login_username'], ENT_QUOTES));
            $input['login_password'] = trim(htmlentities($_POST['login_password'], ENT_QUOTES));

            // Database connecton
            require_once ('database.php');

            // Get Username and Password from table
            $queryUsers = "SELECT username FROM users
                           WHERE username =:login_username
                               AND password =:login_password";
            $statement = $db->prepare($queryUsers);
			
            //PDO method, prepare statement
            $statement->bindParam(':login_username',$input['login_username']);
            $statement->bindParam(':login_password',$input['login_password']);
            $statement->execute();
            $user=$statement->fetchAll();

			//Determine if Username and Password are correct
            if ($statement->rowCount()>0) {
               $_SESSION['login_username'] = $input['login_username'];
            
               echo "Successfull LOGIN";
			   echo "<br>";
               echo '<a href="view_comment.php">View Comments</a>';
               include('view_comment.php');

            } else {
			    // Invalid Username or Password
               $msg1 = "Invalid Username or Password!";
			}
		}
	} else if (isset($_POST['register'])) {
		
		// If submitting form then process the registration form
        if ($_POST['register_username'] == '' || $_POST['register_password'] == '') {
            $msg2 = "Please fill in all fields before you click REGISTER!";
        } else {
		
			// Get data from the form
            $input['username'] = trim(htmlentities($_POST['register_username'], ENT_QUOTES));
            $input['password'] = trim(htmlentities($_POST['register_password'], ENT_QUOTES));

			$passwordError = "";
			
			// Determine if Password meets requirements
			if (strlen($input['password']) <= '7') {
				$passwordError = "Your Password Must Contain At Least 8 Characters!";
			} elseif (!preg_match("#[0-9]+#", $input['password'])) {
				$passwordError = "Your Password Must Contain At Least 1 Number!";
			} elseif (!preg_match("#[A-Z]+#", $input['password'])) {
				$passwordError = "Your Password Must Contain At Least 1 Capital Letter!";
			} elseif (!preg_match("#[a-z]+#", $input['password'])) {
				$passwordError = "Your Password Must Contain At Least 1 Lowercase Letter!";
			}
			
			if ($passwordError == "") {

                // Database connecton
                require_once ('database.php');
    
                // Insert Username and Password into table
                $insertUser = "INSERT INTO users (username, password)
                               VALUES (:username, :password)";
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
                    //$_SESSION['username'] = $input['username'];
                    
                    //Successful Login display comments
                    echo 'Successful Registration';
                    echo "<br>";
                    echo 'Please LOGIN now';

                } else {
                    // Invalid Username or Password
                    $msg2 = "Invalid Username or Password!";
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
   </head>
  
   <body>
		<?php if ($msg1 != "") { ?>
		<p><span style="color: red;"><?php echo $msg1; ?></span></p>
		<?php } ?>

		<!-- Login Form -->
		<h3> LOGIN here </h3>
		<form action="index.php" method="POST">
			<p>Username:<input type="text" name="login_username" required/></p>
			<p>Password:<input type="password" name="login_password" required/></p>
			<p><button type="submit" name="login"> LOGIN  </button></p>
			<br>
		</form>
		
		 <?php if ($msg2 != "") { ?>
		<p><span style="color: red;"><?php echo $msg2; ?></span></p>
		<?php } ?>

		<!-- Register Form -->
		<h3> Do not have an account then REGISTER here </h3>
			<form action="index.php" method="POST">
				<p>Username:<input type="text" name="register_username" required/></p>
				<p>Password:<input type="password" name="register_password" required/></p>
				<p><button type="submit" name="register"> REGISTER </button></p>
			</form>
    </body>
		
	</body>
</html>
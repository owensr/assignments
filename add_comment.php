<?php
    // Check if already logged in
	if (!isset($_SESSION['login_username'])) {
    	session_start();;
	}

    // Check if already logged in
	//if (!isset($_SESSION['login_username'])) {
    //	header("Location: index.php");
	//}
    
    // Get the comment from the form
    $comment = filter_input(INPUT_POST, 'comment');
   
    $error_message = " "; 

    // Validate form input
    if ($comment === '' || $comment === NULL) {
        $error_message = 'You must enter a comment - '.$comment; 
        include('error.php');
    } else {
        // Database connection
        require_once ('database.php');
        
        // Set date/time prior to insert
        $datetime=date("y-m-d h:i:s"); 
        
        // Add comment to the database
    	$query = 'INSERT INTO comments
        	        (comment, time) 
        		  VALUES
        		    (:comment, :time)';
        		    
	    $statement = $db->prepare ($query); 
	    $statement->bindValue(':comment', $comment); 
	    $statement->bindValue(':time', $datetime); 
	    $statement->execute (); 
        $statement->closeCursor();
        
        // Display the Comment Page
        include('index.php');
    }
?>
    
    


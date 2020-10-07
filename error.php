<!-- Error File -->
<!DOCTYPE html> 
<html> 
    <!-- the head section -->
    <head> 
        <title>Assignment 3</title> 
        <link rel="stylesheet" type="text/css" href="main.css">
    </head> 
    
    <!-- the body section --> 
    <body>
        <main>
            <h1>Comment Error</h1>
            <p>There was an error inserting the comment.</p> 
            <p>Please enter a comment again.</p> 
            <p>Error message: <?php echo $error_message; ?></p>  
            <br>
            <!-- link to add a comment -->
            <p><a href="add_comment_form.php">Add Comment</a></p> 
        </main>    
       
        
    </body>
</html>
<!-- Database Error File -->
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
            <h1>Database Error</h1>
            <p>There was an error connecting to the database.</p> 
            <p>Please verify that the Apache or Tomcat server are running.</p> 
            <p>Error message: <?php echo $error_message; ?></p>            
        </main>       
    </body>
</html>
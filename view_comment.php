<?php

    // Check if already logged in
	if (!isset($_SESSION['login_username'])) {
    	session_start();;
	}


    // Check if already logged in
	//if (!isset($_SESSION['login_username'])) {
    //	header("Location: index.php");
	//}
    
    // Database connecton
    require_once ('database.php');
    
    // Select all comments from table                     
    $queryAllComments = 'SELECT * FROM comments';

    $statement = $db->prepare($queryAllComments);
    $statement->execute(); 
    $comments = $statement->fetchAll();
    $statement->closeCursor();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Assignment 4</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
<main>
    <h1>Assignment 4</h1>
        <section>
            <!--Display a table of the comments -->
            <h2><?php echo 'Comments :'; ?></h2>
		<table>
 		    <tr>
			<th>ID</th> 
                        <th>Comment</th> 
                        <th>Time</th> 
		    </tr>
			
		    <?php foreach ($comments as $comment) :  ?> 
                    <tr>
                        <td><?php echo $comment['id']; ?></td>
                        <td><?php echo $comment['comment']; ?></td> 
                        <td><?php echo $comment['time']; ?></td> 
                    </tr>
		    <?php endforeach; ?>
		</table>
            
        <!-- link to add a comment -->
		<p><a href="add_comment_form.php">Add Comment</a></p> 
        </section>
</main>
</body>
</html>
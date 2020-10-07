<?php
    $dsn = 'mysql:host=localhost;dbname=id14881006_assignments';
    $username = 'id14881006_mgs_user1'; // root
    $password = 'P@55w0rd2020';         // 'BN8lnGpEY9dqWsAP'
    
    try {
            $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>

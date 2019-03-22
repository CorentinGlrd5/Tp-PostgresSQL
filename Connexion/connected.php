<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<?php
    
    session_start();

    require 'dbconfig.php';
    $dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";
     
    try{
     // create a PostgreSQL database connection
    $conn = new PDO($dsn);
    echo"connected";
    
    }catch (PDOException $e){
     // report error message
    echo "Fail";
    }
        
?>
    
</body>
</html>
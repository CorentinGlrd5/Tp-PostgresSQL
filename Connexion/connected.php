<?php
    
    session_start();

    require 'dbconfig.php';
    $dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";
     
    try{
     // create a PostgreSQL database connection
    $conn = new PDO($dsn);
    $message="Welcome $username !";
    echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
    
    }catch (PDOException $e){
     // report error message
    echo "Database is not available :(";
    }
        
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Codmoa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>


    
</body>
</html>
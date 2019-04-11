<?php
    
    session_start();

    require 'dbconfig.php';
    $dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";
     
    try{
        // create a PostgreSQL database connection
       $conn = new PDO($dsn);
       $_SESSION['cledsn'] = $dsn;
       $message="Welcome $username !";
       echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
       
       }catch (PDOException $e){
        // report error message
        header('Location: /Tp-PostgresSQL/Errors/connection.html');
       }
        
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Codmoa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/connection.css" />
</head>
<body>
    <a href="../index.php" class="deco">Déconnexion !</a>
    <div class="middle">
        <h1>Que voulez-vous faire ?</h1>
        <div class="container">
            <a href="../interface/creaSchema.php">CREATE Schema</a>
            <a href="../interface/configTable.php">CREATE Table</a>
            <a href="../interface/creaRoles.php">Gestion des roles utilisateurs</a>
            <a href="../interface/chargeFich.php">Charger un fichier</a>
            
        </div>
    </div>
</body>
</html>
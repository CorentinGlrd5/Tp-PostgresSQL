<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
</head>
<body>
    <h1>Création d'un nouveau schéma</h1>

    <?php
    session_start();
    $conn = new PDO($_SESSION['cledsn']);
    $pdoStat = $conn->prepare('SELECT distinct schema_name FROM information_schema.schemata');

    $executeIsOK = $pdoStat->execute();
    $select = $pdoStat->fetchAll();
    foreach ($select as $value) {
        var_dump($value[0]);
    }
    
    ?>
</body>
</html>
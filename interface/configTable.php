<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Codmoa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/creatTable.css" />
</head>
<body>
    <a href="../index.php">Déconnexion !</a>
    <div class="middl">
        <div class="start">
        <h2>Choissisez le schema ou vous voulez créer la table :</h2>
            <?php
            session_start();
            try{
                $conn = new PDO($_SESSION['cledsn']);
            }catch (PDOException $e){
                // report error message
                header('Location: /Tp-PostgresSQL/Errors/connection.html');
            }
            echo '<form action="creaTable.php" method="post">';
            $pdoStat = $conn->prepare('SELECT distinct schema_name FROM information_schema.schemata');
            $executeIsOK = $pdoStat->execute();
            $selectsche = $pdoStat->fetchAll();

            foreach ($selectsche as $value) {    
                echo '<input type="checkbox" name="schema"  value="'.$value["schema_name"].'"> '.$value['schema_name'];
                echo '<br>';       
            }
            ?>
                <input type="text" placeholder="Entrez le nombre de colonne" name="nbcolone"> 
                <input type="submit" value=" Crée"/>
            </form>
        </div>
    </div>
</body>
</html>
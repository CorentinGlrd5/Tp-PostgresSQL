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
        <h1>Création d'un nouveau schéma</h1>
            <form action="" method="post">
                <input type="text" name="namesch" placeholder="Nom du schéma">
                <input type="submit" value="crée un schéma"/>
            </form>
            <h2>Liste des schema deja crée</h2>
            <ul>
            <?php
            session_start();
            try{
                $conn = new PDO($_SESSION['cledsn']);
            }catch (PDOException $e){
                // report error message
            echo "Database is not available :(";
            }

            if (isset($_POST["namesch"])&& $_POST["namesch"]!=" ") {
                var_dump($_POST["namesch"]);
                $pdoStat = $conn->prepare('SELECT distinct schema_name FROM information_schema.schemata');
                $executeIsOK = $pdoStat->execute();
                $selectsche = $pdoStat->fetchAll();

                foreach ($selectsche as $value) {           
                    echo'<li>'.$value["schema_name"].'</li>';
                    if ($value["schema_name"]===$_POST["namesch"]) {
                        echo '<script type="text/javascript">window.alert("Ce nom est deja utiliser veuillez recommencer !");</script>';
                        $nameOK=false;
                        break;
                    }
                    $nameOK=true;
                }
                if($nameOK){
                    try{
                        $pdoStatCreatSche = $conn->prepare('CREATE SCHEMA '.$_POST["namesch"]);
                        $executeIsOKforsche = $pdoStatCreatSche->execute();
                        echo '<script type="text/javascript">window.alert("nous n\'avons pas trouvé de correspondanse avec un schema deja existant alors nous avons créer '.$_POST["namesch"].'");</script>';
                    }catch(PDOException $e){
                        // report error message
                    echo "exception";
                    }
                }
            }
            else {
                $pdoStat = $conn->prepare('SELECT distinct schema_name FROM information_schema.schemata');
                $executeIsOK = $pdoStat->execute();
                $selectsche = $pdoStat->fetchAll();

                foreach ($selectsche as $value) {
                    echo'<li>'.$value["schema_name"].'</li>'; 
                }
                echo " <h2>Veulliez créer un schema valide ! </h2>";
            }
            ?>
            </ul>
        </div>
    </div>
</body>
</html>
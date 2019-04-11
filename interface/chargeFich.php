<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Charger un Fichier</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/fichierPlat.css" />
    <script src="main.js"></script>
</head>
<body>
        <a href="../index.php">Déconnexion !</a>
        <div class="start">
            <h2>Charger votre fichier .txt avec vos requètes SQL dedans !</h2>
            <form method="post" action="" enctype="multipart/form-data">
                <input type="file" name="FichPLAT"/>
                <input type="submit" value="IMPORTER">
            </form>

            <?php
                session_start();
                try{
                    $conn = new PDO($_SESSION['cledsn']);
                }catch (PDOException $e){
                    // report error message
                echo "Database is not available :(";
                }
                if (isset($_FILES['FichPLAT']['size']) && $_FILES['FichPLAT']['size']>0) {
                    echo '<h3>Requètes executée :</h3>';
                    rename($_FILES['FichPLAT']['tmp_name'],'../images/'.$_FILES['FichPLAT']['name']);
                    $file = '../images/'.$_FILES['FichPLAT']['name'];
                    $handle = fopen($file,'r');
                    $content = fread($handle,filesize($file));
                    fclose($handle);
                    $tabString = explode(';',$content);
                    foreach ($tabString as $value) {
                        $pdoStat = $conn->prepare($value);
                        $executeIsOK = $pdoStat->execute();
                        echo $value.'<br>';
                    };
                    echo '<script type="text/javascript">window.alert("Nous avons executer vos requete dans votre fichier");</script>';
                };
            ?>
        </div>   
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/creatTable.css" />
</head>
<body>
    
    <div class="middl">
        <div class="start">
        <h2>Choissisez le schema ou vous voulez créer la table :</h2>
            <form action="" method="post" >
            
                <?php
                session_start();
                try{
                    $conn = new PDO($_SESSION['cledsn']);
                }catch (PDOException $e){
                    // report error message
                echo "Database is not available :(";
                }
                if (isset($_POST["nbcolone"])) {
                    $_SESSION["nbcolone"]=$_POST["nbcolone"];
                    $_SESSION["schema"]=$_POST["schema"];
                    echo '<input type="text" required placeholder="Nom de la table" name="nomtable"/><br>';
                    echo ' Choisissez votre clé primaire <br>';
                    for ($i=1; $i <= $_POST["nbcolone"]; $i++) { 
                        echo '<input type="checkbox" name="primary" class="incheckbox" value="'.$i.'">';
                        echo '<input type="text" required placeholder="Nom de colone '.$i.'" name="nomcolone'.$i.'">';
                        echo '<input type="text" required placeholder="Type de '.$i.'" name="typecolone'.$i.'"><br>';
                    }
                }else{
                    $sql="CREATE TABLE ".$_SESSION["schema"].".";
                    $sql .=$_POST["nomtable"];
                    $sql .="(";
                    for ($i=1; $i < $_SESSION["nbcolone"] ; $i++) { 
                        $sql .=$_POST["nomcolone".$i];
                        $sql .= " ";
                        $sql .=$_POST["typecolone".$i];
                        
                        if ($_POST["primary"]=$i) {
                            $sql .= " PRIMARY KEY NOT NULL";
                        }
                        $sql .= ",";
                    }
                    $sql .=$_POST["nomcolone".$_SESSION["nbcolone"]];
                    $sql .= " ";
                    $sql .=$_POST["typecolone".$_SESSION["nbcolone"]];
                    if ($_POST["primary"]=$_SESSION["nbcolone"]) {
                        $sql .= " PRIMARY KEY NOT NULL";
                    }
                    $sql .=")";
                    $pdoStatCreatSche = $conn->prepare($sql);
                    $executeIsOKforsche = $pdoStatCreatSche->execute();
                    echo '<script type="text/javascript">window.alert("Création Ok!");</script>';
                    header('Location: /Tp-PostgresSQL/interface/configTable.php');
                }
                ?>
                <input type="submit" value=" Crée"/>
            </form>
        </div>
    </div>
</body>
</html>
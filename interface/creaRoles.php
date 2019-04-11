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
<div class="middl">
        <div class="start">
            <h1>Choissisez l'utilisateur auquel vous voulez définire ses roles.</h1>

            <h2>Liste des utilisateurs :</h2>
            <form action="" method="post">
            <ul>

                <?php
                session_start();
                try{
                    $conn = new PDO($_SESSION['cledsn']);
                }catch (PDOException $e){
                    // report error message
                echo "Database is not available :(";
                };

                $pdoStat = $conn->prepare("SELECT u.usename AS UserName FROM pg_catalog.pg_user u;");
                $executeIsOK = $pdoStat->execute();
                $selectsche = $pdoStat->fetchAll();

                foreach ($selectsche as $value) {           
                    echo'<li>'.$value["username"].'</li>';
                }

                ?>
            </ul>

                <input type="text" name="userName" placeholder="Nom de l'utilisateur">

            <ul>
                <input type="checkbox" name="Select" value="Bike"> Sélectioner<br>
                <input type="checkbox" name="Insert" value="Car"> Insérer<br>
                <input type="checkbox" name="Update" value="Bike"> Modifier<br>
                <input type="checkbox" name="Delete" value="Bike"> Supprimer<br>
            </ul>

                <input type="submit" name="changeRoles" value="Modifier ses Roles"/>

            </form>
            <?php


            if (isset($_POST['changeRoles'])) {
                $user = $_POST['userName'];
                $select = $_POST['Select'];
                $insert = $_POST['Insert'];
                $update = $_POST['Update'];
                $delete = $_POST['Delete'];
                // $pdoStat = $conn->prepare("SELECT u.usename AS UserName FROM pg_catalog.pg_user u;");
                // $executeIsOK = $pdoStat->execute();
                // $selectsche = $pdoStat->fetchAll();
                echo($user + $select + $insert + $update + $delete);


            };
            ?>
        </div>
    </div>
</body>
</html>
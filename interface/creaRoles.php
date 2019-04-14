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
            <h1>Choissisez l'utilisateur auquel vous voulez définire ses roles.</h1>

            <h2>Liste des utilisateurs :</h2>
            <form action="" method="post">
            <ul>
                <!-- ici, on verifie si l'utilisateur est bien connecter à la base de donnée avant de pouvoir naviguer sur cette page. -->
                <?php
                session_start();
                try{
                    $conn = new PDO($_SESSION['cledsn']);
                }catch (PDOException $e){
                    // report error message
                    header('Location: /Tp-PostgresSQL/Errors/connection.html');
                };
                // ici, on affiche les utilisateur disponnible dans la base de donnée
                $showUsers = $conn->prepare("SELECT u.usename AS UserName FROM pg_catalog.pg_user u;");
                $executeIsOK = $showUsers->execute();
                $selectsche = $showUsers->fetchAll();

                foreach ($selectsche as $value) {           
                    echo'<li>'.$value["username"].'</li>';
                }

                ?>
            </ul>

                <input type="text" name="userName" placeholder="Nom de l'utilisateur" required>

            <ul>
                <input type="checkbox" name="select" value="SELECT"> Sélectioner<br>
                <input type="checkbox" name="insert" value="INSERT"> Insérer<br>
                <input type="checkbox" name="update" value="UPDATE"> Modifier<br>
                <input type="checkbox" name="delete" value="DELETE"> Supprimer<br>
            </ul>

                <input type="submit" name="changeRoles" value="Modifier ses Roles"/>

            </form>
            <?php

                // ici, on atribue les roles en fonction de l'utilisateur qu'il aura choisi ainsi que les roles qu'il aura selectionnée avec les checkbox.
            if (isset($_POST['changeRoles'])) {
                    $user = $_POST['userName'];
                    $pdoConnect = $conn->prepare("GRANT CONNECT ON DATABASE test TO $user;");
                    $executeIsOK = $pdoConnect->execute();
                    $selectsche = $pdoConnect->fetchAll();
                    $pdoUsage = $conn->prepare("GRANT USAGE ON SCHEMA testschemas1 TO $user;");
                    $executeIsOK = $pdoUsage->execute();
                    $selectsche = $pdoUsage->fetchAll();
                    $pdoRevoke = $conn->prepare("REVOKE SELECT, INSERT, UPDATE, DELETE ON ALL TABLES IN SCHEMA testschemas1 TO $user;");
                    $executeIsOK = $pdoRevoke->execute();
                    $selectsche = $pdoRevoke->fetchAll();

                    if (isset($_POST['select'])) {
                        $pdoGrant = $conn->prepare("GRANT SELECT ON ALL TABLES IN SCHEMA testschemas1 TO $user;");
                        $executeIsOK = $pdoGrant->execute();
                        $selectsche = $pdoGrant->fetchAll();
                    };
                    if (isset($_POST['insert'])) {
                        $pdoGrant = $conn->prepare("GRANT INSERT ON ALL TABLES IN SCHEMA testschemas1 TO $user;");
                        $executeIsOK = $pdoGrant->execute();
                        $selectsche = $pdoGrant->fetchAll();
                    };
                    if (isset($_POST['update'])) {
                        $pdoGrant = $conn->prepare("GRANT UPDATE ON ALL TABLES IN SCHEMA testschemas1 TO $user;");
                        $executeIsOK = $pdoGrant->execute();
                        $selectsche = $pdoGrant->fetchAll();
                    };
                    if (isset($_POST['delete'])) {
                        $pdoGrant = $conn->prepare("GRANT DELETE ON ALL TABLES IN SCHEMA testschemas1 TO $user;");
                        $executeIsOK = $pdoGrant->execute();
                        $selectsche = $pdoGrant->fetchAll();
                    };
                    $messageSuccess="Les roles ont bien été changés !";
                    echo '<script type="text/javascript">window.alert("'.$messageSuccess.'");</script>';
                };

                
            ?>
        </div>
    </div>
</body>
</html>
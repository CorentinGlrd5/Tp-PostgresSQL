<?php
// ici nous allons créer une session. Pour ce faire, nous récupérons les données nom et password du formulaire index.php pour les stocker dans une session, puis nous allons dans connection.php pour se connaicter à la base de donnée avec cette la session que nous venons de créer.
session_start();

$_SESSION['nom'] = $_POST['nom'];   
$_SESSION['password'] = $_POST['password'];

header('Location: /Tp-PostgresSQL/Connexion/connected.php');
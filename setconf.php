<?php
session_start();

$_SESSION['nom'] = $_POST['nom'];   
$_SESSION['password']   = $_POST['password'];

header('Location: /Tp-PostgresSQL/connected.php');
<?php 

require 'src/bootstrap.php';
require 'src/Calendar/Month.php';
require 'src/Calendar/Events.php';

    $pdo = get_pdo();
    $getLoginUtilisateur = $_GET['login'];
    $reqUtilisateur = $pdo->prepare('SELECT * FROM id12822867_projetweb.UTILISATEUR WHERE UTILISATEUR.login = ?');
    $reqUtilisateur->execute(array($getLoginUtilisateur));
    $utilisateurInfo = $reqUtilisateur->fetch();


    if(isset($_GET['id'])){
     $id = $_GET['id'];
     $sql = "DELETE FROM id12822867_projetweb.EVENEMENT WHERE id = $id";
     $pdo->exec($sql);
    }
    header("Location: /planning/success/0/login/".$_GET['login']."");
?>
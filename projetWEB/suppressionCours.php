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
    $idCours = $_GET['id'];
    $pdo =get_pdo();
    $sql = "DELETE FROM id12822867_projetweb.COURS WHERE idCours = $idCours";
    $pdo->exec($sql);
    header("Location: cours.php?login=".$_GET['login']."");
}


?>
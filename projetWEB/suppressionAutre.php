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
    $idAutre = $_GET['id'];
    $pdo =get_pdo();
    $sql = "DELETE FROM id12822867_projetweb.AUTRE WHERE idAutre = $idAutre";
    $pdo->exec($sql);
    header("Location: /autre/login/".$_GET['login']."");
    exit();
}


?>
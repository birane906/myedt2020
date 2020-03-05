<?php 

require 'src/bootstrap.php';
require 'src/Calendar/Month.php';
require 'src/Calendar/Events.php';

    $pdo = get_pdo();
    $getLoginUtilisateur = $_GET['login'];
    $reqUtilisateur = $pdo->prepare('SELECT * FROM projetWEB.UTILISATEUR WHERE UTILISATEUR.login = ?');
    $reqUtilisateur->execute(array($getLoginUtilisateur));
    $utilisateurInfo = $reqUtilisateur->fetch();

if(isset($_GET['id'])){
    $idCours = $_GET['id'];
    $pdo =get_pdo();
    $sql = "DELETE FROM projetWEB.COURS WHERE idCours = $idCours";
    $pdo->exec($sql);
    echo "oui";
    header("Location: cours.php?login=".$_GET['login']."");
  
  
}


?>
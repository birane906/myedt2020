<?php 

require 'src/bootstrap.php';
require 'src/Calendar/Month.php';
require 'src/Calendar/Events.php';

    $pdo = get_pdo();
    $getLoginUtilisateur = $_GET['login'];
    echo $getLoginUtilisateur;
    $reqUtilisateur = $pdo->prepare('SELECT * FROM projetWEB.UTILISATEUR WHERE UTILISATEUR.login = ?');
    $reqUtilisateur->execute(array($getLoginUtilisateur));
    $utilisateurInfo = $reqUtilisateur->fetch();


    if(isset($_GET['id'])){
     $id = $_GET['id'];
     $sql = "DELETE FROM projetWEB.EVENEMENT WHERE id = $id";
     $pdo->exec($sql);
    }
    header("Location: planning.php?success=0&login=".$_GET['login']."");
  
  
//}


?>
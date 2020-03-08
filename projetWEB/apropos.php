<?php 
  require 'src/bootstrap.php';
  require 'src/Calendar/Month.php';
  require 'src/Calendar/Events.php';
  
  $pdo = get_pdo();
    if(isset($_COOKIE['login']) and isset($_GET['login'])){

     $getLoginUtilisateur = $_GET['login'];
    $reqUtilisateur = $pdo->prepare('SELECT * FROM id12822867_projetweb.UTILISATEUR WHERE UTILISATEUR.login = ?');
    $reqUtilisateur->execute(array($getLoginUtilisateur));
    $utilisateurInfo = $reqUtilisateur->fetch();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>A propos - MyEDT</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 <link rel="stylesheet" href="/css/cours.css">
 <link rel="stylesheet" href="/css/calendar.css">
</head>
<body class="col">
<?php echo '<a href="/accueil/login/'.$utilisateurInfo['login'].'">🏠</a>';?><br/>
<div class="container">
<h1 class="center">A Propos</h1>
<br/><br/>

<div class="container">
  <p>
  Dans la vie étudiante ou scolaire, nombreux sont ceux qui planifient
leurs révisions à l’avance. Mais, nous constatons que très peu d’outils leur
permettant d’automatiser la planification de leurs révisions sont mis à
disposition des étudiants ou élèves.<br/>
C’est ainsi qu’à l’occasion de son projet WEB, Birane BA, élève de Polytech Montpellier en IG3, a choisi de faire une application
permettant de planifier, gérer l’emploi du temps de révision des étudiants mais
en plus offre d’autres fonctionnalités telles que télécharger leur cours, leurs
documents liés à leur insertion professionnelle (CV et lettres de motivation) et
d’autres types de documents de leur choix.
  </p>
</div>
</body>
</html>
<?php }?>
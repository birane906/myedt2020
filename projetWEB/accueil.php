<?php 

session_start();
require 'src/bootstrap.php';
require 'src/Calendar/Events.php';
$pdo = get_pdo();
//var_dump($_COOKIE['login']);
if(isset($_COOKIE['login'])){

  $getLoginUtilisateur = $_COOKIE['login'];
  $reqUtilisateur = $pdo->prepare('SELECT * FROM projetWEB.UTILISATEUR WHERE UTILISATEUR.login = ?');
  $reqUtilisateur->execute(array($getLoginUtilisateur));
  $utilisateurInfo = $reqUtilisateur->fetch();

?>


<!Doctype html>
 <html>
 
 <head>
 <meta charset="UTF-8">
 <title>Accueil - MyEDT</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 <link rel="stylesheet" href="/css/accueil.css">
 </head>
 
 <body> 

<nav class="nav " >
  <p class="text">Bienvenue dans myEDT <?php echo $getLoginUtilisateur; ?> </p>
  <ol >
    <?php echo '<li class="menu-item"><a href="accueil.php?login='.$getLoginUtilisateur.'">Accueil</a></li>'; ?>
    
    <li class="menu-item">
      <?php echo '<a href="profil.php?login='.$getLoginUtilisateur.'">Profil</a>'; ?>
      
    </li>
    <?php echo '<li class="menu-item"><a href="planning.php?login='.$utilisateurInfo['login'].'">Planning</a></li>'; ?>
    <?php echo '<li class="menu-item"><a href="cours.php?login='.$utilisateurInfo['login'].'">Cours</a></li>'; ?>
    <?php echo '<li class="menu-item"><a href="pro.php?login='.$utilisateurInfo['login'].'">CV / Lettre</a></li>'; ?>
    <?php echo '<li class="menu-item"><a href="autre.php?login='.$utilisateurInfo['login'].'">Autres</a></li>'; ?>
    <?php echo '<li class="menu-item"><a href="#">Contactez nous</a></li>'; ?>
    <li class="menu-item"><a href="#0">A propos</a></li>   
    <?php echo '<li class="menu-item"><a href="deconnexion.php">Déconnexion</a></li>'; ?>
  
  </ol>
</nav>


<?php 
require 'views/footer.php';
}
?>
<?php 

session_start();
require 'src/bootstrap.php';
require 'src/Calendar/Events.php';
$pdo = get_pdo();
if(isset($_COOKIE['login']) and isset($_GET['login'])){
  
  $getLoginUtilisateur = $_GET['login'];
  $reqUtilisateur = $pdo->prepare('SELECT * FROM id12822867_projetweb.UTILISATEUR WHERE UTILISATEUR.login = ?');
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
  <p class="text">Bienvenue dans myEDT <?php echo $_GET['login']; ?> </p>
  <ol >
    <?php echo '<li class="menu-item"><a href="/accueil/login/'.$getLoginUtilisateur.'">Accueil</a></li>'; ?>
    <li class="menu-item">
      <?php echo '<a href="/profil/login/'.$getLoginUtilisateur.'">Profil</a>'; ?>
    </li>
    <?php echo '<li class="menu-item"><a href="/planning/login/'.$utilisateurInfo['login'].'">Planning</a></li>'; ?>
    <?php echo '<li class="menu-item"><a href="/cours/login/'.$utilisateurInfo['login'].'">Cours</a></li>'; ?>
    <?php echo '<li class="menu-item"><a href="/pro/login/'.$utilisateurInfo['login'].'">CV / Lettre</a></li>'; ?>
    <?php echo '<li class="menu-item"><a href="/autre/login/'.$utilisateurInfo['login'].'">Autres</a></li>'; ?>
    <?php echo '<li class="menu-item"><a href="https://mail.google.com/mail/u/0/#inbox?compose=CllgCHrlFSnbnbPxqHxJwQXHCQrxWVWkmrnHnwSsWmjTmFFlNPPRhjKvBsLFCDzWMFMjvkzbkXB">Contactez nous</a></li>' ; ?> 
    <?php echo '<li class="menu-item"><a href="#">A propos</a></li>'; ?>
    <?php echo '<li class="menu-item"><a href="/deconnexion.php">Déconnexion</a></li>'; ?>
   
  </ol>
</nav>


<?php 
require 'views/footer.php';
}

?>
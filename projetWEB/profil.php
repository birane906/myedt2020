<?php 
require 'src/bootstrap.php';
require 'src/Calendar/Events.php';
$pdo = get_pdo();

if(isset($_GET['login']) and isset($_COOKIE['login'])){

  $getLoginUtilisateur = $_GET['login'];
  $reqUtilisateur = $pdo->prepare('SELECT * FROM id12822867_projetweb.UTILISATEUR WHERE UTILISATEUR.login = ?');
  $reqUtilisateur->execute(array($getLoginUtilisateur));
  $utilisateurInfo = $reqUtilisateur->fetch();
?>


<!Doctype html>
 <html>
 
 <head>
 <meta charset="UTF-8">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 <link rel="stylesheet" href="/css/cours.css">
 <link rel="stylesheet" href="/css/calendar.css">
 <title>Mon profil - MyEDT </title>
 </head>
 
 <body class="col"> 
 <?php echo '<a href="/accueil/login/'.$_GET['login'].'">🏠</a>';?>
 <?php echo '<a href="/deconnexion.php">📴</a>';?><br/>

    <div class="container">
<table class="table">
      <tr class="tr titre"> 
      <h1 class="center">Profil de <?php echo $utilisateurInfo['login']; ?> </h1>
    </tr><br/> <br/>
    <tr class="tr titre">
        <td>
      Login
      </td>
      <td>
      Prénom 
    </td>
        <td>      
       Nom
        </td> 
        
      </tr>

      <tr>
        <td>
        <?php echo $utilisateurInfo['login']; ?>
      </td>
      <td>
      <?php echo $utilisateurInfo['prenomUtilisateur']; ?>
    </td>
        <td>      
        <?php echo $utilisateurInfo['nomUtilisateur']; ?>
        </td> 
        
      </tr>
      </table>
      <br/><br/>
      <?php
      if ( isset($utilisateurInfo['login'])){
        ?>
      
      <?php echo '<a href="/editionLogin/login/'.$utilisateurInfo['login'].'" class="btn btn-warning">Changer mon login</a>'; ?>
      <?php echo '<a href="/editionMdp/login/'.$utilisateurInfo['login'].'" class="btn btn-warning">Changer mon mot de passe</a>' ; ?>
  
      
      <?php 
      }
      ?>


    </div>
  </body>
</html>

<?php 
}
?>
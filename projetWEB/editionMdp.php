<?php 
require 'src/bootstrap.php';
require 'src/Calendar/Events.php';
$pdo = get_pdo();

if(isset($_GET['login'])){
  $utilisateurInfo = $_GET['login'];
  $reqUtilisateur = $pdo->prepare('SELECT * FROM projetWEB.UTILISATEUR WHERE UTILISATEUR.login = ?');
  $reqUtilisateur->execute(array($utilisateurInfo)); 
  $utilisateur = $reqUtilisateur->fetch();
  
  if(isset($_POST['nouveauMdp1']) and !empty($_POST['nouveauMdp1']) and isset($_POST['nouveauMdp2']) and !empty($_POST['nouveauMdp2'])){
    $mdp1 = h($_POST['nouveauMdp1']);
    $mdp2 = h($_POST['nouveauMdp2']);

    if($mdp1 == $mdp2){
      if(strlen($mdp1) >= 6 and preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])#', $mdp1)){
        $insererMdp = $pdo->prepare("UPDATE projetWEB.UTILISATEUR SET UTILISATEUR.motDePasse = ? WHERE UTILISATEUR.idUtilisateur =?");
        $insererMdp->execute(array($mdp1, $utilisateur['idUtilisateur']));
        header('Location: profil.php?login='.$_GET['login']);
      } else {$msg = "Votre mot de passe doit contenir au moins 6 caractères, au moins une lettre majuscule et au moins un chiffre !";}
    }else{
      $msg = "Vos deux mots de passe ne correspondent pas !";
    }

  }

  
?>


<html>
  <head>
    <title>myEDT - Modifier Mot de passe</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel="stylesheet" href="/css/cours.css">
  <link rel="stylesheet" href="/css/calendar.css">
  </head>
  <body class="col">
  <?php echo '<a href="profil.php?login='.$_GET['login'].'">◀️ Retourner au profil</a>';?><br/>
    <div class="container">
      <table class="table">
      <tr class="tr titre">
      <h1 class="center">Changer mon mot de passe  </h1>
      </tr>
      <tr class="tr titre">
      <td>
      <form method="POST" action="">
      </td>
      <td>
      <label>Nouveau Mot de passe : </label>
      </td>
      <td>
      <input type="password" name="nouveauMdp1" placeholder="Nouveau mot de passe"  /> 
      </td>
      <tr class="tr titre">
      <td>
      <label>Confirmer nouveau mot de passe : </label>
      </td>
      <td>
      <input type="password" name="nouveauMdp2" placeholder="Confirmer nouveau mot de passe"  /> 
      </td>
      <tr>
      <input type="submit" value= "Sauvergarder les changements" /> <br/> <br/>
      </tr>
      </tr>
      </form>
     
      </tr>
      </table>
      </div>
      <?php
      if(isset($msg)){
        echo $msg;
      }

      ?>
  </body>
</html>

<?php 
}else{
  header('Location : connexion.php');
}
?>
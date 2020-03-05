<?php 
require 'src/bootstrap.php';
require 'src/Calendar/Events.php';
$pdo = get_pdo();
if(isset($_POST['formConnexion'])){
  $loginConnect = h($_POST['loginConnect']);
  $motDePasseConnect = h($_POST['motDePasseConnect']);
  if(!empty($loginConnect) AND !empty($motDePasseConnect)){
    $sql =("SELECT * FROM projetWEB.UTILISATEUR WHERE UTILISATEUR.login = ? AND UTILISATEUR.motDePasse = ?");
    $reqUtilisateur = $pdo->prepare($sql);
    $reqUtilisateur->execute(array($loginConnect, $motDePasseConnect));
    $utilisateurExist =$reqUtilisateur->rowCount() ;
    
    if($utilisateurExist == 1){
      $utilisateurInfo = $reqUtilisateur->fetch();
      $_COOKIE['idUtilisateur'] = $utilisateurInfo['idUtilisateur'];
      setcookie('login',$utilisateurInfo['login'],time() + 365*24*3600);
      header("Location: accueil/login/".$_COOKIE['login']);
      
    }else{
      $erreur ="Login ou Mot de passe incorrect !";
    }


  }else{
    $erreur ="Tous les champs doivent être remplis !";
  }



}

?>


<html>
  <head>
    <title>myEDT - Connexion</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/inscription.css" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

  </head>
  <body>
    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
    <div class="wrapper wrapper--w680">
    <div class="card card-1">
    <div class="card-heading"> <img src="/css/images/im.jpg"></div>
    <div class="card-body">
    <div style="text-align: right;">
    <a href="inscription.php"><input type="button" value="Inscription" class="bu"></a>
    <a href="connexion.php"><input type="button" value="Connexion" class="bu"></a>
    </div>
    <br/><br/>
      <h2 class="title">Connexion sur myEDT</h2>
      <br /><br />
      <form method="POST" action="">
          <div class="row row-space">
          <div class="col-2">
          <div class="input-group">
          <label for="loginConnect">Login :</label>
          <input type="text" name="loginConnect" placeholder="login" />
          </div>
          <?php
      if (isset($erreur)){
        echo '<font color="red">' .$erreur. '</font>';
      }
      
      ?>
          </div>
          
          <div class="col-2">
          <div class="input-group">
          <label for="motDePasseConnect">Mot de passe :</label>
          <input type="password" name="motDePasseConnect" placeholder="Mot de passe" />
          </div>
          </div>

          </div>
          <div class="p-t-20">
                <button class="btn btn--radius btn--green" type="submit" name="formConnexion">Se connecter</button>
          </div>
      </form>
     
      <br/>
      Toujours pas inscrit(e) ?
      <a href="inscription.php">Créer votre compte myEDT</a>

    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
 <?php 
require 'views/footer.php';
 ?>
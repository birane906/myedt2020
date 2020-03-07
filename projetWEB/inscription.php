<?php 
require 'src/bootstrap.php';
require 'src/Calendar/Events.php';
$pdo = get_pdo();
if(isset($_POST['formInscription'])){
  $prenomUtilisateur = h($_POST['prenomUtilisateur']);
  $nomUtilisateur = h($_POST['nomUtilisateur']);
  $login = h($_POST['login']);
  $motDePasse = h($_POST['motDePasse']);
  $motDePasse2 = h($_POST['motDePasse2']);

 if (!empty($_POST['prenomUtilisateur']) and !empty($_POST['nomUtilisateur']) and !empty($_POST['login']) and !empty($_POST['motDePasse']) and !empty($_POST['motDePasse2']) ){
   $loginlength = strlen($login);
   $mdplength = strlen($motDePasse);
    if ($loginlength <= 255 and $loginlength >= 3){

      $reqLogin = $pdo->prepare("SELECT * FROM id12822867_projetweb.UTILISATEUR WHERE login = ?");
      $reqLogin->execute(array($login));
      $loginExist = $reqLogin-> rowCount();
      if($loginExist == 0){
        if($motDePasse == $motDePasse2 and $mdplength >= 6){
            if(preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])#', $motDePasse)){
              $insererUtilisateur = $pdo->prepare("INSERT INTO id12822867_projetweb.UTILISATEUR(login,  motDePasse, nomUtilisateur, prenomUtilisateur) VALUES (?,?,?,?)");
              $insererUtilisateur->execute(array($login,$motDePasse,$nomUtilisateur,$prenomUtilisateur));
              $erreur=  "Votre compte a bien été créé ! <a href=\"index.php\">Me connecter</a>";
              $a = 0;
            }else{
              $erreur = "Votre mot de passe est non conforme ! Il doit au moins contenir un chiffre et au moins une majuscule.";
              $a = 6;
            }
        } else if($mdplength < 6){
          $erreur = "Votre mot de passe est trop court ! Merci d'en saisir un qui fait au moins 6 caractères.";
          $a = 5;
        }else{
          $erreur = "Vos mots de passes ne correspondent pas !";
          $a = 2;
        } 
      } else { 
        $erreur = "Ce login est déjà utilisé. Merci d'en saisir un autre valide !";
        $a =1;
      }
    }else if ($loginlength > 255){
     $erreur = "Votre login est trop long ! Il ne doit pas dépasser 255 caractères !";
     $a = 1;
    }else if ($loginlength < 3){
      $erreur ="Votre login trop court ! Il doit dépasser 2 caractères !";
      $a = 7;
   } else {
   $erreur ="Tous les champs doivent être remplis !";
   $a = 3;
 }
}
}


?>


<html>
  <head>
    <title>myEDT - Inscription</title>
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
    <a href="index.php"><input type="button" value="Connexion" class="bu"></a>
    </div>
    <br/><br/>
      <h2 class="title">Inscription sur myEDT</h2>
      
      
      <form method="POST" action="">
                <div class="row row-space">
                <div class="col-2">
                <div class="input-group">
                <label for="prenomUtilisateur"> Prénom :</label>
                <input type="text" placeholder="Votre prénom" id="prenomUtilisateur" name="prenomUtilisateur" value="<?php if(isset($prenomUtilisateur)) {echo $prenomUtilisateur;} ?>" />
                </div>
                </div>

                <div class="col-2">
                <div class="input-group">
                <label for="nomUtilisateur"> Nom :</label>
                <input type="text" placeholder="Votre nom" id="nomUtilisateur" name="nomUtilisateur" value="<?php if(isset($nomUtilisateur)) {echo $nomUtilisateur;} ?>" />
                </div>
                </div>
                </div>

                
                <div class="input-group">
                <label for="login">Login :</label>
                <input type="text" placeholder="Votre login" id="login" name="login" value="<?php if(isset($login)) {echo $login;} ?>"/>
                </div>
                <?php
                if (isset($erreur) and $a ==1){
                  echo '<font color="red">' .$erreur. '</font>';
                } 

                if (isset($erreur) and $a ==7){
                  echo '<font color="red">' .$erreur. '</font>';
                } 
                ?>
                
                

                <div class="row row-space">
                <div class="col-2">
                <div class="input-group">
                <label for="motDePasse">Mot de passe :</label>
                <input type="password" placeholder="Votre mot de passe" id="motDePasse" name="motDePasse" />
                </div>
                <?php
                if (isset($erreur) and $a ==2){
                  echo '<font color="red">' .$erreur. '</font>';
                } 

                if (isset($erreur) and $a ==5){
                  echo '<font color="red">' .$erreur. '</font>';
                } 

                if (isset($erreur) and $a ==6){
                  echo '<font color="red">' .$erreur. '</font>';
                } 


                ?>
                </div>
                
                
                <div class="col-2">
                <div class="input-group">
                <label for="motDePasse2">Confirmer mot de passe :</label>
                <input type="password" placeholder="Confirmer mot de passe" id="motDePasse2" name="motDePasse2" />
                </div>
                </div>
                </div>


                <div>
                <?php
                if (isset($erreur) and $a ==0){
                  echo $erreur;
                } 
                ?>
                </div>
                


                <div class="p-t-20">
                <button class="btn btn--radius btn--green" type="submit" name="formInscription">S'inscrire</button>
                </div>

                <br/>
                <div class="input-group">
                <?php
                if (isset($erreur) and $a ==3){
                  echo '<font color="red">' .$erreur. '</font>';
                } 
                ?>

                <br/>
                Avez vous déjà un compte myEDT ?
                <a href="index.php">Identifiez vous</a>
                </div>
        
      </form>
      
      </div>
      </div>
      </div>
      
    </div>
  </body>
</html>



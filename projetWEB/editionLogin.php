<?php 
require 'src/bootstrap.php';
require 'src/Calendar/Events.php';
$pdo = get_pdo();

if(isset($_COOKIE['login'])){
  $utilisateurInfo = $_COOKIE['login'];
  $reqUtilisateur = $pdo->prepare('SELECT * FROM id12822867_projetweb.UTILISATEUR WHERE UTILISATEUR.login = ?');
  $reqUtilisateur->execute(array($utilisateurInfo)); 
  $utilisateur = $reqUtilisateur->fetch();
  if(isset($_POST['nouveauLogin']) and !empty($_POST['nouveauLogin']) and ($_POST['nouveauLogin'] != $utilisateur['login'])){
    $login = h($_POST['nouveauLogin']);

    if(strlen($login) <= 3 or strlen($login) > 255) {
      $error ="Votre login doit avoir entre 3 et 255 caractères inclus !";
    } else {
      $reqUtilisateur->execute(array($login));
      $loginExist = $reqUtilisateur-> rowCount();
      if($loginExist == 0){
        $insererLogin = $pdo->prepare("UPDATE id12822867_projetweb.UTILISATEUR SET UTILISATEUR.login = ? WHERE UTILISATEUR.idUtilisateur = ?");
        $insererLogin->execute(array($login,$utilisateur['idUtilisateur']));
        $_COOKIE['login'] = $login;
        header('Location: /profil/login/'.$login);
        exit();
      }else{$error = "Ce login est déjà utilisé !";}
    }
  }
?>


<html>
  <head>
    <title>Modifier Login - MyEDT</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/cours.css">
 <link rel="stylesheet" href="/css/calendar.css">
  </head>
  <body class="col">
  <?php echo '<a href="/profil/login/'.$_GET['login'].'">◀️ Retourner au profil</a>';?><br/>
    <div class="container">
      <table class="table">
      <tr class="tr titre"> 
        <h1 class="center">Modifier mon login  </h1>
      </tr>
      <tr class="tr titre">
      <small class="text-muted">Si vous souhaitez ne rien modifier, cliquez sur le bouton "Enregistrer Modification" tout de même</small>
      </tr>
      <tr class="tr titre">
      <form method="POST" action="">
      <td>
      <label>Login : </label>
      </td>
      <td>
      <input type="text" name="nouveauLogin" placeholder="Nouveau Login" value="<?php echo $_COOKIE['login'];?>" /> <br/> <br/>
      </td>
      <td>
      <input type="submit" value= "Enregistrer Modification" /> <br/> <br/>
      </td>
      </form>
      </tr>
      
      </table>
      </div>
      <?php
      echo '<small class="center">';
      if(isset($error)){
        echo $error;
      }
      echo '</small>';
      ?>
  </body>
</html>

<?php 
}
?>
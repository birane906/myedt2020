<?php 
  require 'src/bootstrap.php';
  require 'src/Calendar/Month.php';
  require 'src/Calendar/Events.php';
  $pdo = get_pdo();

  if(isset($_COOKIE['login']) and isset($_GET['login'])){

    $getLoginUtilisateur = $_COOKIE['login'];
    $reqUtilisateur = $pdo->prepare('SELECT * FROM id12822867_projetweb.UTILISATEUR WHERE UTILISATEUR.login = ?');
    $reqUtilisateur->execute(array($getLoginUtilisateur));
    $utilisateurInfo = $reqUtilisateur->fetch();
  if(!empty($_FILES)){
    $libAutre = $_FILES['Autre']['name'];
    $AutreExtension = strrchr($libAutre,".");
    $libAutreTmp = $_FILES['Autre']['tmp_name'];
    $AutreDest = 'autre/'.$libAutre;
    $extensionsAutorisees =array('.pdf', '.PDF');
    if(in_array($AutreExtension,$extensionsAutorisees)){
      if(move_uploaded_file($libAutreTmp,$AutreDest)){
        $reqAutre = $pdo->prepare("INSERT INTO id12822867_projetweb.AUTRE(AUTRE.libAutre,AUTRE.urlAutre,AUTRE.idUtilisateur) VALUES (?,?,?) ");
        $reqAutre->execute(array($libAutre,$AutreDest,$utilisateurInfo['idUtilisateur']));
        echo "Fichier envoyé avec succès";
      }else{
        echo "Une erreur est survenue lors de l'envoi du fichier de cours";
      }
    }else{
      echo 'Seuls les fichiers PDF sont autorisés';
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/cours.css">
 <link rel="stylesheet" href="/css/calendar.css">
  <title>Autres Docs - MyEDT</title>
</head>
<body class="col">
  
<?php echo '<a href="/accueil/login/'.$utilisateurInfo['login'].'" >🏠</a>';?><br/>
<div class="container">
<h1 class="center">Ajouter un fichier</h1>
<small class="text-muted">Seuls les fichiers au format pdf sont autorisés (soient les extensions ".pdf" et ".PDF"! Il sera créé dans votre répertoire courant un dossier /cours/ où sera stocké tous les que vous téléchargerez.</small>
<br/><br/>
<form method="POST" enctype="multipart/form-data">
  <input type="file" name="Autre"><br/>
  <input type="submit" value="envoyer le fichier">
</form>
</div>
<br/><br/>
<div class="container">
  <h1 class="center">Autres Documents enregistrés</h1>
  <?php 
  $reqUtilisateur = $pdo->prepare('SELECT * FROM id12822867_projetweb.UTILISATEUR WHERE UTILISATEUR.login = ?');
  $reqUtilisateur->execute(array($getLoginUtilisateur));
  $utilisateurInfo = $reqUtilisateur->fetch();
    $req = $pdo->query('SELECT * FROM id12822867_projetweb.AUTRE WHERE idUtilisateur='.$utilisateurInfo["idUtilisateur"].'');
    
    echo '<table class="table">';
    echo '<tr class="tr titre">' ;
      echo '<td>';
      echo " Nom du fichier ";
      echo '</td>';
      echo '<td>';
      echo " Lien du fichier ";
      echo '</td>';
      echo '<td>';
      echo " Actions ";
      echo '</td>';
      echo '<td>';
      echo " Actions ";
      echo '</td>';
    echo '</tr>';
    while($data = $req->fetch()){
      echo '<tr class="tr">' ;
      echo '<td>';
      echo $data['libAutre'];
      echo '</td>';
      echo '<td>';
      echo '<a href="/'.$data['urlAutre'].'">'.$data['libAutre'].' </a> ';
      echo '</td>';
      echo '<td>';
      echo '<a href ="/modificationAutre/id/'.$data['idAutre'].'/login/'.$utilisateurInfo['login'].'" class="btn btn-warning"> Modifier </a>';
      echo '</td>';
      echo '<td>';
      echo '<a href="/suppressionAutre/id/'.$data['idAutre'].'/login/'.$utilisateurInfo['login'].'" onclick="return confirm(\'Etes vous sûr(e) de vouloir supprimer ce cours ?\');" class="btn btn-danger"> Supprimer </a>';
      echo '</td>';
      echo '<tr/>';
      
    }
    echo '</table>';
  ?>
  </div>
</body>
</html>

  <?php } ?>
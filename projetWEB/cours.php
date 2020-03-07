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
    $libCours = $_FILES['cours']['name'];
    $coursExtension = strrchr($libCours,".");
    $libCoursTmp = $_FILES['cours']['tmp_name'];
    $coursDest = 'cours/'.$libCours;
    $extensionsAutorisees =array('.pdf', '.PDF');
    if(in_array($coursExtension,$extensionsAutorisees)){
      if(move_uploaded_file($libCoursTmp,$coursDest)){
        $reqCours = $pdo->prepare("INSERT INTO id12822867_projetweb.COURS(COURS.libCours,COURS.urlCours,COURS.idUtilisateur) VALUES (?,?,?) ");
        $reqCours->execute(array($libCours,$coursDest,$utilisateurInfo['idUtilisateur']));
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
  <title>Mes Cours - MyEDT</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 <link rel="stylesheet" href="/css/cours.css">
 <link rel="stylesheet" href="/css/calendar.css">
</head>
<body class="col">
<?php echo '<a href="/accueil/login/'.$utilisateurInfo['login'].'">🏠</a>';?><br/>
<div class="container">
<h1 class="center">Ajouter un cours</h1>
<small class="text-muted">Seuls les fichiers au format pdf sont autorisés (soient les extensions ".pdf" et ".PDF"! Il sera créé dans votre répertoire courant un dossier /cours/ où sera stocké tous les que vous téléchargerez.</small>
<br/><br/>
<form method="POST" enctype="multipart/form-data">
  <input type="file" name="cours"><br/>
  <input type="submit" value="envoyer le fichier">
</form>
</div>
<br/><br/>
<div class="container">
  <h1 class="center">Liste des cours enregistrés</h1>
  <?php 
  $reqUtilisateur = $pdo->prepare('SELECT * FROM id12822867_projetweb.UTILISATEUR WHERE UTILISATEUR.login = ?');
  $reqUtilisateur->execute(array($getLoginUtilisateur));
  $utilisateurInfo = $reqUtilisateur->fetch();
  $req = $pdo->query('SELECT idCours, libCours, urlCours FROM id12822867_projetweb.COURS WHERE idUtilisateur = '.$utilisateurInfo["idUtilisateur"].'');
 
    
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
      echo $data['libCours'];
      echo '</td>';
      echo '<td>';
      echo '<a href="/'.$data['urlCours'].'">  '.$data['libCours'].' </a>';
      echo '</td>';
      echo '<td>';
      echo '<a href ="/modificationCours/id/'.$data['idCours'].'/login/'.$utilisateurInfo['login'].'" class="btn btn-warning"> Modifier </a>';
      echo '</td>';
      echo '<td>';
      echo '<a href="/suppressionCours/id/'.$data['idCours'].'/login/'.$utilisateurInfo['login'].'" onclick="return confirm(\'Etes vous sûr(e) de vouloir supprimer ce cours ?\');" class="btn btn-danger modif"> Supprimer </a>';
      echo '<td>';
      echo '</tr>';
      
    }
    echo '</table>';
  ?>
</div>
</body>
</html>

  <?php } ?>
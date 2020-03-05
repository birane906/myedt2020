<?php 
require 'src/bootstrap.php';
require 'src/Calendar/Month.php';
require 'src/Calendar/Events.php';
$libCours = "";
$idCours ="";
 if(isset($_GET['id'])){
  $idCours = $_GET['id'];
   $pdo =get_pdo();
   $sql = "SELECT * FROM projetWEB.COURS WHERE idCours = $idCours ";
   $result = $pdo->query($sql);
   $data = $result->fetchAll();
   $libCours = $data[0]['libCours'];
    $idCours = $data[0]['idCours'];
    

  }

 

 if(isset($_POST['libCours'])){
  $libCours = $_POST['libCours'] ;
  $pdo =get_pdo();
  $sql = "SELECT * FROM projetWEB.COURS WHERE idCours = $idCours ";
   $result = $pdo->query($sql);
   $data = $result->fetchAll();
   $idCours = $data[0]['idCours'];
   $sql2 ="UPDATE projetWEB.COURS SET libCours='$libCours' WHERE idCours = $idCours ";
   $pdo->exec($sql2);
   $login = $_GET['login'];
    header("Location: cours.php?login=$login");
 }

 
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/cours.css">
 <link rel="stylesheet" href="/css/calendar.css">
 <title>Modifier Document - MyEDT</title>
</head>
<body class="col">
<?php echo '<a href="cours.php?login='.$_GET['login'].'">◀️ Retourner aux cours</a>';?><br/>
<div class="container"> 
   <table class="table">
   <tr class="tr titre"> 
<h1 class="center">Modifier l'intitulé du document</h1>
</tr>
    <tr class="tr titre">
<small class="text-muted">Si vous souhaitez ne rien modifier, cliquez sur le bouton "Enregistrer Modification" tout de même</small>
</tr>
<tr class="tr titre">
<form method="POST" enctype="multipart/form-data">
<td>
<label for="libAutre">
  Intitulé du document
</label>  
</td>

<td>
  <input type="text" name="libCours" value="<?php echo $libCours; ?>">
  </td>
<td>
  <input type="submit" value="Modifier le libellé du cours">
  </td>
</form>
</tr>
</table>
</div>




  
</body>
</html>
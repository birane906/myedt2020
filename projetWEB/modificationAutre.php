<?php 
session_start();
require 'src/bootstrap.php';
require 'src/Calendar/Month.php';
require 'src/Calendar/Events.php';
$libAutre = "";
$idAutre ="";
 if(isset($_GET['id'])){
  $idAutre = $_GET['id'];
   $pdo =get_pdo();
   $sql = "SELECT * FROM projetWEB.AUTRE WHERE idAutre = $idAutre ";
   $result = $pdo->query($sql);
   $data = $result->fetchAll();
   $libAutre = $data[0]['libAutre'];
    $idAutre = $data[0]['idAutre'];
    

  }

 

 if(isset($_POST['libAutre'])){
  $libAutre = $_POST['libAutre'] ;
  $pdo =get_pdo();
  $sql = "SELECT * FROM projetWEB.AUTRE WHERE idAutre = $idAutre ";
   $result = $pdo->query($sql);
   $data = $result->fetchAll();
   $idAutre = $data[0]['idAutre'];
   $sql2 ="UPDATE projetWEB.AUTRE SET libAutre='$libAutre' WHERE idAutre = $idAutre ";
   $pdo->exec($sql2);
   $login = $_GET['login'];
    header("Location: autre.php?login=$login");
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
<?php echo '<a href="autre.php?login='.$_GET['login'].'">◀️ Retourner aux autres documents</a>';?><br/>
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
<input type="text" name="libAutre" value="<?php echo $libAutre; ?>">
</td>
<td>
  <input type="submit" value="Enregistrer Modification">
  </td>
</form>
</tr>
</table>
</div>


  
</body>
</html>
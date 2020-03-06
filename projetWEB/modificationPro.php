<?php 

require 'src/bootstrap.php';
require 'src/Calendar/Month.php';
require 'src/Calendar/Events.php';
$libPro = "";
$idPro ="";
 if(isset($_GET['id'])){
  $idPro = $_GET['id'];
   $pdo =get_pdo();
   $sql = "SELECT * FROM id12822867_projetweb.PRO WHERE PRO.idPro = $idPro ";
   $result = $pdo->query($sql);
   $data = $result->fetchAll();
   $libPro = $data[0]['libPro'];
    $idPro = $data[0]['idPro'];
  }

 

 if(isset($_POST['libPro'])){
  $libPro = $_POST['libPro'] ;
  $pdo =get_pdo();
  $sql = "SELECT * FROM id12822867_projetweb.PRO WHERE idPro = $idPro ";
   $result = $pdo->query($sql);
   $data = $result->fetchAll();
   $idPro = $data[0]['idPro'];
   $sql2 ="UPDATE id12822867_projetweb.PRO SET libPro='$libPro' WHERE idPro = $idPro ";
   $pdo->exec($sql2);
   $login = $_GET['login'];
    header("Location: /pro/login/$login");
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
<?php echo '<a href="/pro/login/'.$_GET['login'].'">◀️ Retourner aux CV/lettre</a>';?><br/>
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
  <input type="text" name="libPro" value="<?php echo $libPro; ?>">
</td>
<td>
  <input type="submit" value="Modifier le libellé du Pro">
  </td>
</form>
</tr>
</table>
</div>

  
</body>
</html>
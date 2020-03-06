<?php 

require 'src/bootstrap.php';
require 'src/Calendar/EventValidator.php';
require 'src/Calendar/Events.php';
$pdo = get_pdo();
$getLoginUtilisateur = $_GET['login'];
$reqUtilisateur = $pdo->prepare('SELECT * FROM id12822867_projetweb.UTILISATEUR WHERE UTILISATEUR.login = ?');
$reqUtilisateur->execute(array($getLoginUtilisateur));
$utilisateurInfo = $reqUtilisateur->fetch();

$data = [
  'dateEvenement' => $_GET['date'] ?? date('Y-m-d'),
  'debutEvenement' => date('H:i'),
  'finEvenement' => date('H:i')

];
$validator = new \Calendar\EventValidator($data);
if(!$validator->validate('date','dateEvenement')){
  $data['dateEvenement'] = date('Y-m-d');
}
$errors =[];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $data = $_POST;
  $validator = new Calendar\EventValidator();
  $errors = $validator->validates($_POST);
  if(empty($errors)){
    $event =[];
    $event['id'] = NULL;
    $event['libEvenement'] = $data['libEvenement'];
    $event['lieuEvenement'] = $data['lieuEvenement'];
    $event['debutEvenement'] = DateTime::createFromFormat('Y-m-d H:i',$data['dateEvenement']. ' '.$data['debutEvenement'])->format('Y-m-d H:i:s');
    $event['finEvenement'] = DateTime::createFromFormat('Y-m-d H:i',$data['dateEvenement']. ' '.$data['finEvenement'])->format('Y-m-d H:i:s');
    $event['idUtilisateur'] = $utilisateurInfo['idUtilisateur'];
    $events = new \Calendar\Events($pdo);
    $events->create($event); 
    header("Location: /planning/success/1/login/".$utilisateurInfo['login']."");
    exit();
  }
  
}

?>

<!Doctype html>
 <html>
 
 <head>
 <meta charset="UTF-8">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 <link rel="stylesheet" href="/css/calendar.css">
 </head>
 
 <body> 
 
<nav class="navbar navbar-dark bg-primary mb-3">
  <a href="/accueil/login/<?= $_GET['login'];?>" class="navbar-brand"> 🏠</a>
  <a href="/planning.php/login/<?= $_GET['login'];?>" class="navbar-brand"> 🔄 </a>
  <a href="/deconnexion.php?>" class="navbar-brand"> 📴</a>
</nav>


<div class="container">

<?php if(!empty($errors)){?>
  <div class="alert alert-danger">
    Merci de corriger vos erreurs !
  </div>  <div class="row">

<?php } ?>



  <h1>Ajouter un événément</h1>
  <form action="" method="post" class="form">
   
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="libEvenement">Titre</label>
        <input id ="libEvenement" type="text" required class="form-control" name="libEvenement" value="<?= isset($data['libEvenement']) ? h($data['libEvenement']) : ''; ?>">
        <?php if(isset($errors['libEvenement'])){?>
          <small class="form-text text-muted"> <?=$errors['libEvenement']; ?></small>
        <?php }?>
      </div>
    </div>
  
  
  <div class="col-sm-6">
    <div class="form-group">
      <label for="dateEvenement">Date de l'événément</label>
      <input id ="dateEvenement" type="date" required  class="form-control" name="dateEvenement" value="<?= isset($data['dateEvenement']) ? h($data['dateEvenement']) : ''; ?>">
      <?php if(isset($errors['dateEvenement'])){?>
          <small class="form-text text-muted"> <?=$errors['dateEvenement']; ?></small>
        <?php }?>
    </div>
    </div>

  </div>

  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="debutEvenement">Heure de début</label>
        <input id ="debutEvenement" type="time" required  class="form-control" name="debutEvenement" placeholder="HH:MM" value="<?= isset($data['debutEvenement']) ? h($data['debutEvenement']) : ''; ?>">
        <?php if(isset($errors['debutEvenement'])){?>
          <small class="form-text text-muted"> <?=$errors['debutEvenement']; ?></small>
        <?php }?>
      </div>
    </div>
  
  
  <div class="col-sm-6">
    <div class="form-group">
      <label for="finEvenement">Heure de fin</label>
      <input id ="finEvenement" type="time" required  class="form-control" name="finEvenement" placeholder="HH:MM" value="<?= isset($data['finEvenement']) ? h($data['finEvenement']) : ''; ?>">
      <?php if(isset($errors['finEvenement'])){?>
          <small class="form-text text-muted"> <?=$errors['finEvenement']; ?></small>
        <?php }?>
    </div>
    </div>
  </div>

  <div class="form-group">
    <label for="lieuEvenement">Lieu et description de l'événement</label>
    <textarea name="lieuEvenement" id="lieuEvenement" class="form-control"><?= isset($data['lieuEvenement']) ? h($data['lieuEvenement']) : ''; ?></textarea>
  </div>

  <div class="form-group">
    <button class="btn btn-primary">Créer Evenement</button>
  </div>
  </form>


</div>
<?php
require 'views/footer.php';
?>
<?php 
require 'src/bootstrap.php';
require 'src/Calendar/Month.php';
require 'src/Calendar/Events.php';
require 'src/Calendar/EventValidator.php';


$pdo = get_pdo();
$events = new Calendar\Events($pdo);
$errors = [];
try{
  $event = $events->find(intval($_GET['id']) ?? null);
} catch(\Exception $e){
  e404();
} catch(\Error $e){
  e404();
}

$event['dateEvenement'] = new \DateTime($event['debutEvenement']);
$event['dateEvenement'] = $event['dateEvenement']->format('Y-m-d');

$event['debutEvenement'] = new \DateTime($event['debutEvenement']);
$event['debutEvenement'] = $event['debutEvenement']->format('H:i');

$event['finEvenement'] = new \DateTime($event['finEvenement']);
$event['finEvenement'] = $event['finEvenement']->format('H:i');

$data['libEvenement'] = $event['libEvenement'];
$data['dateEvenement'] = $event['dateEvenement'];
$data['debutEvenement'] = $event['debutEvenement'];
$data['finEvenement'] = $event['finEvenement'];
$data['lieuEvenement'] = $event['lieuEvenement'];



$getLoginUtilisateur = $_GET['login'];
$reqUtilisateur = $pdo->prepare('SELECT * FROM id12822867_projetweb.UTILISATEUR WHERE UTILISATEUR.login = ?');
$reqUtilisateur->execute(array($getLoginUtilisateur));
$utilisateurInfo = $reqUtilisateur->fetch();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $data = $_POST;
  $validator = new \Calendar\EventValidator();
  $errors = $validator->validates($data);
  if(empty($errors)){
    $event =[];
    $event['id'] = $data['libEvenement'];
    $event['libEvenement'] = $data['libEvenement'];
    $event['lieuEvenement'] = $data['lieuEvenement'];
    $event['debutEvenement'] = DateTime::createFromFormat('Y-m-d H:i',$data['dateEvenement']. ' '.$data['debutEvenement'])->format('Y-m-d H:i:s');
    $event['finEvenement'] = DateTime::createFromFormat('Y-m-d H:i',$data['dateEvenement']. ' '.$data['finEvenement'])->format('Y-m-d H:i:s');
    $event['idUtilisateur'] = $utilisateurInfo['idUtilisateur'];
    
    $events->update($event); 
    header("Location: /planning.php?success=1&login=".$utilisateurInfo['login']."");
    exit();
  }
  
}



require 'views/header.php';
?>

<div class="container">
<h1>Editer l'événement <small><?=  h($event['libEvenement']) ; ?></small></h1>

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
    <button type="submit" class="btn btn-primary">Modifier Evenement</button>
    
    <a href="/suppressionEvent.php?id=<?= h($event['id'] ); ?>&login=<?= $getLoginUtilisateur; ?>">
      <button type="button" class="btn btn-primary">Supprimer Evenement</button>
    </a>
  </div>

  
  </form>
  </div>
<?php 
require 'views/footer.php';

?>
<?php 
require 'src/bootstrap.php';
require 'src/Calendar/Month.php';
require 'src/Calendar/Events.php';



$pdo = get_pdo();
$events = new Calendar\Events($pdo);
if(!isset($_GET['id'])){
  header('location: 404.php');
}else{
  $id = intval($_GET['id']);
  try{

$event = $events->find($id);
} catch(\Exception $e){
  e404();
}
require 'views/header.php';
?>

<h1><?=  h($event['libEvenement']) ; ?></h1>
<ul>
  <li>Lieu de l'événement : <?=h($event['lieuEvenement']) ; ?></li>
  <li>Date de l'événement : <?=(new DateTime($event['debutEvenement']))->format('d/m/Y') ; ?></li>
  <li>Heure de début : <?=(new DateTime($event['debutEvenement']))->format('H:i') ; ?></li>
  <li>Heure de fin : <?=(new DateTime($event['finEvenement']))->format('H:i') ; ?></li>
</ul>
 
<?php 
require 'views/footer.php';
}
?>
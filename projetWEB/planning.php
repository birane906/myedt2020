<?php 
require 'src/bootstrap.php';
require 'src/Calendar/Month.php';
require 'src/Calendar/Events.php';
$pdo = get_pdo();
$events = new Calendar\Events($pdo);
$month = new Calendar\Month($_GET['month'] ?? null, $_GET['year'] ?? null ); 
$start = $month->getStartingDay();
$start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
$weeks = $month->getWeeks();
$end = (clone $start)->modify('+' . (6 + 7 * ($weeks - 1) ). 'days');


$getLoginUtilisateur = $_GET['login'];
  $reqUtilisateur = $pdo->prepare('SELECT * FROM projetWEB.UTILISATEUR WHERE UTILISATEUR.login = ?');
  $reqUtilisateur->execute(array($getLoginUtilisateur));
  $utilisateurInfo = $reqUtilisateur->fetch();

$events = $events->getEventsBetweenByDay($start, $end,$utilisateurInfo['idUtilisateur']);



if(isset($_GET['login'])){

  
  if($utilisateurInfo['login'] == $getLoginUtilisateur){
  require 'views/header.php';

?>

<div class="calendar">



<div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">

  <h1> <?= $month->toString(); ?></h1>


<?php if(isset($_GET['success']) and intval($_GET['success']) == 1){?>
<div class="container">
  <div class="alert alert-success">
  L'événement a bien été enregistré !
  </div>
</div>
<?php }?>

<?php if(isset($_GET['success']) and intval($_GET['success']) == 0){?>
<div class="container">
  <div class="alert alert-success">
  L'événement a bien été supprimé !
  </div>
</div>
<?php }?>

  <div>
    <a href="/planning.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>&login=<?= $getLoginUtilisateur; ?>" class="btn btn-primary">&lt;</a>
    <a href="/planning.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>&login=<?= $getLoginUtilisateur; ?>" class="btn btn-primary">&gt;</a>
  </div>

</div>

 <table class="calendar__table calendar__table--<?= $weeks; ?>weeks">
 
  <?php for ($i =0; $i < $weeks; $i++):?>
  <tr>
      <?php foreach($month->days as $k => $day):
        $date =(clone $start)->modify("+" .($k + $i * 7) . "days");
        $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
        $isToday = date('Y-m-d') === $date->format('Y-m-d');
        ?>
      
        <td class="<?= $month->withinMonth($date) ? '' :  'calendar__othermonth'; ?> <?= $isToday ? '' :  'is-today'; ?>">
          <?php if ($i === 0): ?>
            <div class="calendar__weekday"> <?= $day; ?> </div>
          <?php endif; ?>
         <a class="calendar__day" href="add.php?date=<?= $date->format('Y-m-d'); ?>&login=<?= $getLoginUtilisateur; ?>"> <?= $date->format('d'); ?> </a>
         <?php foreach ($eventsForDay as $event): ?>
          <div class="calendar__event">
          <?= (new DateTime($event['debutEvenement']))->format('H:i') ?> - <a href="/modificationEvent.php?id=<?= h($event['id'] );
          ?>&login=<?php echo $getLoginUtilisateur;?>"> <?= h($event['libEvenement']); ?></a>


          </div>
         <?php endforeach; ?>
        </td>
        <?php endforeach; ?> 
    </tr>
  <?php endfor; ?>
 
</table>

<?php echo '<a href="/add.php?login='.$utilisateurInfo['login'].'" class="calendar__button">  + </a>' ;?>
</div>

<?php 
require 'views/footer.php';
}else {header('Location: /403.php');}
}
?>
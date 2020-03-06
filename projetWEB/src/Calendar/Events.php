<?php 

namespace Calendar;

class Events {

  private $pdo;

  public function __construct(\PDO $pdo){

      $this->pdo = $pdo;
  }


  public function getEventsBetween(\DateTime $start, \DateTime $end,int $id): array{
    $pdo = new \PDO('mysql:host=localhost;dbname =id12822867_id12822867_projetweb', 'id12822867_root', 'P@pisco1'
  );
    $sql = "SELECT * FROM id12822867_projetweb.EVENEMENT WHERE idUtilisateur = $id AND debutEvenement BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}' ORDER BY debutEvenement ASC ";
    $statement = $this->pdo->query($sql);
    $results = $statement->fetchAll();
    return $results;
  }



  public function getEventsBetweenByDay(\DateTime $start, \DateTime $end, int $id): array{
    $events = $this->getEventsBetween($start, $end,$id);
    $days =[];
    foreach($events as $event){
      $date = explode(' ',$event['debutEvenement'])[0];
      if (!isset($days[$date])){
        $days[$date] = [$event];
      } else {
        $days[$date][] = $event;
      }
    }

    return $days;

  }


  public function find(int $id): array {
      $result = $this->pdo->query("SELECT * FROM id12822867_projetweb.EVENEMENT WHERE id = $id LIMIT 1")->fetch();
      if ($result === false){
        throw new \Exception('Aucun résultat trouvé');
      } 
      
      return $result;
  }

  public function create(array $event):bool{
     $statement =$this->pdo->prepare('INSERT INTO id12822867_projetweb.EVENEMENT(libEvenement,lieuEvenement, debutEvenement,finEvenement, idUtilisateur) VALUES (?,?,?,?,?)');
     $event['debutEvenement'] = new \DateTime($event['debutEvenement']);
     $event['finEvenement'] = new \DateTime($event['finEvenement']);
    return $statement->execute([
      $event['libEvenement'],$event['lieuEvenement'],$event['debutEvenement']->format('Y-m-d H:i:s'),$event['finEvenement']->format('Y-m-d H:i:s'),
      $event['idUtilisateur']    ]);
  }


  public function update(array $event):bool{
    $statement =$this->pdo->prepare('UPDATE id12822867_projetweb.EVENEMENT SET EVENEMENT.libEvenement = ?, EVENEMENT.lieuEvenement = ?, EVENEMENT.debutEvenement = ?, EVENEMENT.finEvenement = ?, EVENEMENT.idUtilisateur = ? WHERE id = ?');
    $event['debutEvenement'] = new \DateTime($event['debutEvenement']);
    $event['finEvenement'] = new \DateTime($event['finEvenement']);
   return $statement->execute([
     $event['libEvenement'],$event['lieuEvenement'],$event['debutEvenement']->format('Y-m-d H:i:s'),$event['finEvenement']->format('Y-m-d H:i:s'),
     $event['idUtilisateur'] , $_GET['id']
      ]);
 }

}

?>
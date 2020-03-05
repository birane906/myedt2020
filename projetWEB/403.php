<?php 
session_start();
http_response_code(403);
require 'views/header.php';

?>

<h1>Accès Refusé</h1>

<?php 
require 'views/footer.php';
?>
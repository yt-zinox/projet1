<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
if(isset($_SESSION['id']) AND !empty($_SESSION['id'])) {
$msg = $bdd->prepare('SELECT * FROM messages_prives WHERE id_destinataire = ?');
$msg->execute(array($_SESSION['id']));
$msg_nbr = $msg->rowCount();


if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
   $supprime = (int) $_GET['supprime'];

   $req = $bdd->prepare('DELETE FROM messages_prives WHERE id = ?');
   $req->execute(array($supprime));
}

$message = $bdd->query('SELECT * FROM messages_prives ORDER BY id DESC');

?>
<!DOCTYPE html>
<html>
<head>
   <title>Boîte de réception</title>
   <meta charset="utf-8" />
</head>
<body>
   <a href="envoi.php?id=".$_SESSION['id']>Nouveau message</a><br /><br /><br />
   <h3>Votre boîte de réception:</h3>
   <?php
   if($msg_nbr == 0) { echo "Vous n'avez aucun message..."; }
   while($m = $msg->fetch()) {
      $p_exp = $bdd->prepare('SELECT pseudo FROM users WHERE id = ?');
      $p_exp->execute(array($m['id_expediteur']));
      $p_exp = $p_exp->fetch();
      $p_exp = $p_exp['pseudo'];
   ?>
   <?php while($c = $message->fetch()) { ?>
   <b><?= $p_exp ?></b> vous a envoyé: <br />
   <?= nl2br($m['message']) ?><a href="reception.php?type=membre&supprime=<?= $c['id'] ?>"> <font color="red">[Supprimer]</font></a><br />
   -------------------------------------<br/>
   <?php } ?>
   <?php } ?>
</body>
</html>
<?php } ?>
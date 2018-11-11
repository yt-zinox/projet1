<?php while($c = $message->fetch()) { 
	$bdd = new PDO("mysql:host=127.0.0.1;dbname=espace_membre;charset=utf8", "root", "");
?>
               <li><strong>Pseudo: </strong><?= $c['pseudo'] ?> <strong>Email: </strong><?= $_SESSION['email'] ?> <strong>Message:</strong> <?= $c['message'] ?><a href="admin_code_chat_publique.php?type=membre&supprime=<?= $c['id'] ?>"> <font color="red">[Supprimer]</font></a></li>
               <?php } ?>
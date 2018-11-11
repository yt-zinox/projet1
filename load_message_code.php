<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');


$message = htmlspecialchars($_POST['message']);
while($c = $message->fetch()) { ?>

               <li><strong>Pseudo: </strong><?= $c['pseudo'] ?> <strong>Email: </strong><?= $_SESSION['email'] ?> <strong>Message:</strong> <?= $c['message'] ?><a href="admin_code_chat_publique.php?type=membre&supprime=<?= $c['id'] ?>"> <font color="red">[Supprimer]</font></a></li>
               <?php } ?>
?>
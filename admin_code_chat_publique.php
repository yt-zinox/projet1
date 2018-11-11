<?php

session_start();

$bdd = new PDO("mysql:host=127.0.0.1;dbname=espace_membre;charset=utf8", "root", "");

if(isset($_GET['accueiladmin']) AND $_GET['accueiladmin'] === 'Accueil')
{
   header("Location: admin.php");
}

if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
   $supprime = (int) $_GET['supprime'];

   $req = $bdd->prepare('DELETE FROM chat_publique WHERE id = ?');
   $req->execute(array($supprime));
}

$message = $bdd->query('SELECT * FROM chat_publique ORDER BY id DESC');

if(isset($_GET['profil']) AND $_GET['profil'] === 'Profil')
{
   header("Location: profil_admin.php?id=".$_SESSION['id']);
}

if(isset($_GET['comptes']) AND $_GET['comptes'] === 'Comptes')
{
   header("Location: admin_code_compte.php");
}

if(isset($_GET['chat_admin']) AND $_GET['chat_admin'] === 'Chat Admin')
{
   header("Location: admin_code_chat_admin.php");
}

?>

<html>
<head>
   <title>Accueil</title>
   <meta charset="utf-8">
</head>
<body>
   <h2 align="center">Accueil</h2>
   <br /><br /><br />
   <form method="GET" action="">
      <input type="submit" name="accueiladmin" value="Accueil">
      <input type="submit" name="profil" value="Profil">
      <div align="center">
         <input type="submit" name="comptes" value="Comptes">
         <input type="submit" name="chat_admin" value="Chat Admin">
      </div>
       <ul>
         <h1 align="left"> Message Publique</h1>
            <div align="left" id="message_code_publique">
               <?php while($c = $message->fetch()) { ?>
               <li><strong>Pseudo: </strong><?= $c['pseudo'] ?> <strong>Email: </strong><?= $_SESSION['email'] ?> <strong>Message:</strong> <?= $c['message'] ?><a href="admin_code_chat_publique.php?type=membre&supprime=<?= $c['id'] ?>"> <font color="red">[Supprimer]</font></a></li>
               <?php } ?>
            </div>
         <br />
      </ul>
   </form>
   <br /><br />
   <script>
      setInterval('load_messages()', 500);
      function load_messages() {
         $('#message_code_publique').load('load_message_code.php');
      }
   </script>
      <script>
      setInterval('load_messages()', 500);
      function load_messages() {
         $('#message_code_publique').load('load_message.php');
      }
   </script>
</body>
</html>
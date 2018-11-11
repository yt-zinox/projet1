<?php

session_start();

$bdd = new PDO("mysql:host=127.0.0.1;dbname=espace_membre;charset=utf8", "root", "");

if(isset($_GET['accueiladmin']) AND $_GET['accueiladmin'] === 'Accueil')
{
   header("Location: admin.php");
}

if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
   $supprime = (int) $_GET['supprime'];

   $req = $bdd->prepare('DELETE FROM users WHERE id = ?');
   $req->execute(array($supprime));
}

$membres = $bdd->query('SELECT * FROM users ORDER BY id ASC');

if(isset($_GET['profil']) AND $_GET['profil'] === 'Profil')
{
   header("Location: profil_admin.php?id=".$_SESSION['id']);
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

if(isset($_GET['chat_admin']) AND $_GET['chat_admin'] === 'Chat Admin')
{
   header("Location: admin_code_chat_admin.php");
}

if(isset($_GET['chat_publique']) AND $_GET['chat_publique'] === 'Chat Publique')
{
   header("Location: admin_code_chat_publique.php");
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
         <input type="submit" name="chat_publique" value="Chat Publique">
         <input type="submit" name="chat_admin" value="Chat Admin">
      </div>
       <ul>
         <h1 align="left"> Comptes</h1>
            <?php while($m = $membres->fetch()) { ?>
            <li><strong>id: </strong><?= $m['id'] ?> <strong>Pseudo:</strong> <?= $m['pseudo'] ?> <strong>Email:</strong> <?= $m['email'] ?> <a href="admin_code_compte.php?type=membre&supprime=<?= $m['id'] ?>"> <font color="red">[Supprimer]</font></a></li>
            <?php } ?>
            <br />
      </ul>
   </form>
   <br /><br />
</body>
</html>
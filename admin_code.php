<?php

session_start();

$bdd = new PDO("mysql:host=127.0.0.1;dbname=espace_membre;charset=utf8", "root", "");

if(isset($_GET['chat_publique']) AND $_GET['chat_publique'] === 'Chat Publique')
{
   header("Location: admin_code_chat_publique.php");
}

if(isset($_GET['chat_admin']) AND $_GET['chat_admin'] === 'Chat Admin')
{
   header("Location: admin_code_chat_admin.php");
}

if(isset($_GET['comptes']) AND $_GET['comptes'] === 'Comptes')
{
   header("Location: admin_code_compte.php");
}

if(isset($_GET['accueiladmin']) AND $_GET['accueiladmin'] === 'Accueil')
{
   header("Location: admin.php");
}

if(isset($_GET['profil']) AND $_GET['profil'] === 'Profil')
{
   header("Location: profil_admin.php?id=".$_SESSION['id']);
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
         <input type="submit" name="comptes" value="Comptes">
         <input type="submit" name="chat_admin" value="Chat Admin">
      </div>
   </form>
   <br /><br />
</body>
</html>
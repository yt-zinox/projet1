<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_POST['accueil1']) AND $_POST['accueil1'] === 'Accueil')
{
   header('Location: test.php?v');
}
?>

<!DOCTYPE html>
<html>
<head>
   <title>Accueil</title>
   <link rel="stylesheet" type="text/css" href="accueilclassique.css">
</head>
<body>
   <div class="normal">
      <form method="POST">
         <div id="all" align="center">
            <ul>
               <li><a href="" name="accueil1" style="text-decoration:none"><font color="#4B899B">Accueil</font></a></li>
               <li><a href="" name="chat1" style="text-decoration:none">Chat Publique</a></li>
               <li><a href="inscription.php" name="inscrire1" style="text-decoration:none">S'inscrire</a></li>
               <li><a href="login.php" name="connexion1" style="text-decoration:none">Connexion</a></li>
            </ul>
         </div>
      </form>
   </div>
   <form method="GET">
      <h1 align="center">Chat Publique :</h1>
      <div class="chat">
         <a href="" class="photoanim">
            <img src="img2.png" height="20" width="20"><br /><br />
         </a>
         <div class="chat1">
            <?php
               $allmsg = $bdd->query('SELECT * FROM chat_publique ORDER BY id DESC LIMIT 0, 8');
               while($msg = $allmsg->fetch()) {
               ?>
               <b><?php echo $msg['pseudo']; ?> : </b>
               <?php echo '<font color="#0A528E">' .$msg['message']. '</font>'; ?><br />
               <?php
               }
               ?>
         </div>
      </div>
      <div class="pp">
         <p align="center"><font color="red">Vous devez être connecter pour pouvoir participer au chat !</font></p>
      </div>
   </form>
      <script>
         setInterval('load_mesages()', 500);
         function load_mesages() {
            $('photoanim').load('load_message.php');
         }
      </script>
   <?php
if(isset($erreur)) {
   echo '<font color="red">'.$erreur."</font>";
}

$error = "Vousssssssss";

?>
</body>
</html>

<?php

session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_POST['accueil1']) AND $_POST['accueil1'])
{
   header('Location: test.php?v');
}








if(isset($_GET['chat_admin']) AND $_GET['chat_admin'] === 'Chat Admin')
{
   header("Location: chat_admin.php?id=".$_SESSION['id']);
}

if(isset($_GET['message_prive']) AND $_GET['message_prive'] === 'Messages Privés')
{
   header("Location: envoi.php?id=".$_SESSION['id']);
}

if(isset($_GET['code']) AND $_GET['code'] === 'Code')
{
   header("Location: admin_code.php");
}

if(isset($_GET['chat_publique']) AND $_GET['chat_publique'] === 'Chat Publique')
{
   header("Location: chat_publique.php?id=".$_SESSION['id']);
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

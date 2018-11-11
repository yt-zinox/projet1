<?php
session_start();

$bdd = new PDO("mysql:host=127.0.0.1;dbname=espace_membre;charset=utf8", "root", "");

if(isset($_GET['submit_co'])) {
   $mailconnect = htmlspecialchars($_GET['pseudo_co']);
   $mdpconnect = sha1($_GET['mdp_co']);
   if(!empty($mailconnect)) {
      $requser = $bdd->prepare("SELECT * FROM users WHERE pseudo = ? AND password = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['pseudo'] = $userinfo['pseudo'];
         $_SESSION['email'] = $userinfo['email'];
         header("Location: accueil.php?id=".$_SESSION['id']);
         if(isset($_SESSION['id']) AND $_SESSION['id'] == 1) {
            header("Location: admin.php?id=".$_SESSION['id']);
         }
         if(isset($_SESSION['id']) AND $_SESSION['id'] == 2) {
            header("Location: admin.php?id=".$_SESSION['id']);
         }
      } else {
         $erreur = "Mauvais pseudo ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}

?>

<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_POST['accueil1']) AND $_POST['accueil1'] === 'Accueil')
{
   header('Location: ');
}

if(isset($_POST['deco-co']) AND $_POST['deco-co'])
{
   header('Location: index.php');
}

if(isset($_POST['coo']) AND $_POST['coo'])
{
   header('Location: login.php');
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
            <nav>
               <ul>
                  <li><a href="index.php" name="accueil1" style="text-decoration:none">Accueil</a></li>
                  <li><a href="" name="chat1" style="text-decoration:none">Chat Publique</a></li>
                  <li><a href="inscription.php" name="inscrire1" style="text-decoration:none">S'inscrire</a></li>
                  <li><a href="login.php" ><font color="#4B899B">Connexion</font></a></li>
               </ul>
            </nav>
         </div>
      </form>
   </div>
   <div>
      <h4 class="h41">
         Connexion 
         <a href="inscription.php" class="inscri">Pas encore de compte ? <font color="#639B4B">Créez en un ici !</font></a>
      </h4>
   </div>
   <p>
   <a href="#" onclick="document.getElementById('id').style.display='block';" class="soumenu1"></a>
   </p>
   <div id="id" style="display:none;">1er texte caché que j'affiche quand je clique sur le 1er lien</div>
   <form method="GET" class="form">
     <input type="text" placeholder="Pseudo" name="pseudo_co">
     <br>
     <input type="password" placeholder="Mot de passe" name="mdp_co">
     <br>
     <input type="submit" value="Connexion" name="submit_co">
      <?php
      if(isset($erreur)) {
      echo '<font color="red">'.$erreur."</font>";
      }
      ?>
</body>
</html>

<?php


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

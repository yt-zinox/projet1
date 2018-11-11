<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_SESSION['id'])) {
   $requser = $bdd->prepare("SELECT * FROM users WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
   if(isset($_POST['pseudo']) AND isset($_POST['message']) AND !empty($_POST['pseudo']) AND !empty($_POST['message'])) {
      $message = htmlspecialchars($_POST['message']); 
      if(strlen($message) >= 1 AND strlen($message) <= 255) {
         $pseudo = htmlspecialchars($_POST['pseudo']); 
         $insertmsg = $bdd->prepare('INSERT INTO chat_publique(pseudo, message) VALUES(?, ?)');
         $insertmsg->execute(array($pseudo, $message));

        } else {
         $erreur = "Votre message doit comporter entre 3 et 255 caractères";
        } 
   } else {
      $erreur = "Veuillez renseigner tous les champs";
   }
        if(isset($_GET['accueil']) AND $_GET['accueil'] == "Accueil")
        {
            if(isset($_SESSION['id']) AND $_SESSION['id'] == 1)
              {
                  header("Location: admin.php");
              } else {
                header("Location: accueil.php");
              }
        }
        if(isset($_GET['accueil']) AND $_GET['accueil'] == "Accueil")
        {
            if(isset($_SESSION['id']) AND $_SESSION['id'] == 2)
              {
                  header("Location: admin.php");
              } else {
                header("Location: accueil.php");
              }
        }

?>

<!DOCTYPE html>
<html>
<head>
   <title>Chat</title>
   <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="stylee.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body>
   <div>
      <form method="post">
        <div class="normal">
      <form method="POST">
         <div id="alla" align="center">
            <nav>
               <ul>
                  <li><a href="accueil.php" name="accueil1" style="text-decoration:none"><font color="#4B899B">Accueil</font></a></li>
                  <li><a href="chat_publique.php" name="chat1" style="text-decoration:none">Chat Publique</a></li>
                  <li><a href="envoi.php" name="envoi" style="text-decoration:none">Message Privé</a></li>
                  <li title="Profil" class="box-img" onclick="document.getElementById('id1').style.display='block';document.getElementById('id2').style.display='block';document.getElementById('id3').style.display='block';document.getElementById('id4').style.display='block';document.getElementById('id5').style.display='block';document.getElementById('id6').style.display='block';document.getElementById('id7').style.display='none';document.getElementById('id8').style.display='block';">
                     <div style="display: none;">0</div>
                     <div class="menu1">
                        <img src="img4.jpg">
                     </div>
                     <div class="profil-box" style="display:none;" id="id5">
                        <div class="head">
                           <div class="action-right">
                              <img class="image5" id="id1" title="Mon Profil" onclick="window.location.href='profil_admin?id=<? $user['id']; ?>'" style="display:none;" src="img5.png">
                              <img src="img6.png" class="image6" id="id2" style="display:none;" title="Déconnexion" onclick="window.location.href='index.php'">
                              <p class="image7">
                              <a  href="" name="profil12" style="display:none;" id="id3" class="soumenu1">Profil :</a>
                              </p>
                              <p class="image8">
                              <a href="index.php" style="display:block;" id="id4" class="soumenu1">Déconnexion :</a>
                              </p>
                           </div>
                        </div>
                     </div>
                  </li>
               </ul>
            </nav>
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
         <div class="pp">
         	<p align="center"><font color="green">Bienvenue <?php echo $user['pseudo']; ?> !</font></p>
      	</div>
</body>
</html>
<?php   
}
?>

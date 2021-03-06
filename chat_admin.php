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
         $insertmsg = $bdd->prepare('INSERT INTO chat_admin(pseudo, message) VALUES(?, ?)');
         $insertmsg->execute(array($pseudo, $message));

        } else {
         $erreur = "Votre message doit comporter entre 3 et 255 caractères";
        } 
   } else {
      $erreur = "Veuillez renseigner tous les champs";
   }
        if(isset($_GET['accueil']) AND $_GET['accueil'] == "Accueil")
        {
          header("Location: admin.php");
        }
?>

<!DOCTYPE html>
<html>
<head>
   <title>Chat</title>
   <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="stylee.css">
</head>
<body>
  <div class="normal">
      <form method="POST">
         <div id="all" align="center">
            <nav>
               <ul>
                  <li><a href="admin.php" name="accueil1" style="text-decoration:none">Accueil</a></li>
                  <li><a href="chat_publique.php" name="chat1" style="text-decoration:none">Chat Publique</a></li>
                  <li><a href="chat_admin.php" name="chat2" style="text-decoration:none"><font color="#4B899B">Chat Admin</font></a></li>
                  <li><a href="envoi.php" name="envoi" style="text-decoration:none">Message Privé</a></li>
                  <li><a href="admin_code.php" name="code1" style="text-decoration:none">Code</a></li>
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
  <form method="get">
      <div class="accueilmessage">
         <input type="submit" name="accueil" value="Accueil">
      </div>
  </form>
   <div>
      <form method="post">
        <div id="pseudo01">
          <input type="text" name="pseudo" placeholder="Pseudo" value="<?php 
          if(isset($user['pseudo'])) { echo $user['pseudo']; } ?>"><br />
        </div>
         <div class="textarea">
            <input type="text" name="message" placeholder="MESSAGE" size="180"><br />
         </div>
        <input type="submit" value="Envoyer">
      </form>
   </div>
   <div align="center" class="erreurmessage">
    <?php
    if(isset($erreur)) {
      echo '<font color="red">'.$erreur."</font>";
    }
    ?>
  </div>
  <div id="message">
     <?php
     $allmsg = $bdd->query('SELECT * FROM chat_admin ORDER BY id DESC LIMIT 0, 31');
     while($msg = $allmsg->fetch()) {
     ?>
     <b><?php echo $msg['pseudo']; ?> : </b>
     <?php echo '<font color="#FF8000">' .$msg['message']. '</font>'; ?><br />
     <?php
     }
     ?>
  </div>
</body>
</html>
<?php   
}
?>

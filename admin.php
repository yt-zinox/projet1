<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_POST['profil1'])) {
   header("Location: profil_admin.php?id=".$_SESSION['id']);
}

if(isset($_POST['chat1'])) {
   header("Location: profil_admin.php?id=".$_SESSION['id']);
}

if(isset($_POST['profil12'])) {
   header("Location: profil_admin.php?id=".$_SESSION['id']);
}

$psd = $_SESSION['pseudo'];


if(isset($_SESSION['id'])) {
   $requser = $bdd->prepare("SELECT * FROM users WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
}

$membres = $bdd->query('SELECT * FROM users ORDER BY id ASC');

?>

<!DOCTYPE html>
<html>
<head>
   <title>Accueil</title>
   <link rel="stylesheet" type="text/css" href="test.css">
</head>
<body>
   <div class="normal">
      <form method="POST">
         <div id="all" align="center">
            <ul>
               <li><a href="admin.php" name="accueil1" title="Accueil" style="text-decoration:none"><font color="#4B899B">Accueil</font></a></li>
               <li><a href="chat_publique_admin.php" title="Chat Publique" name="chat1" style="text-decoration:none">Chat Publique</a></li>
               <li><a href="chat_admin.php" name="chat2" title="Chat Admin" style="text-decoration:none">Chat Admin</a></li>
               <li><a href="envoi.php" name="envoi" title="Message Privé" style="text-decoration:none">Message Privé</a></li>
               <li><a href="admin_code.php" name="code1" title="Code" style="text-decoration:none">Code</a></li>
               <li title="Profil" class="box-img" onclick="document.getElementById('id1').style.display='block';document.getElementById('id2').style.display='block';document.getElementById('id3').style.display='block';document.getElementById('id4').style.display='block';document.getElementById('id5').style.display='block';document.getElementById('id6').style.display='block';document.getElementById('id7').style.display='none';document.getElementById('id8').style.display='block';document.getElementById('id9').style.display='block';">
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
                              <a href="login.php" style="display:block;" id="id4" class="soumenu1">Déconnexion :</a>
                              </p>
                              <p class="image9">
                              <a href="" onclick="document.getElementById('id1').style.display='none';document.getElementById('id2').style.display='none';document.getElementById('id3').style.display='none';document.getElementById('id4').style.display='none';document.getElementById('id5').style.display='none';document.getElementById('id6').style.display='none';document.getElementById('id7').style.display='none';document.getElementById('id8').style.display='none';document.getElementById('id9').style.display='none';" style="display:block;" id="id10" class="soumenu1" ><strong>&#94;</strong></a>
                              </p>                           
                           </div>
                        </div>
                     </div>
               </li>
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
         <p align="center"><font color="green">Bienvenue <?php echo $user['pseudo']; ?> !</font></p>
      </div>
      <div class="droite">
         <h> <strong>Comptes</strong></h><br />
         .................
         <tr>
            <td>
               <?php while($m = $membres->fetch()) { ?>
               <li><a href="" style="text-decoration:none"><?= $m['pseudo'] ?></a></li>
               -------------
               <?php } ?>
            </td>
         </tr>
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

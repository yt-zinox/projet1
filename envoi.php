<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
if(isset($_SESSION['id']) AND !empty($_SESSION['id'])) {
   if(isset($_POST['envoi_message'])) {
      if(isset($_POST['destinataire'],$_POST['message']) AND !empty($_POST['destinataire']) AND !empty($_POST['message'])) {
         $destinataire = htmlspecialchars($_POST['destinataire']);
         $message = htmlspecialchars($_POST['message']);
         $id_destinataire = $bdd->prepare('SELECT id FROM users WHERE pseudo = ?');
         $id_destinataire->execute(array($destinataire));
         $dest_exist = $id_destinataire->rowCount();
         if($dest_exist == 1) {
            $id_destinataire = $id_destinataire->fetch();
            $id_destinataire = $id_destinataire['id'];
            $ins = $bdd->prepare('INSERT INTO messages_prives(id_expediteur,id_destinataire,message) VALUES (?,?,?)');
            $ins->execute(array($_SESSION['id'],$id_destinataire,$message));
            $error = "Votre message a bien été envoyé !";
         } else {
            $error = "Cet utilisateur n'existe pas...";
         }
      } else {
         $error = "Veuillez compléter tous les champs";
      }
   }

   if(isset($_POST['bdr']) AND $_POST['bdr'] == "Boîte de réception") {
      header('Location: reception.php?id='.$_SESSION['id']);
   }

         if(isset($_GET['accueil']) AND $_GET['accueil'] == "Accueil") {

            if(isset($_SESSION['id']) AND $_SESSION['id'] == 1)
              {
                  header("Location: admin.php");
              } else {
                header("Location: accueil.php");
              }
         }
         if(isset($_GET['accueil']) AND $_GET['accueil'] == "Accueil") {

            if(isset($_SESSION['id']) AND $_SESSION['id'] == 2)
              {
                  header("Location: admin.php");
              } else {
                header("Location: accueil.php");
              }
         }

   $destinataires = $bdd->query('SELECT pseudo FROM users ORDER BY pseudo');
   ?>
   <!DOCTYPE html>
   <html lang="en">
   <head>
      <title>Contact V1</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="main.css">
      <link rel="icon" type="image/png" href="images/image1.png"/>
   </head>
   <body>
      <div class="contact1">
         <div class="container-contact1">
            <form method="GET" class="accueil">
               <button name="accueil" value="Accueil" type="submit">Accueil</button>
            </form>
            <div class="contact1-pic js-tilt" data-tilt>
               <img src="img1.png" alt="IMG">
            </div>

            <form class="contact1-form validate-form" method="POST">
               <span class="contact1-form-title">
               </span>

               <div class="wrap-input1 validate-input">
                  <input class="input1" type="text" name="destinataire" placeholder="Destinataire">
                  <span class="shadow-input1"></span>
               </div>

               <div class="wrap-input1 validate-input">
                  <textarea class="input1" name="message" placeholder="Message"></textarea>
                  <span class="shadow-input1"></span>
               </div>

               <div class="container-contact1-form-btn">
                  <button class="contact1-form-btn" name="envoi_message">Envoyer
                  </button><br />
               </div>
               <div class="bdr">
               <br /><input type="submit" name="bdr" value="Boîte de réception"><br />
               </div>
                <br /><?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>'; } ?>
            </form>
         </div>
      </div>
   </body>
   </html>
<?php
}
?>
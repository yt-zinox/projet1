<?php

// On se connecte la BDD
$bdd = new PDO("mysql:host=127.0.0.1;dbname=espace_membre;charset=utf8", "root", "");

// On commence les vérifications
if(isset($_POST['confirm_register'])) {

   if(isset($_POST['email']) AND isset($_POST['username']) AND isset($_POST['password']) AND isset($_POST['password_confirm'])) {
      if(!empty($_POST['email']) AND !empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['password_confirm'])) {

         $email = trim(htmlspecialchars($_POST['email']));
         $username = trim(htmlspecialchars($_POST['username']));
         $password = htmlspecialchars($_POST['password']);
         $password_confirm = trim(htmlspecialchars($_POST['password_confirm']));

         if(strlen($email) <= 255) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $bdd->prepare("SELECT * FROM users WHERE email = ?");
                  $reqmail->execute(array($email));
                  $mailexist = $reqmail->rowCount();
               	if(strlen($username) >= 3 AND strlen($username) <= 255) {
                  	if(strlen($password) >= 4 AND strlen($password) <= 100) {
                     	if($password == $password_confirm) {

	                        $destinataire = htmlspecialchars($_POST['email']);
					        $id_destinataire = $bdd->prepare('SELECT email FROM users WHERE email = ?');
					        $id_destinataire->execute(array($destinataire));
					        $dest_exist = $id_destinataire->rowCount();
					        if($dest_exist == 0) {

					        	$pseudovalide = htmlspecialchars($_POST['username']);
						        $id_pseudovalide = $bdd->prepare('SELECT pseudo FROM users WHERE pseudo = ?');
						        $id_pseudovalide->execute(array($pseudovalide));
						        $pseudo_exist = $id_pseudovalide->rowCount();
						        if($pseudo_exist == 0) {

						         	$password_crypted = sha1($password);

			                        $req = $bdd->prepare("INSERT INTO users (pseudo, email, password) VALUES (?,?,?)");
			                        $req->execute(array($username, $email, $password_crypted));

			                        $erreur = "Votre compte a été créé avec succès ! <a href=\"login.php\"><font color='blue'>Me connecter</font></a>";
	                        	} else {
	                        		$error = "Username déjà utilisée !";
	                        	}
                        	} else {
                            	$error = "Adresse mail déjà utilisée !";
                         	}
                     	} else {
                        	$error = "Vos mots de passes ne correspondent pas";
                     	}
                  	} else {
                     $error = "Votre mot de passe doit comporter entre 8 et 100 caractères";
                  	}
                } else {
                  $error = "Votre pseudo doit comporter entre 3 et 255 caractères";
                }
            } else {
               $error = "Votre email a un format incorrect";
            }
         } else {
            $error = "Votre email doit faire moins de 255 caractères";
         }


      } else {
         $error = "Veuillez remplir tous les champs";
      }
   }
}

?>
<!DOCTYPE html>
<html>
<head>
   <title>Inscription</title>
   <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
   <h2 align="center">Inscription</h2>
   <div align="center" class="all">
      <form method="POST" action="">

      <table align="center">

         <tr>
            <td>
               <div class="email">
                  <input type="email" name="email" placeholder="Email">
               </div>
            </td>
         </tr>

         <tr>
            <td>
               <div class="username">
                  <input type="text" name="username" placeholder="Username">
               </div>            
            </td>
         </tr>

         <tr>
            <td>
               <div class="password">
                  <input type="password" name="password" placeholder="Password">
               </div>
            </td>
         </tr>

         <tr>
            <td>
               <div class="password">
                  <input type="password" name="password_confirm" placeholder="Password">
               </div>
            </td>
         </tr>

         <tr><td></td></tr>

         <tr>
            <td></td>
            <td>
               <div class="sinscrire">
                  <button type="submit" name="confirm_register">S'inscrire</button>
               </div>
            </td>
         </tr>
         <tr>
            <td>
            	<div class="messagemembre">
            		<p> Déjà membre ?
               			<a href="login.php">Connecte toi</a>
               		</p>
            	</div>
            </td>
         </tr>
      </table>
      <div align="center">
      <?php if(isset($error)) 
      { 
         echo '<font color="red">'.$error.'</font>';     
      }
      ?>
      <?php if(isset($erreur)) 
      { 
         echo '<font color="green">'.$erreur.'</font>';     
      }
      ?>
      </div>
      </form>
   </div>
</body>
</html>
<?php
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
	
    $allmsg = $bdd->query('SELECT * FROM chat_publique ORDER BY id DESC LIMIT 0, 31');
    while($msg = $allmsg->fetch()) {
    ?>
    <b><?php echo $msg['pseudo']; ?> : </b>
    <?php echo '<font color="#FF8000">' .$msg['message']. '</font>'; ?><br />
<?php
}
?>
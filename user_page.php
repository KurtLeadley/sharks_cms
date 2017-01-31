<?php 
require('includes/utilities.inc.php');
require('includes/header.inc.php');
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

$q = $pdo->prepare("SELECT id FROM `comments` WHERE userID = :sessionUserID");
										$q->bindParam(':sessionUserID', $user->getId());
										$q->execute();
										$r = $q->fetchAll();
										$sessionCommentCount = $q->rowCount();

if ($r) {
	echo 	$sessionUsername. " " .$sessionCommentCount. " comments";
	echo "<p> This page will eventually feature signatures and avatar selections </p>";
}

require('includes/footer.inc.php');
	
?>
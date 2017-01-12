<?php
require('includes/utilities.inc.php');
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$sessionUserID = $user->getId();
echo "Hi";
echo $sessionUserID;

if (isset($_POST['comment_id'])) {
	$commentID = $_POST['comment_id'];
	
	$q = $pdo->prepare("REPLACE INTO likes (user_id, comment_id) VALUES (:sessionuserid, :commentid)");
			
	$q->bindParam(':sessionuserid', $sessionUserID);
	$q->bindParam(':commentid', $commentID);
	
	$result = $q->execute();	
}
?>
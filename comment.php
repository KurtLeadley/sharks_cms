<div class="all_comments" id="allComments">
<?php
	$sessionUserID = $user->getId();
	$pageID = $_GET['id'];
	$q = 'SELECT comments.id, comments.userID, comments.title, comments.comment, comments.pageID, users.username, users.id AS usersid, DATE_FORMAT(comments.dateAdded, "%M %e %Y | %h:%i %p") AS dateAdded 
				FROM comments
				LEFT JOIN users ON (comments.userID = users.id)
				WHERE pageId=:pageId'; 
	$stmt = $pdo->prepare($q);
	$r = $stmt->execute(array(':pageId' => $page->getId()));
	$count = $stmt->rowCount();
?>
<h2><?php echo $count. " ";?>Comments:</h2>
<?php

if ($r){
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$comment = $row['comment'];
		$commentID = $row['id'];
		$title = $row['title'];
		$dateAdded = $row['dateAdded'];
		$userID = $row['usersid'];
		$userName = $row['username'];	
		
		$q2 = $pdo->prepare("SELECT * FROM likes WHERE comment_id = :commentid");
		$q2->bindParam(':commentid', $commentID);
		$q2->execute();
		$r2 = $q2->fetchAll();
		$count = $q2->rowCount();
		
		$q3 = $pdo->prepare("SELECT * FROM likes WHERE comment_id = :commentid AND user_id = :sessionuserid");
		$q3->bindParam(':commentid', $commentID);
		$q3->bindParam(':sessionuserid', $sessionUserID);
		$q3->execute();
		$r3 = $q3->fetchAll();
		$sessionCount = $q3->rowCount();
		
?>
<?php if ($count < 3) { ?> 
<div class="comments" id="<?php echo $commentID; ?>">
<?php } else { ?>
<div class="comments_liked" id="<?php echo $commentID; ?>">
 <?php } ?>
	<div class="divTable">
		<div class="divTableBody">
			<div class="divTableRow">
				<div class="trTitle"><?php echo $title ?></div>
			</div>
			<div class="divTableRow">
				<div class="divTableCell"><?php echo $comment ?> <?php// echo "Comment ID: ".$commentID. " User ID: ".$userID ; ?></div>
			</div>
			<div class="divTableRow">
				<div class="trUser">Posted by: <?php echo $userName ?>&nbsp;&nbsp;<?php echo $dateAdded ?>&nbsp;&nbsp;&nbsp;&nbsp;
				<form class="inlineform" id="inlineForm" action="" method="post" onsubmit="recComment(event, <?php echo $commentID; ?>)">
					<input type="hidden" id="commentid" value="<?php echo $commentID; ?>">
					<input type="hidden" id="userid" value="<?php echo $userID; ?>">
	<?php	if ($sessionCount == 0) { ?>
					<input style="display:inline;" id="recButton" type="submit" value="rec" /><?php echo " (". $count.")"; ?>
	<?php	} else if ($sessionCount > 0) { ?>
					<input style="display:inline;" id="recButton" type="submit" value="unrec" /><?php echo " (". $count.")"; ?> 
	<?php	} ?>  
				</form>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php
	}
}	
?>
</div>
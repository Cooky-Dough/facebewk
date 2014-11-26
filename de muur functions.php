<?php
include ("./database connection.php");
function commentsecurity($data){
	global $db;
	$sql = "select comment.id, gebruiker.id as gebruikerid from comment inner join gebruiker on comment.gebruiker_id = gebruiker.id where comment.id = :commentid";
				$stmt = $db->prepare($sql);
	  			$stmt->bindParam(':commentid', $data['id'], PDO::PARAM_INT);
	  			$stmt->execute();
	  			return $stmt;
}

function commentselect($data){
	global $db;
$sql2 = "select comment.id, comment.content, comment.datum, persoon.voornaam, persoon.achternaam, gebruiker.email, gebruiker.id as gebruikerid from comment 
							inner join gebruiker on comment.gebruiker_id = gebruiker.id 
							inner join persoon on gebruiker.persoon_id = persoon.id 
							where comment.status = '1' and comment.id = :id order by datum desc";
							$stmt2 = $db->prepare($sql2);
	  						$stmt2->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
							$stmt2->execute();
							return $stmt2;
}

function commentedit($data){
	global $db;
								$sql3 = "update comment set content = :content where id = :id";
							$stmt3 = $db->prepare($sql3);
	  						$stmt3->bindParam(':content', $data['content'], PDO::PARAM_STR);
	  						$stmt3->bindParam(':id', $data['id'], PDO::PARAM_INT);
							$stmt3->execute();
							header('location:de%20muur.php');
}

function commentdelete($data){
	global $db;
							$sql = "UPDATE comment SET status = '0' where id = :id";
						$stmt = $db->prepare($sql);
	  					$stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
	  					$stmt->execute();
}

function commenttoevoegen($data, $session){
	global $db;
			$sql = "insert into comment (content, datum, status, gebruiker_id, post_id) VALUES (:content, :datum, '1', :persoonid, :postid)";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':persoonid', $session['id'], PDO::PARAM_INT);
		$stmt->bindParam(':postid', $data['id'], PDO::PARAM_STR);
		$stmt->bindParam(':content', $data['content'], PDO::PARAM_STR);
		$stmt->bindParam(':datum', $datum, PDO::PARAM_INT);
		$datum = time();
		$stmt->execute();
		header('location:de%20muur.php');
}
function commentopcomment($data, $session){
	global $db;
			$sql = "insert into comment (content, datum, status, gebruiker_id, parent_id) VALUES (:content, :datum, '1', :persoonid, :parentid)";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':persoonid', $session['id'], PDO::PARAM_INT);
		$stmt->bindParam(':parentid', $data['id'], PDO::PARAM_INT);
		$stmt->bindParam(':content', $data['content'], PDO::PARAM_STR);
		$stmt->bindParam(':datum', $datum, PDO::PARAM_INT);
		$datum = time();
		$stmt->execute();
		header('location:de%20muur.php');
}

function postsecurity($data){
	global $db;
	$sql = "select post.id, gebruiker.id as gebruikerid from post inner join gebruiker on post.gebruiker_id = gebruiker.id where post.id = :postid";
				$stmt = $db->prepare($sql);
	  			$stmt->bindParam(':postid', $data['id'], PDO::PARAM_INT);
	  			$stmt->execute();
	  			return $stmt;
}
function postdelete($data){
	global $db;
			$sql = "UPDATE post SET status = '0' where id = :id";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
			$stmt->execute();
			header('location:de%20muur.php');
}
function postselect($data){
	global $db;
				$sql2 = "select post.id, post.titel, post.content, post.datum, persoon.voornaam, persoon.achternaam, gebruiker.email, gebruiker.id as gebruikerid from post inner join gebruiker on post.gebruiker_id = gebruiker.id inner join persoon on gebruiker.persoon_id = persoon.id where post.status = '1' and post.id = :id order by datum desc";
				$stmt2 = $db->prepare($sql2);
	  			$stmt2->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
				$stmt2->execute();
				return $stmt2;
}
function postwijzigen($data){
	global $db;
			$sql3 = "update post set titel = :titel, content = :content where id = :id";
			$stmt3 = $db->prepare($sql3);
	  		$stmt3->bindParam(':titel', $data['titel'], PDO::PARAM_STR);
	  		$stmt3->bindParam(':content', $data['content'], PDO::PARAM_STR);
	  		$stmt3->bindParam(':id', $data['id'], PDO::PARAM_INT);
			$stmt3->execute();
			
			header('location:de%20muur.php');
}
function posttoevoegen($profiel, $data){
	global $db;
		$sql = "insert into post (titel, content, datum, status, gebruiker_id) VALUES (:titel, :post, :datum, '1', :persoonid)";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':persoonid', $profiel['id'], PDO::PARAM_INT);
		$stmt->bindParam(':titel', $_POST['title'], PDO::PARAM_STR);
		$stmt->bindParam(':post', $_POST['content'], PDO::PARAM_STR);
		$stmt->bindParam(':datum', $datum, PDO::PARAM_INT);
		$datum = time();
		$stmt->execute();
		header('location:de%20muur.php');
}

function likepost($data, $userid){
		global $db;
		$sql = "INSERT INTO `the wall`.`like` (`gebruiker_id`, `type`, `type_id`) VALUES (:persoonid, :type, :type_id);";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':persoonid', $userid, PDO::PARAM_INT);
		$stmt->bindParam(':type', $data['type'], PDO::PARAM_STR);
		$stmt->bindParam(':type_id', $data['id'], PDO::PARAM_INT);
		$stmt->execute();
		var_dump($stmt);
		header('location:de%20muur.php');
}

function dislikepost($data, $userid){
		global $db;
		$sql = "delete from `the wall`.`like` where type_id = :type_id and type = :type and gebruiker_id = :persoonid;";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':persoonid', $userid, PDO::PARAM_INT);
		$stmt->bindParam(':type', $data['type'], PDO::PARAM_STR);
		$stmt->bindParam(':type_id', $data['id'], PDO::PARAM_INT);
		$stmt->execute();
		header('location:de%20muur.php');
}
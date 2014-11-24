<?php
include ("./database connection.php");
function admincheck(){
global $db;
	$sql5 = "select * from gebruiker where groep_id = '1'";
	$stmt5 = $db->prepare($sql5);
	$stmt5->execute();
	return $stmt5;
}
function profiel($data){
	global $db;
					$sql = "select * from post inner join gebruiker on post.gebruiker_id = gebruiker.id inner join persoon on gebruiker.persoon_id = persoon.id where gebruiker.email = :email order by datum desc";
					$stmt = $db->prepare($sql);
					$stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
					$stmt->execute();
}
function ban($data){
	global $db;
	   		$sql = "UPDATE gebruiker SET status = 0 WHERE email = :email ";
   			$stmt = $db->prepare($sql);
   			$stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
   			$stmt->execute();
}
function unban($data){
	global $db;
			$sql = "UPDATE gebruiker SET status = 1 WHERE email = :email ";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':email', $_GET['email'], PDO::PARAM_STR);
			$stmt->execute();
}
function def(){
	global $db;
		$sql = "select * from gebruiker inner join persoon on gebruiker.persoon_id = persoon.id";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		return $stmt;
}
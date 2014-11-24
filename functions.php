<?php
include ("./database connection.php");
function getProfiel($email){
	global $db;
		$sql = "select * from gebruiker inner join persoon on gebruiker.persoon_id = persoon.id where gebruiker.email = :email";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	
}
function showProfielForm($tpl, $profiel){	
		if ($profiel) {
				if ($profiel['geslacht'] == "man") {
						$tpl->assign("SELECTEDMAN", 'selected="selected"');
    	    		}elseif($profiel['geslacht'] == "vrouw"){
    	    	 		$tpl->assign("SELECTEDVROUW", 'selected="selected"');
    	    		}
			$tpl->assign("email", $profiel["email"]);
			$tpl->assign("voornaam", $profiel["voornaam"]);
			$tpl->assign("achternaam", $profiel["achternaam"]);
			$tpl->assign("geboortedatum", $profiel["geboortedatum"]);
			$tpl->assign("geslacht", $profiel["geslacht"]);
			$tpl->assign("adres", $profiel["adres"]);
			$tpl->assign("postcode", $profiel["postcode"]);
			$tpl->assign("woonplaats", $profiel["woonplaats"]);
			$tpl->assign("telefoon", $profiel["telefoon"]);
			$tpl->assign("mobiel", $profiel["mobiel"]);
			$tpl->assign("afbeelding", $profiel["avatar"]);

	}
				return $tpl;
}
function post($tpl, $id, $groep_id){
	global $db;
		$tpl->newBlock('plaatsen');
			$sql = "select post.id, post.titel, post.content, post.datum, persoon.voornaam, persoon.achternaam, gebruiker.email, gebruiker.status as gebruikerstatus, gebruiker.groep_id, gebruiker.id as gebruikerid from post inner join gebruiker on post.gebruiker_id = gebruiker.id inner join persoon on gebruiker.persoon_id = persoon.id where post.status = '1' order by datum desc";
			$stmt = $db->prepare($sql);
			$stmt->execute();
	   	 while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
		    if ($row['gebruikerstatus'] == '1') {
				$datum = date("H:i:s j F Y ",$row['datum']);
				$tpl->newBlock('post');
				$tpl->assign("titel", $row["titel"]);
				$tpl->assign("email", $row["email"]);
				$tpl->assign("content", $row["content"]);
				$tpl->assign("datum", $datum);
				$tpl->assign("voornaam", $row["voornaam"]);
				$tpl->assign("achternaam", $row["achternaam"]);
				$tpl->assign("ID", $row["id"]);
				comment($row['id'], $tpl, $id, $groep_id);
				$sql2 = "select *,count(*) as count from `the wall`.`like` where type_id = " . $row['id'] . " and type = 'post'";
				$stmt2 = $db->prepare($sql2);
				$stmt2->execute();
				while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
					if($row2['gebruiker_id'] == $_SESSION['id']){
						$tpl->newBlock('dislike');
						$tpl->assign("ID", $row["id"]);

					}else{
						echo $row2['gebruiker_id'] . $_SESSION['id'] . "<br>";
						$tpl->newBlock('like');
						$tpl->assign("ID", $row["id"]);
					}
				}
				$tpl->assign('LIKES', $row2['count']);
			if ($id == $row['gebruikerid'] or $groep_id == '1') {
				$tpl->newBlock('edit');
							$tpl->assign("ID", $row["id"]);
			}
		}else{
						$tpl->newBlock('post');
						$tpl->assign("voornaam", "Account is gebanned.");
						$tpl->assign("content", "Post is verwijderd");
						$tpl->assign("datum", "De comments zijn verborgen omdat de user geband is.");
		}
	}
}

function comment($id, $tpl, $id2, $groep_id){
global $db;
					$sql2 = "select comment.id, comment.content, comment.status, comment.datum, persoon.voornaam, persoon.achternaam, gebruiker.id as gebruikerid, gebruiker.groep_id, gebruiker.status as gebruikerstatus, gebruiker.email from comment inner join post on comment.post_id = post.id inner join gebruiker on comment.gebruiker_id = gebruiker.id inner join persoon on gebruiker.persoon_id = persoon.id where post.id = '" . $id . "' and comment.status = 1 order by datum desc";
				$stmt2 = $db->prepare($sql2);
				$stmt2->execute();
				while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){ 
					if ($row2['gebruikerstatus'] == '1') {
						$commentid = $row2['id'];
						$datum = date("H:i:s j F Y ",$row2['datum']);
						$tpl->newBlock('comment');
						$tpl->assign("email", $row2["email"]);
						$tpl->assign("content", $row2["content"]);
						$tpl->assign("datum", $datum);
						$tpl->assign("voornaam", $row2["voornaam"]);
						$tpl->assign("achternaam", $row2["achternaam"]);
						$tpl->assign("ID", $commentid);
							if ($row2['gebruikerid'] == $id2 or $groep_id == '1') {
								$tpl->newBlock('edit2');
								$tpl->assign("ID", $row2["id"]);
							}
						$sql3 = "select comment.id, comment.content, comment.status, comment.datum, persoon.voornaam, persoon.achternaam, gebruiker.id as gebruikerid, gebruiker.groep_id, gebruiker.status as gebruikerstatus, gebruiker.email from comment inner join gebruiker on comment.gebruiker_id = gebruiker.id inner join persoon on gebruiker.persoon_id = persoon.id where comment.parent_id = '" . $commentid . "' and comment.status = 1 order by datum desc";
						$stmt3 = $db->prepare($sql3);
						$stmt3->execute();
						while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
							if ($row3['gebruikerstatus'] == '1') {
								$commentid = $row2['id'];
								$datum = date("H:i:s j F Y ",$row3['datum']);
								$tpl->newBlock('comment2');
								$tpl->assign("email", $row3["email"]);
								$tpl->assign("content", $row3["content"]);
								$tpl->assign("datum", $datum);
								$tpl->assign("voornaam", $row3["voornaam"]);
								$tpl->assign("achternaam", $row3["achternaam"]);
								$tpl->assign("ID", $commentid);
								if ($row2['gebruikerid'] == $id2 or $groep_id == '1') {
									$tpl->newBlock('edit3');
									$tpl->assign("ID", $row3["id"]);
								}
							}else{
								$tpl->newBlock('comment2');
								$tpl->assign("voornaam", "Account is gebanned.");
								$tpl->assign("content", "Comment is verwijderd");
							}
						}
						
					}else{
						$tpl->newBlock('comment');
						$tpl->assign("voornaam", "Account is gebanned.");
						$tpl->assign("content", "Comment is verwijderd");
					}
				}	
			}
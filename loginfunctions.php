<?php
include ("./database connection.php");

function inloggen($data){
	global $db;
	 session_start();
  	$sql = "select *, count(*) as bla from gebruiker where email = :email and paswoord = :paswoord and status = 1";
	$stmt = $db->prepare($sql);
			
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':paswoord', $paswoord, PDO::PARAM_STR);

		$email = $data['email'];
		$paswoord = $data['paswoord'];

	
	$stmt->execute();
	    return $stmt;
}

function check($email){
	global $db;
	  		$sql = "select * from gebruiker where email = :email";
  			$stmt = $db->prepare($sql);
  			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
  			$stmt->execute();
  		  return $stmt;
}

function accounttoevoegen($data){
	global $db;
	   			$sql ="INSERT INTO persoon (voornaam, achternaam, geboortedatum, adres, postcode, woonplaats, telefoon, mobiel, geslacht, avatar) VALUES(:voornaam, :achternaam, :geboortedatum, :adres, :postcode, :woonplaats, :telefoon, :mobiel, :geslacht, 'http://cdns2.freepik.com/vrije-photo/vector-avatar-icon-gebruiker_279-10313.jpg')";
   				$stmt = $db->prepare($sql);
  				$stmt->bindParam(':voornaam', $data['voornaam'], PDO::PARAM_STR);
  				$stmt->bindParam(':achternaam', $data['achternaam'], PDO::PARAM_STR);
  				$stmt->bindParam(':geboortedatum', $data['geboortedatum'], PDO::PARAM_STR);
  				$stmt->bindParam(':adres', $data['adres'], PDO::PARAM_STR);
  				$stmt->bindParam(':postcode', $data['postcode'], PDO::PARAM_STR);
  				$stmt->bindParam(':woonplaats', $data['woonplaats'], PDO::PARAM_STR);
  				$stmt->bindParam(':telefoon', $data['telefoon'], PDO::PARAM_STR);
  				$stmt->bindParam(':mobiel', $data['mobiel'], PDO::PARAM_STR);
  				$stmt->bindParam(':geslacht', $data['geslacht'], PDO::PARAM_STR);
  				$stmt->execute();

   				$sql2 = "INSERT INTO gebruiker (email, paswoord, status, groep_id, persoon_id) VALUES (:email, :paswoord, 1, 2, :lastid);";
   				$stmt2 = $db->prepare($sql2);
   				$stmt2->bindParam(':email', $data['email'], PDO::PARAM_STR);
   				$stmt2->bindParam(':paswoord', $data['paswoord1'], PDO::PARAM_STR);
   				$stmt2->bindParam(':lastid', $lastid, PDO::PARAM_STR);
   				$lastid = $db->lastInsertId();
   				$stmt2->execute();

}
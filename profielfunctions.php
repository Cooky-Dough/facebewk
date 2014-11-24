<?php
include ("./database connection.php");

function view($data){
	global $db;
	$sql = "select *, gebruiker.id as gebruikerid, post.id as postid from post inner join gebruiker on post.gebruiker_id = gebruiker.id inner join persoon on gebruiker.persoon_id = persoon.id where gebruiker.email = :email and post.status = '1' order by datum desc";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$email = $data['email'];
			$stmt->execute();
			return $stmt; 
}
function check($session, $data){
	global $db;
			$sql = "select *, count(*) as bla from gebruiker where email = :email and paswoord = :paswoord";
			$stmt = $db->prepare($sql);
			
			$stmt->bindParam(':email', $session['email'], PDO::PARAM_STR);
			$stmt->bindParam(':paswoord', $data['oldpaswoord'], PDO::PARAM_STR);	
			$stmt->execute();
			return $stmt;
}
function wachtwoordupdate(){
	global $db;
	$sql2 = "UPDATE gebruiker SET paswoord = :paswoord WHERE email = :email";
				$stmt2 = $db->prepare($sql2);
			  	$stmt2->bindParam(':paswoord', $_POST['paswoord1'], PDO::PARAM_STR);
			  	$stmt2->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
				$stmt2->execute();
				header('location:profiel.php');
}

function wijzigen($data){
	global $db;
		$sql = "UPDATE persoon inner join gebruiker on persoon.id = gebruiker.persoon_id SET voornaam = :voornaam, achternaam = :achternaam, geboortedatum=:geboortedatum, adres=:adres, postcode=:postcode, woonplaats=:woonplaats, telefoon=:telefoon, mobiel=:mobiel, geslacht=:geslacht WHERE email = :email";
		$stmt = $db->prepare($sql);
	  	$stmt->bindParam(':voornaam', $_POST['voornaam'], PDO::PARAM_STR);
	  	$stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
  		$stmt->bindParam(':achternaam', $_POST['achternaam'], PDO::PARAM_STR);
  		$stmt->bindParam(':geboortedatum', $_POST['geboortedatum'], PDO::PARAM_STR);
  		$stmt->bindParam(':adres', $_POST['adres'], PDO::PARAM_STR);
  		$stmt->bindParam(':postcode', $_POST['postcode'], PDO::PARAM_STR);
  		$stmt->bindParam(':woonplaats', $_POST['woonplaats'], PDO::PARAM_STR);
  		$stmt->bindParam(':telefoon', $_POST['telefoon'], PDO::PARAM_INT);
  		$stmt->bindParam(':mobiel', $_POST['mobiel'], PDO::PARAM_INT);
  		$stmt->bindParam(':geslacht', $_POST['geslacht'], PDO::PARAM_STR);
	$stmt->execute();
	header('location:profiel.php');
}
function afbeelding($data){
	global $db;
	$sql = "UPDATE persoon inner join gebruiker on persoon.id = gebruiker.persoon_id SET avatar = :avatar WHERE email = :email";
	$stmt = $db->prepare($sql);
	  	$stmt->bindParam(':avatar', $_POST['afbeelding'], PDO::PARAM_STR);
	  	$stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);

	$stmt->execute();
	header('location:profiel.php');
}
function all(){
	global $db;
		$sql = "select * from gebruiker inner join persoon on gebruiker.persoon_id = persoon.id";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		return $stmt;
}
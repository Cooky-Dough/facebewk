<?php
session_start();
if (!isset($_SESSION['email'], $_SESSION['id'], $_SESSION['groep_id']))
{
header('location:login.php');
}
else
{
include ("./database connection.php");
include ("./functions.php");
include ("./profielfunctions.php");
	include ("./class.TemplatePower.inc.php");
	$tpl = new TemplatePower("./profiel.tpl");
	$tpl->prepare();
	$apl = new TemplatePower("./de muur.tpl");
	$apl->prepare();
	if (isset($_GET['actie'])){
	$actie = $_GET['actie'];
}else{
	$actie = null;
}

$tpl->assign('HEAD', 'Profiel. ');

switch($actie){
	case 'view':
	$tpl->newBlock('profiel');
	$profiel = getProfiel($_GET['email']);
	$tpl = showProfielForm($tpl, $profiel);
		$stmt = view($_GET);
	    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
    { 	
			$apl->newBlock('post');
			$datum = date("H:i:s j F Y ",$row['datum']);	
			$apl->assign("titel", $row["titel"]);
			$apl->assign("email", $row["email"]);
			$apl->assign("content", $row["content"]);
			$apl->assign("datum", $datum);
			$apl->assign("voornaam", $row["voornaam"]);
			$apl->assign("achternaam", $row["achternaam"]);
			$apl->assign("postid", $row["postid"]);
			$apl->assign("ID", $row["postid"]);
			if ($_SESSION['id'] == $row['gebruikerid'] or $_SESSION['groep_id'] == '1') {
				$apl->newBlock('edit');
							$apl->assign("postid", $row["postid"]);
			}
			comment($row['postid'], $apl, $_SESSION['id'], $_SESSION['groep_id']);
		}
	break;
		default:
	$tpl->newBlock('profiel');
	$profiel = getProfiel($_SESSION['email']);
	$tpl = showProfielForm($tpl, $profiel);
		$tpl->newBlock('wijzig');
		$stmt = view($_SESSION);
			    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
    { 	
			$apl->newBlock('post');
			$datum = date("H:i:s j F Y ",$row['datum']);	
			$apl->assign("titel", $row["titel"]);
			$apl->assign("email", $row["email"]);
			$apl->assign("content", $row["content"]);
			$apl->assign("datum", $datum);
			$apl->assign("voornaam", $row["voornaam"]);
			$apl->assign("achternaam", $row["achternaam"]);
			$apl->assign("postid", $row["postid"]);
			$apl->assign("ID", $row["postid"]);
			if ($_SESSION['id'] == $row['gebruikerid'] or $_SESSION['groep_id'] == '1') {
				$apl->newBlock('edit');
							$apl->assign("postid", $row["postid"]);
			}
			comment($row['postid'], $apl, $_SESSION['id'], $_SESSION['groep_id']);
		}
		break;

		case 'wachtwoord':
			$profiel = getProfiel($_SESSION['email']);
	$tpl = showProfielForm($tpl, $profiel);
	if (!isset($_POST['submit'])) {

		$tpl->newBlock('wachtwoord');
		$profiel = getProfiel($_SESSION['email']);
		$tpl = showProfielForm($tpl, $profiel);
	}elseif ($_POST['paswoord1'] == $_POST['paswoord2']){
		$stmt = check($_SESSION, $_POST);
	    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
		    	$account = $row['bla'];
		   	} 
		   		echo $row['bla'];
			if ($account == 1)
			{
				wachtwoordupdate($_POST, $_SESSION);
			}else{
				$tpl->newBlock('wachtwoord');
				$tpl->assign('wachtwoordfout', 'Je wachtwoord is fout.');
			}
		}else{
				$tpl->newBlock('wachtwoord');
		$tpl->assign('wachtwoordfout', 'De wachtwoorden zijn ongelijk.');
		}
	
		break;

	case 'wijzigen':
	if (!isset($_POST['submit'])) {

		$tpl->newBlock('wijzigen');
		$profiel = getProfiel($_SESSION['email']);
		$tpl = showProfielForm($tpl, $profiel);
	}else{
	wijzgen($_POST);
	}
		break;
	
	case 'afbeelding':
		if (!isset($_POST['submit'])) {
			$tpl->newBlock('afbeelding');
			$profiel = getProfiel($_SESSION['email']);
			$tpl = showProfielForm($tpl, $profiel);
		}else{
			afbeelding($_POST);
		}
		break;

		case 'all':
		$stmt = all();
				$tpl->newBlock('profielen');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 

			$tpl->newBlock('profielen2');
			$tpl = showProfielForm($tpl, $row);
		}
			break;
}

$db = null;
	$tpl->printToScreen();
	$apl->printToScreen();
}
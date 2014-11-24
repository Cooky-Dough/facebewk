<?php
session_start();
if (!isset($_SESSION['email'], $_SESSION['id']))
{
header('location:login.php');
}
else
{
include ("./database connection.php");
include ("./functions.php");
include ("./adminfunction.php");
	include ("./class.TemplatePower.inc.php");
	$tpl = new TemplatePower("./admin.tpl");
	$tpl->prepare();
	$stmt5 = admincheck();
	while ($row = $stmt5->fetch(PDO::FETCH_ASSOC)) {
		if ($row['email'] != $_SESSION['email']) {
			header('location:de$20muur.php');
		}else{
				if (isset($_GET['actie'])){
	$actie = $_GET['actie'];
}else{
	$actie = null;
}
				switch ($actie) {
					case 'profiel':
					$tpl->newBlock('profiel1');
					$profiel = getProfiel($_GET['email']);
					$tpl = showProfielForm($tpl, $profiel);
					$stmt = profiel($_GET);
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 	
						$tpl->newBlock('post');
						$datum = date("H:i:s j F Y ",$row['datum']);	
						$tpl->assign("titel", $row["titel"]);
						$tpl->assign("email", $row["email"]);
						$tpl->assign("content", $row["content"]);
						$tpl->assign("datum", $datum);
						$tpl->assign("voornaam", $row["voornaam"]);
						$tpl->assign("achternaam", $row["achternaam"]);
						$tpl->assign("ID", $row["id"]);
					}
					break;
					
					case 'ban':

						ban($_GET);

   					header ('location:admin.php');
   						break;

					 case 'unban':
					 	unban($_GET);

					   header ('location:admin.php');
					   break;						
						break;

					default:
					$stmt = def();
				$tpl->newBlock('profielen');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 

			$tpl->newBlock('profiel');
			$tpl = showProfielForm($tpl, $row);
			$tpl->assign('status', $row['status']);
			if ($row['status'] == '0'){
			$tpl->newBlock('banned');
			$tpl = showProfielForm($tpl, $row);
			}elseif($row['status'] == '1'){
			$tpl->newBlock('active');
			$tpl = showProfielForm($tpl, $row);
		}

		}
		break;
			
			}
		}
	}
	$db = NULL;
	$tpl->printToScreen();
}
<?php
include ("./database connection.php");
include ("./functions.php");
include ("./loginfunctions.php");
	include ("./class.TemplatePower.inc.php");
	$tpl = new TemplatePower("./login.tpl");
	$tpl->prepare();
if (isset($_GET['actie'])){
	$actie = $_GET['actie'];
}else{
	$actie = null;
}
  switch ($actie) {
  	case 'check':
  	$stmt = inloggen($_POST);
  	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
    { 
    	$login = $row['bla'];
    	$email = $row['email'];
    	$id = $row['id'];
    	$groepid = $row['groep_id'];
    } 

	if ($login == 1)
	{
	$_SESSION['email'] = $email;
	$_SESSION['id'] = $id;
	$_SESSION['groep_id'] = $groepid;
	print_r($_SESSION);
	header('location:de%20muur.php');
	}
	else
	{
	header ('location:login.php?actie=fout');
	$tpl->assign("FOUT", "Er is iets verkeerd ingevuld");
	}
  		break;
  	case 'toevoegen':
  	  		if ($_POST['paswoord1'] == $_POST['paswoord2']) {
  	  			$stmt = check($_POST['email']);
  			   if($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    	    	$tpl->newBlock("login");
    	    	$tpl->newBlock("toevoegen");
    	    	$tpl->assign("MSG", "bestaat al.");
    	    	$tpl->assign("EMAILFOUT", $_POST['email']);
	    	foreach ($_POST as $waardes => $waarde) {

						if ($waardes == "geslacht") {
							if ($waarde == "man") {
									$tpl->assign("SELECTEDMAN", 'selected="selected"');
    	    					}elseif($waarde == "vrouw"){
    	    	 					$tpl->assign("SELECTEDVROUW", 'selected="selected"');
    	    					}
							}
					$tpl->assign($waardes, $waarde);		
				}
   			} else{
   				accounttoevoegen($_POST);
   				$tpl->newBlock("login");
   			}
  		}else{
  		    	$tpl->newBlock("login");
    	    	$tpl->newBlock("toevoegen");
    	    	$tpl->assign("MSG", "Wachtwoorden zijn ongelijk");

	    	
	    	foreach ($_POST as $waardes => $waarde) {
						if ($waardes == "geslacht") {
							if ($waarde == "man") {
								$tpl->assign("SELECTEDMAN", 'selected="selected"');
    	    					}elseif($waarde == "vrouw"){
    	    	 				$tpl->assign("SELECTEDVROUW", 'selected="selected"');
    	    					}
							}
						$tpl->assign($waardes, $waarde);
				}
				}
  		break;

  		case 'fout':
  			$tpl->newBlock('login');
  			$tpl->assign('FOUT', 'E-mail of wachtwoord is fout.');
  			break;

  		case 'uitloggen':
  			session_start();
unset($_SESSION['id'], $_SESSION['email'], $_SESSION['groep_id']);
header('location:login.php');
  			break;

  	default:
	$tpl->newBLock("login");
	$tpl->newBLock("toevoegen");
	break;
  }
  $db = NULL;
	$tpl->printToScreen();
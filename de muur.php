<?php
session_start();
if (!isset($_SESSION['email'], $_SESSION['id'], $_SESSION['groep_id']))
{
header('location:login.php');
}else{
include ("./database connection.php");
include ("./functions.php");
include ("./de muur functions.php");
	include ("./class.TemplatePower.inc.php");
	$tpl = new TemplatePower("./de muur.tpl");
	$tpl->prepare();
	if (isset($_GET['actie'])){
	$actie = $_GET['actie'];
}else{
	$actie = null;
}
$tpl->assign('HEAD', 'Posts');


	if ('1' == $_SESSION['groep_id']) {
		echo "<a href='admin.php'> Naar het admin paneel. </a>";
	}

	switch ($actie) {

		case 'likepost':
			likepost($_GET, $_SESSION['id']);
			break;		

		case 'dislikepost':
			dislikepost($_GET, $_SESSION['id']);
			break;

		case 'commentwijzigen':
				$stmt = commentsecurity($_GET);
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
					if ($_SESSION['id'] == $row['gebruikerid'] or $_SESSION['groep_id'] == '1') {
						if(!isset($_POST['submit'])){
							$stmt2 = commentselect($_GET);
	    					while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){ 
								$tpl->newBlock('commentedit');
								$tpl->assign("email", $row2["email"]);
								$tpl->assign("content", $row2["content"]);
								$tpl->assign("ID", $row2["id"]);
							}
						}
						else{
							commentedit($_POST);
						}	
					}
					else{
						header('location:de%20muur.php');
					}
				}
			break;


		case "commentdelete":
				$stmt = commentsecurity($_GET);
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
					if ($_SESSION['id'] == $row['gebruikerid'] or $_SESSION['groep_id'] == '1') {
						commentdelete($_GET);
	  			header('location:de%20muur.php');
	  		}else{
	  			header('location:de%20muur.php');
	  		}
	  		header('location:de%20muur.php');
	  	}

case 'commenttoevoegen':
	if (!isset($_POST['submit'])) {
		$tpl->newBlock('commenttoevoegen');
		$tpl->assign('ID', $_GET['id']);
	}else{
		$profiel = getProfiel($_SESSION['email']);
		commenttoevoegen($_POST, $_SESSION);
	}
			break;
			
			case 'postdelete':
			$stmt = postsecurity($_GET);
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
					if ($_SESSION['id'] == $row['gebruikerid'] or $_SESSION['groep_id'] == '1') {
						postdelete($_GET);
			  		}else{
			  			header('location:de%20muur.php');
			  		}
	  	}

				break;

		case 'commentopcomment':
			if (!isset($_POST['submit'])) {
				$tpl->newBlock('commentopcomment');
				$tpl->assign('ID', $_GET['id']);
			}else{
				$profiel = getProfiel($_SESSION['email']);
				commentopcomment($_POST, $_SESSION);
				header('location: de%20muur.php');
			}
				break;

			case 'postwijzigen':
			$stmt = postsecurity($_GET);
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
					if ($_SESSION['id'] == $row['gebruikerid'] or $_SESSION['groep_id'] == '1') {
						if(!isset($_POST['submit'])){
							$stmt2 = postselect($_GET);
	    					while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){ 
								$tpl->newBlock('postedit');
								$tpl->assign("titel", $row2["titel"]);
								$tpl->assign("email", $row2["email"]);
								$tpl->assign("content", $row2["content"]);
								$tpl->assign("ID", $row2["id"]);
							}
						}
						else{
							postwijzigen($_POST);
						}	
					}
					else{
						header('location:de%20muur.php');
					}
				}
				break;
	default:
	if (!isset($_POST['submit'])) {
		$profiel = getProfiel($_SESSION['email']);
		$tpl->assign("voornaam", $profiel["voornaam"]);
		$tpl->assign("achternaam", $profiel["achternaam"]);
		post($tpl, $_SESSION['id'], $_SESSION['groep_id']);
	}else{
		$profiel = getProfiel($_SESSION['email']);
		posttoevoegen($profiel, $_POST);
	}
		break;
}
$db = null;
$tpl->printToScreen();
}
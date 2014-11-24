<!DOCTYPE html>
<html>
	<head><title>admin paneel</title>
	<style>	
		img{width: 200px;
			height: auto;}

		</style>
	</head>
	
	<body>
		<p><a href = "de%20muur.php"> Terug naar de muur. </a></p>
		<!-- START BLOCK : profielen -->
		<table border = "1">
		<tr>
		 	<th>E-mail</th>
		 	<th>Voornaam</th>
		 	<th>Achternaam</th>
		    <th>Geboortedatum</th>
		    <th>Adres</th>
		    <th>Postcode</th>
		    <th>Woonplaats</th>
		    <th>Telefoon</th>
		    <th>Mobiel</th>
		    <th>Geslacht</th>
		    <th>Status</th>
		    <th colspan="2">profiel</th>

		   </tr>
		   <!-- START BLOCK : profiel -->
		   <tr>
		    <td>{email}</td>
		    <td>{voornaam}</td>
		    <td>{achternaam}</td>
		    <td>{geboortedatum}</td>
		    <td>{adres}</td>
		    <td>{postcode}</td>
		    <td>{woonplaats}</td>
		    <td>{telefoon}</td>
		    <td>{mobiel}</td>
		    <td>{geslacht}</td>  
		    <td>{status}</td>  
		    <td><a href="profiel.php?actie=view&email={email}">Profiel Tonen</a></td>
		    <!-- START BLOCK : banned -->
		    <td><a href="admin.php?actie=unban&email={email}">Unban.</a></td>
		    <!-- END BLOCK : banned -->
			<!-- START BLOCK : active -->
		    <td><a href="admin.php?actie=ban&email={email}">Bannen.</a></td>
		    <!-- END BLOCK : active -->
		   </tr>
		   <!-- END BLOCK : profiel -->
		</table>
		<!-- END BLOCK : profielen -->
	</body>
</html>
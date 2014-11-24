<!DOCTYPE html>
<html>
	<head><title>{HEAD}</title>

	<style>	
		img{width: 200px;
			height: auto;}

		</style>
	</head>
	<body>
	<p><a href="login.php?actie=uitloggen">Uitloggen!</a><p>
	<p><a href="profiel.php?actie=all">Alle profielen tonen.</a></p>
	<p><a href="de%20muur.php">Terug naar de muur!.</a></p>
		<!-- START BLOCK : profiel -->
<img src="{afbeelding}" alt = "Geen afbeelding ingesteld."></a>
			<p>E-mail: {email} </p>
			<p>Naam: {voornaam} {achternaam} </p>
			<p>Geboortedatum: {geboortedatum}</p>
			<p>Geslacht: {geslacht}</p>
			<p>Adres: {adres}</p>
			<p>Postcode: {postcode}</p>
			<p>Woonplaats: {woonplaats}</p>
			<p>Telefoon: {telefoon}</p>
			<p>Mobiel: {mobiel}</p>
			<!-- START BLOCK : wijzig -->
			<p><a href = "profiel.php?actie=afbeelding"> Avatar wijzigen. </a></p>
			<p><a href="profiel.php?actie=wijzigen"> Profiel wijzigen. </a></p>
			<p><a href="profiel.php?actie=wachtwoord"> Wachtwoord wijzigen. </a></p>
			<p><a href="de%20muur.php"> terug naar de muur </a></p>
			<!-- END BLOCK : wijzig -->
		<!-- END BLOCK : profiel -->
	<!-- START BLOCK : profielen -->
	<table border = "1">
		<tr>
			<th>E-mail</th>
			<th>Naam:</th>
			<th>Geboortedatum:</th>
			<th>Geslacht:</th>
			<th>Adres:</th>
			<th>Postcode:</th>
			<th>Woonplaats:</th>
			<th>Telefoon:</th>
			<th>Mobiel:</th>
			<th>Tonen</th>
		</tr>
		<!-- START BLOCK : profielen2 -->
		<tr>
			<td>{email}</td>
			<td>{voornaam} {achternaam}</td>
			<td>{geboortedatum}</td>
			<td>{geslacht}</td>
			<td>{adres}</td>
			<td>{postcode}</td>
			<td>{woonplaats}</td>
			<td>{telefoon}</td>
			<td>{mobiel}</td>
			<td><a href = "profiel.php?actie=view&email={email}">Profiel tonen.</a></td>
		</tr>
		<!-- END BLOCK : profielen2 -->

	</table>
	<!-- END BLOCK : profielen -->
	<!-- START BLOCK : wijzigen -->
	<form method="post" action="de%20muur.php?actie=wijzigen">
		<p>
			<label>Voornaam:</label>
			<input type="text" name="voornaam" value= "{voornaam}">
			<input type="hidden" name="email" value= "{email}">
		</p>	
		<p>
			<label>Achternaam:</label>
			<input type="text" name="achternaam" value= "{achternaam}">
		</p>
		<p>
			<label>Geboortedatum:</label>
			<input type="date" name="geboortedatum" value= "{geboortedatum}">
		</p>
		<p>
			<label>Adres:</label>
			<input type="text" name="adres" value= "{adres}">
		</p>	<p>
			<label>Postcode:</label>
			<input type="text" name="postcode" value= "{postcode}">
		</p>
		<p>
			<label>Woonplaats:</label>
			<input type="text" name="woonplaats" value= "{woonplaats}">
		</p>
		<p>
			<label>Telefoon:</label>
			<input type="text" name="telefoon" value= "{telefoon}">
		</p>
		<p>
			<label>Mobiel:</label>
			<input type="text" name="mobiel" value= "{mobiel}">
		</p>
			<p>
				<label>Geslacht: </label>
					<select name="geslacht"><option value="0">-</option>
					<option value="man" {SELECTEDMAN}>man</option>
					<option value="vrouw" {SELECTEDVROUW}>vrouw</option></select>
				</p>
		<p>
			<input type="submit" name = "submit" value = "wijzigen">
		</p>
		</form>
	<!-- END BLOCK : wijzigen -->
	<!-- START BLOCK : afbeelding -->
		<form method="post" action="profiel.php?actie=afbeelding">
			<p>
				<label>Link voor afbeelding:</label>
				<input type="text" name = "afbeelding" value = "{afbeelding}">
				<input type="hidden" name = "email" value = "{email}">
				<input type="submit" name = "submit" value = "afbeelding wijzigen">
			</p>
		<p><a href = "profiel.php?actie=profiel">Terug naar het profiel.</a></p>
		</form>
	<!-- END BLOCK : afbeelding -->
	<!-- START BLOCK : wachtwoord -->
		<form method="post" action="profiel.php?actie=wachtwoord">
			<p>{wachtwoordfout}
				<label>Oud wachtwoord: </label>
				<input type="password" name = "oldpaswoord">
			</p>
			<p>
				<label>Nieuw Wachtwoord: </label>
				<input type="password" name = "paswoord1">
			</p>
			<p>
			<label>Wachtwoord herhalen: </label>
			<input type="password" name = "paswoord2">
				<input type="submit" name = "submit" value = "wijzigen">
			</p>
		<p><a href = "profiel.php?actie=profiel">Terug naar het profiel.</a></p>
		</form>
	<!-- END BLOCK : wachtwoord -->
	</body>
	</html>
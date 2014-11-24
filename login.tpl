<!DOCTYPE html>
<html>
<head> <title>Login bij the wall</title>
	<meta charset='utf-8'>
		<style>
			label{
			width: 10em;
			float: left;
			}
			div.login{
				width: 300px;
			}
			div.toevoegen{
				float: right;
				width: 400px;
			}
		</style>
</head>
<body>
<!-- START BLOCK : login -->
		<div class="login">
		<h1>Inloggen</h1>
		<p>{FOUT}</p>
			<form method="post" action="login.php?actie=check">
			<p>
				<label>E-mail: </label>
				<input type="text" name="email" required>
			</p>
			<p>
				<label>Wachtwoord:</label>
				<input type="password" name="paswoord" required>
				<input type="submit" name="submit">
			</p>
			</form>
		</div>
<!-- END BLOCK : login -->
<!-- START BLOCK : toevoegen -->
		<div class="toevoegen">
		<h1>Toevoegen</h1>
		<p>{EMAILFOUT} {MSG}</p>
			<form method="post" action="login.php?actie=toevoegen">
			<p>
				<label>E-mail: </label>
				<input type="text" name="email" value="{email}" required>
			</p>
			<p>
				<label>Wachtwoord: </label>
				<input type="password" name="paswoord1" required>
			</p>
			<p>
				<label>Wachtwoord herhalen: </label>
				<input type="password" name="paswoord2" required>
			</p>
			<p>
				<label>Voornaam: </label>
				<input type="text" name="voornaam" value="{voornaam}" required>
			</p>
			<p>
				<label>Achternaam: </label>
				<input type="text" name="achternaam" value="{achternaam}">
			</p>
			<p>
				<label>Geboortedatum: </label>
				<input type="date" name="geboortedatum" value="{geboortedatum}"required>
			</p>
			<p>
				<label>Adres: </label>
				<input type="text" name="adres" value="{adres}">
			</p>
			<p>
				<label>Postcode: </label>
				<input type="text" name="postcode" value="{postcode}">
			</p>
			<p>
				<label>Woonplaats: </label>
				<input type="text" name="woonplaats" value="{woonplaats}">
			</p>
			<p>
				<label>Telefoon: </label>
				<input type="text" name="telefoon" value="{telefoon}">
			</p>
			<p>
				<label>Mobiel: </label>
				<input type="text" name="mobiel" value="{mobiel}">
			</p>
			<p>
			<label>Geslacht: </label>
				<select name="geslacht"><option value="niet opgegeven">-</option>
				<option value="man" {SELECTEDMAN}>man</option>
				<option value="vrouw" {SELECTEDVROUW}>vrouw</option></select>
			</p>
			<p>
				<input type="submit" name = "submit" value = "registreren">
			</p>
			</form>
		</div>
<!-- END BLOCK : toevoegen -->
</body>
</html>
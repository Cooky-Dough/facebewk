<!DOCTYPE html>
<html>
	<head><title>{HEAD}</title>
	</head>
	<body>
	<p><a href="login.php?actie=uitloggen">Uitloggen!</a><p>
	<p><a href="profiel.php?actie=all">Alle profielen tonen.</a></p>
	<p><a href="profiel.php?actie=profiel">Welkom {voornaam} {achternaam}, Naar jou profiel.</a><p>
	<!-- START BLOCK : plaatsen-->

	<form action = "de%20muur.php" method = "POST">
		<p>
			<label>Titel: </label>
			<input type="text" name = "title">
		</p>
		<p>
			<label>Content: </label>
			<textarea type="text" name = "content"></textarea>
			<input type="submit" name = "submit" value="posten">
		</p>
	</form>
	<!-- END BLOCK : plaatsen -->
	<!-- START BLOCK : postedit -->
		<form method="post" action="de%20muur.php?actie=postwijzigen&id={ID}">
		<p>
			<label>Title:</label>
			<input type="text" name="titel" value= "{titel}">
			<input type="hidden" name="id" value= "{ID}">
		</p>	
		<p>
			<label>Content:</label>
			<textarea type="text" name="content">{content}</textarea>
		</p>
		<p>
			<input type="submit" name = "submit" value = "wijzigen">
		</p>
		</form>
					<p><a href="de%20muur.php"> terug naar de muur </a></p>

	<!-- END BLOCK : postedit -->
		<!-- START BLOCK : commentedit -->
		<form method="post" action="de%20muur.php?actie=commentwijzigen&id={ID}">
			<input type="hidden" name="id" value= "{ID}">		
		<p>
			<label>Content:</label>
			<textarea type="text" name="content">{content}</textarea>
		</p>
		<p>
			<input type="submit" name = "submit" value = "wijzigen">
		</p>
		</form>
		<p><a href="de%20muur.php"> terug naar de muur </a></p>
		</p>

	<!-- END BLOCK : commentedit -->
	<!-- START BLOCK : commenttoevoegen -->
		<form method="post" action="de%20muur.php?actie=commenttoevoegen">
			<input type="hidden" name="id" value= "{ID}">	
		<p>
			<label>Content:</label>
			<textarea type="text" name="content">{content}</textarea>
		</p>
		<p>
			<input type="submit" name = "submit" value = "Commenten.">
		</p>
		</form>
		<p><a href="de%20muur.php"> terug naar de muur </a></p>
	<!-- END BLOCK : commenttoevoegen -->

	<!-- START BLOCK : commentopcomment -->
			<form method="post" action="de%20muur.php?actie=commentopcomment	">
			<input type="hidden" name="id" value= "{ID}">	
		<p>
			<label>Content:</label>
			<textarea type="text" name="content">{content}</textarea>
		</p>
		<p>
			<input type="submit" name = "submit" value = "Commenten.">
		</p>
		</form>
		<p><a href="de%20muur.php"> terug naar de muur </a></p>
	<!-- END BLOCK : commentopcomment -->
	<!-- START BLOCK : post -->
			<h2> {titel}</h2>
			<p> {content} </p>
			<p> {datum} </p>
			<p> gepost door: <a href = "profiel.php?actie=view&email={email}">{voornaam} {achternaam}</a></p>
			<!-- START BLOCK : likes -->
			<p> Aantal likes: {LIKES}.
			<!-- END BLOCK : likes -->
			<!-- START BLOCK : like -->
			<p> <a href = "de%20muur.php?actie=likepost&id={ID}&type=post">Like.</a></p>
			<!-- END BLOCK : like -->
			<!-- START BLOCK : dislike -->
			<p> <a href = "de%20muur.php?actie=dislikepost&id={ID}&type=post">Dislike.</a></p>			
			<!-- END BLOCK : dislike -->
			<p> <a href = "de%20muur.php?actie=commenttoevoegen&id={ID}">Comment.</a></p>
			<!-- START BLOCK : edit -->
				<p><a href = "de%20muur.php?actie=postwijzigen&id={ID}">Post editen. </a> </p>
				<p><a href = "de%20muur.php?actie=postdelete&id={ID}">Post deleten.</a></p>
			<!-- END BLOCK : edit -->	
			<!-- START BLOCK : comment -->
			<ul>
				<p> {content} </p>
				<p> {datum} </p>
				<p> gepost door: <a href = "profiel.php?actie=view&email={email}">{voornaam} {achternaam}</a></p>
				<!-- START BLOCK : LIKES2 -->
				<p> Aantal likes: {LIKES2}.
				<!-- END BLOCK : LIKES2 -->
				<!-- START BLOCK : like2 -->
				<p> <a href = "de%20muur.php?actie=likepost&id={ID}&type=comment">Like.</a></p>
				<!-- END BLOCK : like2 -->
				<!-- START BLOCK : dislike2 -->
				<p> <a href = "de%20muur.php?actie=dislikepost&id={ID}&type=comment">Dislike.</a></p>			
				<!-- END BLOCK : dislike2 -->
				<p><a href = "de%20muur.php?actie=commentopcomment&id={ID}"> Comment </a></p>
				<!-- START BLOCK : edit2 -->
				<p><a href = "de%20muur.php?actie=commentwijzigen&id={ID}">Comment editen. </a> </p>
				<p><a href = "de%20muur.php?actie=commentdelete&id={ID}">Comment deleten.</a></p>
			<!-- END BLOCK : edit2 -->	
			<!-- START BLOCK : comment2 -->
			<br>
				<ul>
				<p> {content} </p>
				<p> {datum} </p>
				<p> gepost door: <a href = "profiel.php?actie=view&email={email}">{voornaam} {achternaam}</a></p>
				<!-- START BLOCK : LIKES3 -->
				<p> Aantal likes: {LIKES3}.
				<!-- END BLOCK : LIKES3 -->
				<!-- START BLOCK : like3 -->
				<p> <a href = "de%20muur.php?actie=likepost&id={ID}&type=comment">Like.</a></p>
				<!-- END BLOCK : like3 -->
				<!-- START BLOCK : dislike3 -->
				<p> <a href = "de%20muur.php?actie=dislikepost&id={ID}&type=comment">Dislike.</a></p>			
				<!-- END BLOCK : dislike3 -->
				<!-- START BLOCK : edit3 -->
				<p><a href = "de%20muur.php?actie=commentwijzigen&id={ID}">Comment editen. </a> </p>
				<p><a href = "de%20muur.php?actie=commentdelete&id={ID}">Comment deleten.</a></p>
			<!-- END BLOCK : edit3 -->	
			</ul>
			<!-- END BLOCK : comment2 -->
			<br>
			</ul>
			<!-- END BLOCK : comment -->
		<!-- END BLOCK : post -->
	</body>
	</html>
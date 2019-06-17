<?php
	$x=1;
	$pseudo='Laurent';
	$image='image.png';
	if($x==0)
	{
?>
		<section id="BHeader">
			<div id="blocHeader">
				<p class = "headerCon"><?php echo $pseudo; ?></p>
				<img  id="headerimage"" alt="logo-S" src="<?php echo $image; ?>">
				<form class = "headerCon" action="RedConnexion.php" method="Post" id="déconnexion"></form>
				<input class = "headerConInput" id ="headerinput"" type="submit" form="déconnexion" value="déconnexion"/>
			</div>
		</section>
<?php
	}
	else
	{
?>
		<section id="BHeader">
			<div id="blocHeader">
				<form class = "headerCon" action="RedConnexion.php" method="Post" id="connexion">
					<p class = "headerCon"> Identifiant : <input class = "headerConInput" type="text" name="pseudo" size="30"/> </p>
					<p class = "headerCon"> Mot de passe : <input class = "headerConInput" type="text" name="password" size="30"/> </p>
				</form>
				<input class = "headerConInput" id ="headerinput" type="submit" form="connexion" value="connexion"/>
			</div>
		</section>
<?php
	}
?>
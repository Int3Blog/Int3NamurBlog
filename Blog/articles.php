<!DOCTYPE html>
<html>
<head>
	<title>Genre</title>
	<link href="cssglobal.css" rel="stylesheet">
	<link href="cssarticles.css" rel="stylesheet">
	<link href="cssheader.css" rel="stylesheet">
</head>
<body>
	
	<?php 

		if(isset($_GET[id]) && ($_GET[id] > 0)){
			$bdd = new
			PDO('mysql:host=localhost;dbname=blog;charset=utf8','root','',
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
			
			$response = $bdd->query
			("SELECT * FROM articles
			JOIN utilisateurs
			ON articles.idAuteur = utilisateurs.id
			WHERE articles.id = ".$_GET[id]);
			
			$Data = $response->fetchObject();
		}
			?>
	
	<div id="conteneur">
	
		<div id="readingzone">
			<div id="articlehead">
				<h2><?php echo $Data->titre ?></h2>
				<h3>Placeholder title</h3>
			
				<img src=<?php echo $Data->imageLien ?>>
			</div>
			
			<div id="articlebody">
				<?php echo $Data->contenu ?>
				
				<div class="author"><?php echo $Data->pseudo ?></div>
			</div>
			
			<div id="commentsection">
				<h2>Commentaires</h2>
				
				<form>
					<textarea id="toncommentaire" name="toncommentaire" cols=40 rows=3 placeholder="Votre joli commentaire"></textarea>
				</form>
				<input type="submit" form="toncommentaire" value="Poster"/>
				
				<div class="comment">
					<div class="newcomment">
						<div class="visualinfo">
							<img src="Pantherk.jpg">
						</div>
						<div class="userinfo">
							<span class="username">Pantherk</span></br>
							<span class="numberposts">1203 messages</span><br>
							<span class="datepost">Message posté le 14/06/2019</span>
						</div>
						<div class="commentcontent">
							ＰＡＮＴＨＥＲＫ
						</div>
					</div>
					
					<div class="newcomment">
						<div class="visualinfo">
							<img src="T800.jpg">
						</div>
						<div class="userinfo">
							<span class="username">Terminatueur</span></br>
							<span class="numberposts">894 messages</span><br>
							<span class="datepost">Message posté le 13/06/2019</span>
						</div>
						<div class="commentcontent">
							Je retournerai à cet endroit à une date ultérieure... Incessament sous peu !
						</div>
					</div>
					
					<div class="newcomment">
						<div class="visualinfo">
							<img src="mansteque.jpg">
						</div>
						<div class="userinfo">
							<span class="username">Manstèque</span></br>
							<span class="numberposts">614 messages</span><br>
							<span class="datepost">Message posté le 13/06/2019</span>
						</div>
						<div class="commentcontent">
							En fait, je crois que t'es une sorte d'Oracle à l'âge du numérique, parce que tu nous as fait un tour de Montagnes Russes dans un parc d'attraction de Corée du Nord, excitant et glaçant avec des tentures de soie, gonflées par le vent d'Est qui balaye la steppe.<br>
							Par moments, on sentait que tu perdais pied, mais c'était pour mieux retomber sur tes pattes, comme un félin vocal élégant et moqueur donc franchement je sais pas combien de vies tu as vécu, mais là, c'est juste fou d'avoir autant de talent.<br>
							Je sais pas trop ce qu'on peut t'apprendre, en fait.<br>
						</div>
					</div>
				</div>
			</div>
				
		</div>
		
	</div>
		
</body>
</html>
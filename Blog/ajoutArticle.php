<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajout Article</title>
</head>
<style>
@import url('https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap');

body
{
width:800px;
padding:2em;
margin:auto;

}

form
{
font-family:arial;
width:auto;
height:500px;
border:1px solid black;
padding:3em 2em 2em 2em;
margin:5em auto;
text-align:left;
border-radius:50px;
background-color:#fa983a;

}

#upload
{
border:1px solid black;
border-radius:5px;
margin:0.5em;
background-color:#f8c291;
}

#titre
{
font-family:arial;
display:block;
width:600px;
height:auto;
margin:0.5em ;
border:1px solid black;
border-radius:5px;
background-color:#f8c291;
}

#submitArticle
{
position:relative;
left:600px;
font-family:arial;
}

textarea
{
width:auto;
height:auto;
margin:0.5em auto;
background-color:#f8c291;
border:1px solid black;
border-radius:5px;
}

h3
{
	text-align:center;
	font-family: 'Roboto Condensed', sans-serif;
	font-size:2.5em;
}

select
{
	background-color:#f8c291;
}

</style>
<body>
<div class="aside">
</div>
<form method="post" action="ajoutArticleControleur.php">
<h3>Ajouter un article</h3>
Titre: <input type="text" name="titre" id="titre">
Upload <input type="text" name="fileToUpload" id="upload"> 
<br>
Texte de l'article : <br><textarea rows="10" cols="80" name="contenuArticle"></textarea>
<br><input type="submit" value="Envoyer article" name="submitArticle" id="submitArticle">
Genre:<select name="genreSelect">
	<?php 
		require_once('fonctionsDAL.php');
		$database = connexionBDD();
		$genre = extraitListeGenres($database);
		//print_r($genre);
		
		echo '<option value="'.$genre[0]['id'].'" selected>'.$genre[0]['genre'].'</option>';
		for($i=1;$i<count($genre);$i++)
			{
				echo '<option value="'.$genre[$i]['id'].'">'.$genre[$i]['genre'].'</option>';
			}
	?>
</select>
</form>

</body>
</html>







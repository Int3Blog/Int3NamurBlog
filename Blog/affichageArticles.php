<!DOCTYPE html>
<html>
	<head>
		<title>Articles</title>
	</head>
	<body>	
<?php
	require("fonctionsDAL.php");
	require("apercuArticle.php");
	$BDD= connexionBDD();
	
	//extraitsArticlesRecents($BDD,6,0);
	$tabAffichagesArticles = extraitsArticlesRecents($BDD,6,0);

	for($i = 0; $i < count($tabAffichagesArticles); $i++)
	{
		$id = $tabAffichagesArticles[$i]['id'];
		$titre = $tabAffichagesArticles[$i]['titre'];
		$contenu = $tabAffichagesArticles[$i]['contenu']; 
		$lienImage = $tabAffichagesArticles[$i]['imageLien']; 
		$auteur = $tabAffichagesArticles[$i]['pseudo'];
		$genre = $tabAffichagesArticles[$i]['genre']; 
		$dateHeureCreation = $tabAffichagesArticles[$i]['dateCreation']; 
		$dateHeureModification = $tabAffichagesArticles[$i]['dateModif']; 
		$NbreVues = $tabAffichagesArticles[$i]['nbreVues'];
		
		apercuArticle($id,$titre,$contenu,$lienImage,$auteur,$genre,$dateHeureCreation,$dateHeureModification,$NbreVues);
		
		?>
			<style>
				article{
				border-bottom:1px solid black;
				}
			</style>
		<?php
	}
	?>
	</body>
</html>

<?php session_start();
	require_once("../Communs/fonctionsDAL.php");
	require_once("apercuArticle.php");?>
<!DOCTYPE html>
<html>
	<head>
		<title>Articles</title>
		<style><?php include 'tempCSS.css'?></style>
	</head>
	<body>
	<div class="wrapper">
	  <header class="header"><?php include '../Communs/header.php'?></header>
	  <article class="main">
	    <?php
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
			}
		?> 
	  </article>
	  <aside class="aside aside-1"> <?php include '../Communs/barre_lateral.php' ?></aside>
	  <footer class="footer"><?php include '../Communs/footer.php' ?></footer>
	</div>	
	</body>
</html>

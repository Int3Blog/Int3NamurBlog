<?php
	require_once("fonctionsDAL.php");
	if(isset($_POST["titre"]) && $_POST["titre"] != ""){
		if(isset($_POST["fileToUpload"]) && $_POST["fileToUpload"] != ""){
			if(isset($_POST["contenuArticle"]) && $_POST["contenuArticle"] != ""){
				if(isset($_POST["genreSelect"]) && $_POST["genreSelect"] != ""){
					$BDD = connexionBDD();
					$titre = $_POST["titre"];
					$contenu = $_POST["contenuArticle"];
					$idGenre = $_POST["genreSelect"];
					$imageLien = $_POST["fileToUpload"];
					ajoutArticle($BDD,$titre,$contenu,$idGenre,1,$imageLien);
				}
			}
		}
	}
	header('Location: ajoutArticle.php');
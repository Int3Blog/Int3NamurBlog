<?php
	session_start();
	require_once(__DIR__.'/../Communs/fonctionsDAL.php');
	if(isset($_SESSION['estConnecte']) && $_SESSION['estConnecte']){
		echo "Coco";
		if(isset($_POST["titre"]) && $_POST["titre"] != ""){
			if(isset($_POST["fileToUpload"]) && $_POST["fileToUpload"] != ""){
				if(isset($_POST["contenuArticle"]) && $_POST["contenuArticle"] != ""){
					if(isset($_POST["genreSelect"]) && $_POST["genreSelect"] != ""){
						$BDD = connexionBDD();
						$titre = $_POST["titre"];
						$contenu = $_POST["contenuArticle"];
						$idGenre = $_POST["genreSelect"];
						$imageLien = $_POST["fileToUpload"];
						$idAuteur = $_SESSION['idUtilisateur'];
						ajoutArticle($BDD,$titre,$contenu,$idGenre,$idAuteur,$imageLien);
					}
				}
			}
		}
	}
	else{
		echo "pas coco";
		if(isset($_POST["titre"]) && $_POST["titre"] != ""){
			if(isset($_POST["fileToUpload"])/* && $_POST["fileToUpload"] != ""*/){
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
	}
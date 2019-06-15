<?php
	session_start();
	require_once("../Communs/fonctionsDAL.php");
	require_once("../Communs/utils.php");
	if(isset($_SESSION['estConnecte']) && $_SESSION['estConnecte'] === true){
		$idAuteur = $_SESSION['idUtilisateur'];
	}
	else{
		$idAuteur = 1;
	}
	if(isset($_POST["titre"]) && $_POST["titre"] != ""){
		if(isset($_POST["contenuArticle"]) && $_POST["contenuArticle"] != ""){
			if(isset($_POST["genreSelect"]) && $_POST["genreSelect"] != ""){
				$BDD = connexionBDD();
				$titre = $_POST["titre"];
				$contenu = $_POST["contenuArticle"];
				$idGenre = $_POST["genreSelect"];
				if(is_uploaded_file($_FILES['fileToUpload']['tmp_name'])){
					if(addImage()){
						$imageLien = basename( $_FILES["fileToUpload"]["name"]);
					}
					else{
						echo "Erreur lors de l'ajout <br>";
					}
				}
				else{
					$imageLien = "";
				}
				ajoutArticle($BDD,$titre,$contenu,$idGenre,$idAuteur,$imageLien);
			}
		}
	}
	header('Location: ajoutArticle.php');
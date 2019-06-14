<?php
	require_once(__DIR__.'/../Communs/fonctionsDAL.php');

	if(isset($_POST["pseudo"])&& $_POST["pseudo"]!=" "){
		if(isset($_POST["motDePasse"])&& $_POST["motDePasse"]!=" "){
			if(isset($_POST["email"])&& $_POST["email"]!=" "){
				if(isset($_POST["imageLien"])){
					if(isset($_POST["niveauAdmin"])&& $_POST["niveauAdmin"]!=" "){
					
					
					$bdd = connexionBDD();
					
					$pseudo = $_POST["pseudo"];
					$motDePasse = $_POST["motDePasse"];
					$email = $_POST["email"];
					$imageLien = $_POST["imageLien"];
					$niveauAdmin = $_POST["niveauAdmin"];
					
					ajoutUtilisateur($bdd, $pseudo, $motDePasse, $email,$imageLien, $niveauAdmin);
					
					
					
					}
				}
			}
		}
	}

	header('Location: front_AjoutUtilisateur_blog.php');



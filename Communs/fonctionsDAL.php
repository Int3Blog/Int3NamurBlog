<?php
	function connexionBDD()
	{
		if($debug=true)
		{
			return new PDO('mysql:host=localhost;dbname=Blog;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		else
		{
			return new PDO('mysql:host=localhost;dbname=Blog;charset=utf8', 'root', '');
		}
	}
	
	function ajoutUtilisateur($bdd, $pseudo, $motDePasse, $email, $imageLien, $niveauAdmin)
	{
		//Test des paramètres
		$boolOK = true;

        //Pseudo
		$Pseudo= trim($pseudo);
		$clean_Pseudo = filter_var($Pseudo,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		if($Pseudo==$clean_Pseudo)
		{
			//S'il n'y avait aucun caractère problématique
			//on tronque si nécessaire
			if(strlen($clean_Pseudo)>16) 
            {
                $clean_Pseudo = substr($Pseudo, 0,16);
            }
            
        }
        else
        {
            $boolOK=false;
        }

          //motdepasse
		$Password= trim($motDePasse);
		$clean_Password = filter_var($Password,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		if($Password==$clean_Password)
		{
			//S'il n'y avait aucun caractère problématique
			//on tronque si nécessaire
			if(strlen($clean_Password)>16) 
            {
                $clean_Password = substr($Password, 0,16);
            }
        }
        else
        {
            $boolOK=false;
        }


        //Email
		$mail = trim($email);
		$clean_mail = filter_var($email,FILTER_SANITIZE_EMAIL);
		if ($email == $clean_mail){
			// Si on a un email, et que celui-ci ne contenait aucun caractère problématique
			// Si nécessaire, on tronque
			if(strlen($clean_mail)>16){

                $clean_mail = substr($mail, 0,16);
            } 
        }
        else
        {
            $boolOK=false;
        }


        //imageLien
		$Lien= trim($imageLien);
		$clean_Lien = filter_var($Lien,FILTER_SANITIZE_URL);
		if($Lien==$clean_Lien)
		{
			//S'il n'y avait aucun caractère problématique
			//on tronque si nécessaire
			if(strlen($clean_Lien)>128) 
            {
                $clean_Lien = substr($Lien, 0,128);
            }   
        }
        else
        {
            $boolOK=false;
        }

        //niveauAdmin
		$Level= trim($niveauAdmin);
		$clean_Level = filter_var($Level,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		if($Level==$clean_Level)
		{
			//S'il n'y avait aucun caractère problématique
			//on tronque si nécessaire
			if(strlen($clean_Level)>20) 
            {
                $clean_Level = substr($Level, 0,20);
            }
        }
        else
        {
            $boolOK=false;
        }
		
		//Preparation Requete (insert into)
		$ajoutUtil = $bdd->prepare("INSERT INTO Utilisateurs 
												VALUES(DEFAULT,
														:pseudo,
														:motDePasse,
														:email,
														:imageLien,
														NOW(),
														NOW(),
														0,
														:niveauAdmin)");
		//Execution de la requête
		$ajoutUtil->execute(array(	'pseudo' => $pseudo,
									'motDePasse' => $motDePasse,
									'email' => $email,
									'imageLien' => $imageLien,
									'niveauAdmin' => $niveauAdmin));
	}
		
	function ajoutGenre ($genre, $manipulateurBDD)
	{
		if( trim($genre)!='' && preg_match ( '/^[a-z é è-]+$/i' , $genre ))
		{
			$ajoutGenre = $manipulateurBDD->prepare('INSERT INTO genres (genre) VALUES (:genre)');
			$ajoutGenre->execute(array('genre' => $genre));
		}
		else
		{
			return false;
		}
	}
	
	function ajoutArticle(PDO $bdd,$titre,$contenu,$idGenre,$idAuteur,$imageLien)
    {
        $boolOK = true; //Si reste true, on peu envoyer

        //titre
		$titre= trim($titre);
		$clean_titre = filter_var($titre,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		if($titre==$clean_titre)
		{
			//S'il n'y avait aucun caractère problématique
			//on tronque si nécessaire
			if(strlen($clean_titre)>64) 
            {
                $clean_titre = substr($titre, 0,64);
            }
        }
        else
        {
            $boolOK=false;
        }

        //contenu
		$Contenu = trim($contenu);
        $clean_contenu = filter_var($Contenu,FILTER_SANITIZE_STRING);
		if($Contenu==$clean_contenu)
		{
			if(strlen($clean_contenu)>5096) 
            {
                $clean_contenu = substr($Contenu, 0,5096);
            }
            
        }
        else
        {
            $boolOK=false;
        }

        //idGenre
		$idgenre = trim($idGenre);
		$clean_idgenre = filter_var($idgenre,FILTER_SANITIZE_NUMBER_INT);
		if ($idgenre == $clean_idgenre)
		{}
        else
        {
            $boolOK=false;
        }

        //idAuteur
		$createur = trim($idAuteur);
		$clean_idAuteur = filter_var($createur,FILTER_SANITIZE_NUMBER_INT);
        if ($createur == $clean_idAuteur)
		{}
        else
        {
            $boolOK=false;
        }

        if($boolOK==true)
		{
			$reqInsert = $bdd->prepare("INSERT INTO articles
										VALUES(DEFAULT,
											   :titre,
											   now(),
											   now(),
											   :contenu,
											   0,
											   :idGenre,
											   :idAuteur,
											   :imageLien
											   )");

			$reqInsert->execute(array('titre'=>$titre,
									  'contenu'=>$contenu,
									  'idGenre'=>$idGenre,
									  'idAuteur'=>$idAuteur,
									  'imageLien'=>$imageLien)); 
		} 
    }
	
	function ajoutCommentaire($message,$idArticle,$idAuteur,$BDD)
	{
		$message = filter_var($message,FILTER_SANITIZE_STRING);
			$reponse = $BDD->prepare("INSERT INTO Commentaires (idArticle, message,dateHeureCreation, dateHeureModification, idAuteur) VALUES (:idArticle,:message,NOW(),NOW(),:idAuteur)");
			
		$reponse->execute(array(
			'idArticle'=>$idArticle,
			'message'=>$message,
			'idAuteur'=>$idAuteur
		));	
	}
	
	function trouverUtilisateur($pseudo,$BDD)
	{
		$pseudoClean = filter_var(trim($pseudo),FILTER_SANITIZE_STRING);
		$req = $BDD->prepare('SELECT id FROM utilisateurs WHERE pseudo = ? LIMIT 1');
		$req->execute(array($pseudoClean));
		
		if($reponse = $req->fetch())
		{
			return $reponse['id'];
		}
		else
		{
			return -1;
		}
	}
	
	function extraitUtilisateur($idUtilisateur, $BDD)
	{	
		if($idUtilisateur == filter_var($idUtilisateur, FILTER_VALIDATE_INT))
		{
			$reponse = $BDD->prepare("SELECT pseudo, email, imageLien, dateInscription, dateDerniereConnexion, nbrMessages, niveauAdmin FROM Utilisateurs WHERE id = :idUtilisateur LIMIT 1 ");	
			$reponse->execute(array('idUtilisateur'=>$idUtilisateur));
			return $donnees= $reponse->fetch();
		}
		else
		{
			return false;
		}
	}
	
	function listeReduiteUtilisateurs($BDD)
	{
		$reponse = $BDD->query("SELECT id, pseudo, niveauAdmin, imageLien FROM Utilisateurs");
		return $reponse->fetchAll();
	}
	
	function extraitArticle($idMessage,$BDD)
	{
		if($idMessage == filter_var($idMessage,FILTER_VALIDATE_INT))
		{
			$req = $BDD->prepare('SELECT a.id AS id,a.titre AS titre,a.dateHeureCreation AS dateCreation,a.dateHeureModification AS dateModif,
			a.contenu AS contenu,a.nbreVues AS nbreVues,u.pseudo AS pseudo,g.genre AS genre FROM articles AS a 
			JOIN utilisateurs AS u ON a.idAuteur = u.id JOIN genre AS g ON a.idGenre = g.id WHERE a.id = ? LIMIT 1');
			$req->execute(array($idMessage));
			if($reponse = $req->fetch())
			{
				return $reponse;
			}
			else
			{
				return -1;
			}
		}
		else
		{
			return -2;
		}
	}

	function extraitsArticlesRecents(PDO $BDD,$nbrArticles,$numPremierArticle,$genre = "")
	{
		if($nbrArticles == filter_var($nbrArticles,FILTER_VALIDATE_INT))
		{
			if($numPremierArticle == filter_var($numPremierArticle,FILTER_VALIDATE_INT))
			{
				if($genre == "")
				{
					$req = $BDD->prepare('SELECT a.id AS id,a.titre AS titre,a.dateHeureCreation AS dateCreation,a.dateHeureModification AS dateModif,
					a.contenu AS contenu,a.nbreVues AS nbreVues,u.pseudo AS pseudo,g.genre AS genre FROM articles AS a 
					JOIN utilisateurs AS u ON u.id = a.idAuteur JOIN genre AS g ON g.id = a.idGenre 
					ORDER BY dateCreation DESC LIMIT :nbrArticles OFFSET :offset');
					$req->bindValue('nbrArticles',$nbrArticles,PDO::PARAM_INT);
					$req->bindValue('offset',$numPremierArticle,PDO::PARAM_INT);
					$req->execute();
					if($reponse = $req->fetch())
					{
						return $reponse;
					}
					else
					{
						return -1;
					}
				}
				else
				{
					if($genre == filter_var($genre,FILTER_VALIDATE_INT))
					{
						$req = $BDD->prepare('SELECT a.id AS id,a.titre AS titre,a.dateHeureCreation AS dateCreation,a.dateHeureModification AS dateModif,
						a.contenu AS contenu,a.nbreVues AS nbreVues,u.pseudo AS pseudo,g.genre AS genre FROM articles AS a 
						JOIN utilisateurs AS u ON u.id = a.idAuteur JOIN genre AS g ON g.id = a.idGenre 
						WHERE a.idGenre = :genre ORDER BY dateCreation DESC LIMIT :nbrArticles OFFSET :id');
						$req->bindValue('nbrArticles',$nbrArticles,PDO::PARAM_INT);
						$req->bindValue('offset',$numPremierArticle,PDO::PARAM_INT);
						$req->bindValue('genre',$genre,PDO::PARAM_INT);
						$req->execute();
						if($reponse = $req->fetch())
						{
							return $reponse;
						}
						else{
							return -1;
						}
					}
				}
			}
		}
	}
	
	function extraitsArticlesPopulaires(PDO $BDD,$nbrArticles,$numPremierArticle,$genre = "")
	{
		if($nbrArticles == filter_var($nbrArticles,FILTER_VALIDATE_INT))
		{
			if($numPremierArticle == filter_var($numPremierArticle,FILTER_VALIDATE_INT))
			{
				if($genre == "")
				{
					$req = $BDD->prepare('SELECT a.id AS id,a.titre AS titre,a.dateHeureCreation AS dateCreation,a.dateHeureModification AS dateModif,
					a.contenu AS contenu,a.nbreVues AS nbreVues,u.pseudo AS pseudo,g.genre AS genre FROM articles AS a 
					JOIN utilisateurs AS u ON u.id = a.idAuteur JOIN genre AS g ON g.id = a.idGenre 
					ORDER BY nbreVues DESC, dateCreation DESC LIMIT :nbrArticles OFFSET :offset');
					$req->bindValue('nbrArticles',$nbrArticles,PDO::PARAM_INT);
					$req->bindValue('offset',$numPremierArticle,PDO::PARAM_INT);
					$req->execute();
					if($reponse = $req->fetch())
					{
						return $reponse;
					}
					else
					{
						return -1;
					}
				}
				else
				{
					if($genre == filter_var($genre,FILTER_VALIDATE_INT))
					{
						$req = $BDD->prepare('SELECT a.id AS id,a.titre AS titre,a.dateHeureCreation AS dateCreation,a.dateHeureModification AS dateModif,
						a.contenu AS contenu,a.nbreVues AS nbreVues,u.pseudo AS pseudo,g.genre AS genre FROM articles AS a 
						JOIN utilisateurs AS u ON u.id = a.idAuteur JOIN genre AS g ON g.id = a.idGenre 
						WHERE a.idGenre = :genre ORDER BY nbreVues DESC LIMIT :nbrArticles OFFSET :offset');
						$req->bindValue('nbrArticles',$nbrArticles,PDO::PARAM_INT);
						$req->bindValue('offset',$numPremierArticle,PDO::PARAM_INT);
						$req->bindValue('genre',$genre,PDO::PARAM_INT);
						$req->execute();
						if($reponse = $req->fetch())
						{
							return $reponse;
						}
						else
						{
							return -1;
						}
					}
				}
			}
		}
	}
	
	function extraitListeGenres(PDO $database)
	{ 
		$response = $database->query
			("SELECT * FROM genres ORDER BY id ASC");
		return $response->fetchAll(); 
	}
	
	function extraitTousCommentaires($BDD,$idArticle)
	{
		$reqPrep = $BDD->prepare("
		SELECT idArticle,dateHeureCreation,dateHeureModification,message,pseudo,commentaires.id As idCommentaire 
		FROM commentaires 
		JOIN utilisateurs ON commentaires.idAuteur = utilisateurs.id
		WHERE idArticle = :idArticle");
		
		$reqPrep->execute(array('idArticle'=>$idArticle));
		
		return $reqPrep->fetchAll();
	}
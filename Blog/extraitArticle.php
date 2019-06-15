<?php
	function extraitArticle($idMessage,$BDD){
		if($idMessage == filter_var($idMessage,FILTER_VALIDATE_INT)){
			$req = $BDD->prepare('SELECT a.id AS id,a.titre AS titre,a.dateHeureCreation AS dateCreation,a.dateHeureModification AS dateModif,
			a.contenu AS contenu,a.nbreVues AS nbreVues,a.imageLien AS imageLien,u.pseudo AS pseudo,g.genre AS genre FROM articles AS a 
			JOIN utilisateurs AS u ON a.idAuteur = u.id JOIN genre AS g ON a.idGenre = g.id WHERE a.id = ? LIMIT 1');
			$req->execute(array($idMessage));
			if($reponse = $req->fetch()){
				return $reponse;
			}
			else{
				return -1;
			}
		}
		{
			return -2;
		}
	}
	
	$BDD = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
	$article = extraitArticle(1,$BDD);
	
	print_r($article);
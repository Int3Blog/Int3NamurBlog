<?php

	$bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8','root','',
	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

	
	function createarticle($bdd,$titre,$dateHeureCreation,$dateHeureModification,$contenu,$nbrVues,$imageLien, $idAuteur, $idGenre){
		$response = $bdd->prepare('INSERT INTO articles
							(titre, dateHeureCreation, dateHeureModification, contenu, nbreVues, imageLien, idAuteur, idGenre)
							VALUES(:a, :b, :c, :d, :e, :f, :g, :h)');
							
					$response->execute(array(
					'a' => $titre,
					'b' => $dateHeureCreation,
					'c' => $dateHeureModification,
					'd' => $contenu, 
					'e' => $nbrVues, 
					'f' => $imageLien,
					'g' => $idAuteur,
					'h' => $idGenre
					));
			
	};
	
	function createcomment($bdd,$idArticle,$DateHeureCreation,$dateHeureModification,$idAuteur,$message){

		$response = $bdd->prepare('INSERT INTO commentaires
							(idArticle, dateHeureCreation, dateHeureModification, idAuteur, message)
							VALUES(:mm, :a, :b, :c, :d)');
							
					$response->execute(array(
					'mm' => $idArticle,
					'a' => $DateHeureCreation,
					'b' => $dateHeureModification,
					'c' => $idAuteur,
					'd' => $message
					));		
							
	};
	
	function creategenre($bdd,$genre){
		
		$response = $bdd->prepare('INSERT INTO genres
							(genre)
							VALUES(:a)');
							
					$response->execute(array(
					'a' => $genre
					));	
						
	};
	
	function createuser($bdd,$pseudo,$motDePasse,$email,$imageLien,$dateInscription,$dateDerniereConnexion,$nbrMessages,$niveauAdmin){
		$response = $bdd->prepare('INSERT INTO utilisateurs
							(pseudo, motDePasse, email, imageLien, dateInscription, dateDerniereConnexion, nbrMessages, niveauAdmin)
							VALUES(:a, :b, :c, :d, :e, :f, :g, :h)');
							
					$response->execute(array(
					'a' => $pseudo,
					'b' => $motDePasse,
					'c' => $email,
					'd' => $imageLien, 
					'e' => $dateInscription, 
					'f' => $dateDerniereConnexion,
					'g' => $nbrMessages,
					'h' => $niveauAdmin
					));
							
	};
	
	creategenre($bdd,'Économie');
	creategenre($bdd,'Films et cinéma');
	creategenre($bdd,'Technologie et multimédia');
	creategenre($bdd,'Programmation quantique');
	
	createuser($bdd,'Maurice','pousseLeBouchon','Maurice.Gervais@gmail.com', '<img>', '2019-03-24 00:00:00', '2019-06-12 00:00:00', '666', 'utilisateur');
	createuser($bdd,'ManiaxSkell','Bichon73Forever','Maniax.Skell@gmail.com', '<img>', '2019-03-07 00:00:00', '2019-06-12 00:00:00', '1589', 'moderateur');
	createuser($bdd,'Kevinos','ininitystone8','Kevinos.Puissant@stress.com', '<img>', '2019-01-22 00:00:00', '2019-06-12 00:00:00', '1889', 'admin');
	createuser($bdd,'Godolf','vousnepasserezpa','Godolf.Le.Rose@gmail.com', '<img>', '2018-09-30 00:00:00', '2019-06-12 00:00:00', '666', 'redacteur');
	createuser($bdd,'Pierre','jesuisuncaillou','Pierre@stress.com', '<img>', '1878-12-18 00:00:00', '2019-06-12 00:00:00', '2300', 'suspendu');
	
	createarticle($bdd,'Pourquoi devrions-nous boire de l\'eau tous les jours ?','2019-06-12 00:00:00','2019-06-12 00:00:00','<article></article>',117,'<img>',4, 3);
	createarticle($bdd,'Cinq astuces indispensables en case d\'attaque de ninjas !','2019-06-12 00:00:00','2019-06-12 00:00:00','<article></article>',354,'<img>',5, 2);
	createarticle($bdd,'Le Jquantique, le futur de la programmation ?','2019-06-12 00:00:00','2019-06-12 00:00:00','<article></article>',239,'<img>',4,4);
	createarticle($bdd,'Hobo With A Shotgun : Un grand film méconnu !','2019-06-12 00:00:00','2019-06-12 00:00:00','<article></article>',954,'<img>',5,2);
	
	createcomment($bdd,4,'2019-06-12 00:00:00','2019-06-12 00:00:00',2,'Chase your dreams. If you don\'t mind, don\'t be astounded by the things they make you do for amusement\'s sake !');
	createcomment($bdd,2,'2019-06-12 00:00:00','2019-06-12 00:00:00',3,'NO NO NO NO NO NO NO');
	createcomment($bdd,1,'2019-06-12 00:00:00','2019-06-12 00:00:00',4,'N\'oubliez pas de boire de l\'eau tous les jours ! Bien assurer son hydratation quotidienne est vital à la vie !');
	createcomment($bdd,2,'2019-06-12 00:00:00','2019-06-12 00:00:00',5,'VOUS NE PASSEREZ PAS !!!!');
	createcomment($bdd,1,'2019-06-12 00:00:00','2019-06-12 00:00:00',6,'Kevinos. S\'il te plaît. Arrête de me piquer tout le temps. J\'ai une grande sensibilité et cela me fait souffrir. Pense à mon bien-être s\'il te plaît !');

?>
<?php
	function addImage(){
		$dossierCible = "images/";
		$fichierCible = $dossierCible.basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$typeImage = strtolower(pathinfo($fichierCible,PATHINFO_EXTENSION));
		
		// On vérifie si c'est vraiment une image
		if(isset($_POST["submit"]))
		{
			$verif = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($verif !== false)
			{
				echo "Le fichier est bien une image - " . $check["mime"] . ".<br />";
				$uploadOk = 1;
			} 
			else
			{
				echo "Le fichier n'est pas une image.<br />";
				$uploadOk = 0;
			}
		}
		
		// On vérifie si le fichier existe dédjà
		if (file_exists($fichierCible))
		{
			echo "Déso, un fichier portant ce nom existe déjà.<br />";
			$uploadOk = 0;
		}
		
		// On vérifie la taille du fichier
		$tailleLimite = 500000; //En Byte
		if ($_FILES["fileToUpload"]["size"] > 500000)
		{
			echo "Désolé, le fichier est trop large (limite : ".$tailleLimite." Bytes) <br />";
			$uploadOk = 0;
		}
		
		// On vérifie le type du fichir
		if($typeImage != "jpg" && $typeImage != "png" && $typeImage != "jpeg"
			&& $typeImage != "gif" )
		{
			echo "Désolé, seulement les fichiers JPG, JPEG, PNG & GIF sont autorisés.<br />";
			$uploadOk = 0;
		}
		
		// On vérifie si on a eu une erreur ou non
		if ($uploadOk == 0)
		{
			echo "Désolé, votre fichier n'a pas été chargé.<br />";
			return false;
		}
		else
		{
			// Si tout est ok, on commence le téléversement
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $fichierCible))
			{
				echo "Le fichier ". basename( $_FILES["fileToUpload"]["name"]). " a été téléversé.<br />";
				return true;
			}
			else
			{
				echo "Désolé, une erreur est survenue durant le téléversement.<br />";
				return false;
			}
		}
	}
?>
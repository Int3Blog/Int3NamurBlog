<?php require_once(__DIR__.'/../Communs/fonctionsDAL.php');?>

<!DOCTYPE html>
<html>
	<head>
		<Title>Ajout d'un Utilisateur</Title>
		<style>
			th, td{
				font-size : 2em;
				color : grey;
			}
			th{
				background-color : orange;
			}
			td{
				background-color : cyan;
			}
		</style>
	</head>
	<body>
		<form action="backAjoutUtilisateur.php" method="POST" id="postForm">
			<div>
				<label> Pseudo : <input type="text" name="pseudo" id="idPseudo" required/></label>
			</div>
			<br>
			<div>
				<label> Mode de passe : <input type="password" name="motDePasse" id="idMdP" required/></label>
			</div>
			<br>
			<div>
				<label> Mail : <input type="email" name="email" id="idMail" required/></label>
			</div>
			<br>
			<div>
				<label> Image du lien : <input type="text" name="imageLien" id="idImageLien" /></label>
			</div>
			<br>
			<div>
				<label> Niveau Admin : </label>
				<select name='niveauAdmin'>
					<option value='admin'>Administrateur</option>
					<option value='moderateur'>Modérateur</option>
					<option value='redacteur'>Rédacteur</option>
					<option value='utilisateur'>Utilisateur</option>
					<option value='suspendu'>Suspendu(e)</option>
				</select>
			</div>
			<br>
		</form>
		<input type="submit" form="postForm" value="Envoyer"/>
		<br><br>
		<table>
			<thead>
				<th>ID</th>
				<th>Pseudo</th>
				<th>Niveau Admin</th>
			</thead>
			<tbody>
		<?php			
			$BDD = connexionBDD();
			
			listeReduiteUtilisateurs($BDD);
	
			$tabUtilisateurs = listeReduiteUtilisateurs($BDD);
			
			for($i=0; $i < count($tabUtilisateurs); $i++)
			{
				echo "<tr>";
				echo "<td>" . $tabUtilisateurs[$i]["id"] . "</td>";
				echo "<td>" . $tabUtilisateurs[$i]["pseudo"] . "</td>";
				echo "<td>" . $tabUtilisateurs[$i]["niveauAdmin"] . "</td>";
				echo "</tr>";
			}
		?>
			</tbody>
		</table>
		
		<?php	/*front
	utilisateur : pseudo,id, niveauadmin
	tableau
	
	ajout ce qui était dans le form
	donnees form POST
	appel ajoutUtilisateur
	function dal
	function header/vacation -> rapporte vers la page Front
	lienImage peut exister peut être vide
	*/?>
	</body>
</html>
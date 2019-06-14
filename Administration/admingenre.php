<?php 
require_once(__DIR__.'/../Communs/fonctionsDAL.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Genre</title>
	<link href="css.css" rel="stylesheet">
</head>
<body>
	

	<form action="AdminGenreCheck.php" method="POST" id="postForm">
		<p><label for="genre"><strong>Genre</strong> :  </label><input type="text" name="Genre" id="Genre" size="64"/></p>
	</form>
	<p><input type="submit" form="postForm" value="Ajouter"/> </p>

	<table>
		<thead>
			<th> ID </th>
			<th> Genre </th>
		</thead>
		<tbody>
		<?php
			$bdd=connexionBDD();
			$tabGenres=extraitListeGenres($bdd);
			
			for($i=0; $i < count($tabGenres); $i++)
			{
				echo "<tr>";
				echo "<td>".$tabGenres[$i]["id"]."</td>";
				echo "<td>".$tabGenres[$i]["genre"]."</td>";
				echo "</tr>";
			}
		?>
		</tbody>
	</table>

</body>
</html>
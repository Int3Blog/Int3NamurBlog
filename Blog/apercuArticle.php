<?php  
   function apercuArticle($id,$titre,$contenu,$lienImage,$auteur,$genre,$dateHeureCreation,$dateHeureModification,$NbreVues)
	{?>
  <div class="apercu">
    <div class="blocImage">
      <img src="../Images/<?php echo $lienImage; ?>">
    </div>
    <div class='apercuContent'> 
      <h1><a href="article.php?id=<?php echo $id; ?>"><?php echo $titre; ?></a></h1>
      <span><?php echo $auteur;?> | <?php echo $dateHeureCreation;?></span>
      <p><?php echo $contenu;?></p>
    </div>
  </div>
  <?php } ?>
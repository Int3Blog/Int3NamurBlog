<?php  
   function apercuArticle($id,$titre,$contenu,$lienImage,$auteur,$genre,$dateHeureCreation,$dateHeureModification,$NbreVues)
	{?>
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Create two columns/boxes that floats next to each other */
nav {
  float: left;
  width: 30%; 
  height: 300px; /* only for demonstration, should be removed */
  background: #ccc;
  padding: 20px;
}

/* Style the list inside the menu */
nav ul {
  list-style-type: none;
  padding: 0;
}

article {
  float: left;
  padding: 20px;
  width: 70%;
  background-color: #f1f1f1;
  height: 300px; /* only for demonstration, should be removed */
}

/* Clear floats after the columns */
section:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - makes the two columns/boxes stack on top of each other instead of next to each other, on small screens */
@media (max-width: 600px) {
  nav, article {
    width: 100%;
    height: auto;
  }
}
#cacher{
    visibility:hidden;
}
button{
    height: auto;
    margin:auto;
}
</style>

<section>
  <nav>
    <img src="../Images/"<?php echo $lienImage;?> " height=250 width=360>
  </nav>
 <article> 
    <h1><a href="article.php?id=<?php echo $id; ?>"><?php echo $titre; ?></a></h1>
    <span><?php echo $auteur;?> | <?php echo $dateHeureCreation;?></span>
    <p><?php echo $contenu;?></p>
  </article>
</section>
  <?php } ?>
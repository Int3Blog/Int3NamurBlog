<?php
require_once(__DIR__.'/../Communs/fonctionsDAL.php');

    if(isset($_POST['Genre']))
    {
     if($_POST['Genre']==''){
         $Genre =1;
     }
     else
     {
         $Genre = $_POST['Genre'];
     }
       
     $bdd=connexionBDD();
     ajoutGenre($Genre,$bdd);

    }
    header("location:adminGenre.php");
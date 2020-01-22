<!DOCTYPE html>
<html lang="ro">
  <link rel="stylesheet" type="text/css" href="style.css?version=8">
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <head>
    <meta charset="utf-8">    
    <title>
      <?php  
        if( basename($_SERVER['SCRIPT_NAME'], ".php") == "index" )echo "Home-Movies";
        else echo "Best Movies";
      ?>
    </title>
    
  </head>
  <body>
    <?php require_once('functions.php');  ?>
        
    <header>
     
      <nav>
        <div class="navigare">
          <img src="images/logo.png" style="width: 86px; float:left; border:none;">
          <div style="height:100%; margin-left:91px;">
            <a href="index.php" class="menu">Home</a>
            <a href="archive.php" class="menu" >Arhiva filme</a>
            <a href="genres.php" class="menu" >Genuri</a>
            <a href="contact.php" class="menu" >Contact</a>
          </div>
        </div>
        <div class="cautare">
          <form action="search-results.php" method="get">
            <input type="text" name="s" 
             style="border-radius: 5px 5px 5px 5px; background-color:darkturquoise;"
             /><input  
              style="border-radius: 10px 10px 30px 5px;
               background-color:orangered; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black; color:yellow;"
               type="submit" value="Cauta"
               />
          </form>
        </div>
      </nav>
    </header>
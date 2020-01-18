<?php
  require_once('header.php');
  $movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'));
?>
<h1>
 Vă punem la dispoziție o bază de <?php echo count($movies->movies); ?> filme împărțite pe <?php echo count($movies->genres); ?> genuri.
</h1>
<?php 
  $lista_filme=$movies->movies;
  $durataMax=cel_mai_lung_film($movies->movies);
  function comparator($object1, $object2) { 
    return $object1->year > $object2->year; 
  }  

  usort($lista_filme, 'comparator');
  $nr=count($lista_filme) - 1;
?>
<div style="display: flex;">
  <div class="col-filme" >
    <h1 class="col">10 cele mai noi filme</h1>
    <ol>
      <?php
        for($t=1 ; $t <= 10 ; $t++){
        $film_cur=$lista_filme[$nr];
        require('archive-movie.php');
        $nr--;
      ?>    
      <?php } 
        $nr=0;      
      ?>
    </ol>
  </div>

  <div class="col-filme">
    <h1 class="col">10 cele mai vechi filme</h1>
    <ol>
      <?php
        for($t=1 ; $t <= 10 ; $t++){
        $film_cur=$lista_filme[$nr];
        require('archive-movie.php');
        $nr++;
      ?>    
      <?php } ?>
    </ol>
  </div>
</div>
<?php require_once('footer.php'); ?>
<?php require_once('header.php'); ?>

  <?php   
    $movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;
    
    $toti_actorii=array();
    $durataMax=cel_mai_lung_film($movies);

    //afiseaza filme dintr-un anumit gen, daca acesta este introdus prin $_GET
    if( isset($_GET['genre']) && !empty($_GET['genre']) ){

      $_GET['genre']=ucwords(strtolower( $_GET['genre']) , '-');//ucwords pt ca pot fi mai multe cuvinte (film-noir,sci-fi)

      function genul_corect($val){
        return in_array($_GET['genre'] , $val->genres);
      }

      $moviesFiltrate=array_filter($movies , 'genul_corect');
      if(count($moviesFiltrate) > 0)
      {
        $movies=$moviesFiltrate;
        echo "<h1>Best " . $_GET['genre'] . " movies</h1>";
      }
      else echo '<h1>Best movies</h1>';

    }else echo '<h1>Best movies</h1>';
  ?>

  <div class="row">
    <div class="column">
      <ul class="a">
        <?php
          foreach($movies as $film_cur)
          {
        ?><?php require('archive-movie.php') ?>
        <?php } ?> 
      </ul>
    </div>
    <div class="column">
      <div class="fixed-sidebar-text">
        <h2>Actorii din filmele alese</h2>
        <ul>
          <?php
            $toti_actorii=array_unique($toti_actorii);
            sort($toti_actorii);
            foreach($toti_actorii as $d){
          ?>
          <li>
            <?php echo $d . "<br>";} ?>
          </li>
        </ul>
      </div>
    </div>
  </div>
<?php require_once('footer.php'); ?>
  
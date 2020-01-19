<?php
    require_once('header.php');
    require_once('functions.php');

    $movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;
    if( isset($_GET['movie_id']) && !empty($_GET['movie_id']) ){

        function idFilm($val){
          if($_GET['movie_id'] == $val->id)return true;
          else return false;
        }

        $moviesFiltrate=array_filter($movies , 'idFilm');
        if(count($moviesFiltrate) > 0){
           $film=reset($moviesFiltrate); 
?>
          <h1><?php echo $film->title; ?> </h1>
          <div style="padding-left:20px;" class="bla">
            <div class="imagine">
              <img 
                src="
                <?php 
                  if( @getimagesize($film->posterUrl) )echo $film->posterUrl;
                  else echo 'https://media3.picsearch.com/is?EHXO7tKx0v5nFBbKvNm3jCcV4SthoKj7xVz-_mK7o48&height=304';
                ?>"
              >         
            </div> 

            <ul class="orig">
              <li><h2>Apărut în <?php echo $film->year; ?></h2></li>

              <li>
                <h2>
                  <div class="runtime">
                    <div class="timp">
                      <?php
                        //afiseaza durata filmului in ore si minute
                        echo "Durata: ";
                        $ore=floor($film->runtime / 60);
                        $minute=$film->runtime % 60;
                        echo $ore , " hour";

                        if($ore > 1)echo 's'; //daca dureaza mai mult sau egal cu 2 ore adauga 's' la 'hour'

                        if($minute >= 1){
                        echo " and ", $minute , " minute";
                        if($minute > 1)echo 's';
                        } //0 minute -> nu afiseaza; mai mult de 1 min -> afiseaza 'minute' la plural
                      ?>
                    </div>
                    <!--  
                      <div class="runtime-bar">
                        <div class="bara" style="width: <?php echo $film->runtime * 100 / $durataMax; ?>%;">

                        </div>  
                      </div> 
                    -->
                  </div>
                </h2>
              </li>

              <li>
                <h2>
                  <div class="genuri">
                    <?php
                      echo "Genuri: ";
                      for($w = 0 ; $w < count($film->genres)-1 ; $w++)echo "{$film->genres[$w]}, ";
                      
                      echo $film->genres[$w]; 
                    ?>              
                  </div>
                </h2>
              </li>

              <?php if($film->director != "N/A"){?>
              <li><h2>Regizor(i): <?php echo $film->director; ?></h2></li>
              <?php } ?>

              <li>
                <h2>
                  <div class="actori">
                    <?php echo "Actori principali:"; ?>
                    <ol>
                      <?php
                        $actors=$film->actors;
                        $actors_list=explode(', ' , $actors);
                        
                        for($l = 0 ; $l < count($actors_list) ; $l++){
                        $toti_actorii[]=$actors_list[$l];
                      ?>
                      <li>
                        <?php
                          echo $actors_list[$l];
                        ?>
                      </li>
                      <?php } ?>
                    </ol>
                  </div>
                </h2>
              </li>

              <li>
                <h2>
                  <div class="plot">
                    <?php echo 'Poveste: ' ;
                      echo $film->plot;
                    ?>
                  </div>
                </h2>
              </li>
            </ul>
          </div>
<?php           
        }
        else{
?>
       <h1> Acest film nu este pe listă. Du-te la ~ <a href="archive.php"> ARHIVĂ </a> ~ </h1>
<?php       }
       
    }
    
    require_once('footer.php');
?>  
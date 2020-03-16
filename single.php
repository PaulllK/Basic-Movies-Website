<?php
    session_start(); //pt ca user-ul sa nu poata da de mai multe ori o nota pana va inchide BROWSER-ul
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
           
           $durataMax=cel_mai_lung_film($movies); 
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
                    <div class="runtime-bar">
                      <div class="bara" style="width: <?php echo $film->runtime * 100 / $durataMax; ?>%;">

                      </div>  
                    </div> 
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
          <div class="stars">
          <?php

           $link = db_connect(); //parametrii au valori default

           if ( !$link ) {  
             die("EROARE DE CONECTARE LA BAZA DE DATE: " . mysqli_connect_error());
           }

           if( !creeaza_tabel_rating() )echo 'EROARE IN CREAREA TABELULUI \'rating\'.';

           if(!isset($_POST['star'])){  
                 if( !isset($_SESSION['block_ratings'][$film->id]) ){
          ?>         
            <h2 style="padding-left:10px;">
            <?php
             $nrNote=nr_note($film->title);
             if($nrNote == 0)echo 'Fii primul care acorda o notă <br> acestui film!'; 
             else echo 'Dă-i o notă filmului!';                 
            ?> 
            </h2> 
            <div style="height:60px;">    
              <form action="single.php?movie_id=<?php echo $film->id; ?>" method="post">
                <input id="nota" type="submit" class="star"/>
                <label class="rank" for="nota" style="float:right;"></label>
                <input class="star star-5" id="star-5" type="radio" name="star" value=5>
                <label class="star star-5" for="star-5"></label>
                <input class="star star-4" id="star-4" type="radio" name="star" value=4>
                <label class="star star-4" for="star-4"></label>
                <input class="star star-3" id="star-3" type="radio" name="star" value=3>
                <label class="star star-3" for="star-3"></label>
                <input class="star star-2" id="star-2" type="radio" name="star" value=2>
                <label class="star star-2" for="star-2"></label>
                <input class="star star-1" id="star-1" type="radio" name="star" value=1>
                <label class="star star-1" for="star-1"></label>            
              </form>
            </div>
<?php    
                }
              }else if(!empty($_POST['star'])){ 
                $_SESSION['block_ratings'][$film->id]=1;
                adauga_nota( $film->title , $_POST['star'] );
                ///$_SESSION['continut'][$film->id]=2;
              }

              if( isset($_SESSION['block_ratings'][$film->id]) ){
?>
              <h2 style="padding: 0px 10px;">Nota a fost înregistrată. Mulțumim!</h2>
<?php
              }
              if( !isset($nrNote) )$nrNote = nr_note($film->title);
              if($nrNote > 0)media_notelor($film->title);
          ?>
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
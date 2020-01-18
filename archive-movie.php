<?php
$an=$film_cur->year;
?>
<h2 class="unu">
<li>           
    <?php echo $film_cur->title; ?></h2>
    <div class="info-film">
    
    <div class="imagine">
        <img 
        src="
        <?php 
            if( @getimagesize($film_cur->posterUrl) )echo $film_cur->posterUrl;
            else echo 'https://media3.picsearch.com/is?EHXO7tKx0v5nFBbKvNm3jCcV4SthoKj7xVz-_mK7o48&height=304';
        ?>"
        >         
    </div> 

    <ul class="<?php if(basename($_SERVER['SCRIPT_NAME'], ".php") == "index")echo 'b';
                     else echo 'orig';
                ?>"> <!--inceputul listei (una pt fiecare film) cu detalii despre film--> 

        <li>               
        <?php 
        echo "Apărut în ";
        if($an >= 2010){ ?>
        <strong><?php echo $an; ?> </strong>
        <?php }else {echo $an;}?>
        </li>
        <?php $descriere=$film_cur->plot; ?>

        <li>
        <div class="plot">
            <?php echo 'Poveste: ' ;

            if(strlen($descriere)>100){
                echo substr($descriere, 0, 100) . '...';
            }else echo $descriere;
            ?>
        </div>
        </li>
        
        <!--
            <li>
            <div class="genuri">
                <?php
                echo "Genuri: ";
                for($w = 0 ; $w < count($film_cur->genres)-1 ; $w++)echo "{$film_cur->genres[$w]}, ";
                
                echo $film_cur->genres[$w]; 
                ?>              
            </div>
            </li>
            
            <li>
            <div class="actori">
                <?php echo "Actori principali:"; ?>
                <ol>
                <?php
                    $actors=$film_cur->actors;
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
            </li>
        -->
        <li>
        <div class="runtime">
            <div class="timp">
            <?php
                //afiseaza durata filmului in ore si minute
                echo "Durata: ";
                sec_in_ore_si_min($film_cur);
            ?>
            </div>
            <div class="runtime-bar">
            <div class="bara" style="width: <?php echo $film_cur->runtime * 100 / $durataMax; ?>%;">

            </div>  
            </div>
        </div>
        </li>
        <a href="single.php?movie_id=<?php echo $film_cur->id; ?>" class="detalii">Mai multe detalii</a>
    </ul>
    
    </div>
    
</li>
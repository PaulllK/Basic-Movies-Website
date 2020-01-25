<?php
    function cel_mai_lung_film($movies){
        if( isset($_COOKIE['longest-movie-lenght']) ){
            return $_COOKIE['longest-movie-lenght'];
        }
        else{
        $maxT=max( array_column($movies , 'runtime') );
        setcookie('longest-movie-lenght' , $maxT);
        return $maxT;
        }
    }

    function sec_in_ore_si_min($timp){
        $ore=floor($timp->runtime / 60);
        $minute=$timp->runtime % 60;
        echo $ore , ' h';
        echo " si ", $minute , " min";
    }

    global $ratings , $film; //pt fct de mai jos

    function verif_file(){
        if(filesize('movies_rating.txt') == 0)
        {
            return 0;         
        } 
        else{
            global $ratings , $film;
            $ratings=json_decode( file_get_contents('movies_rating.txt') , true );
            if( !isset($ratings[$film->id]) )return 1;
            else return 2;
        }
    }

    function media_notelor(){
        global $ratings , $film;
?>
    
    <h2 style="padding: 0px 10px; width: fit-content;">
<?php
        echo 'Media notelor: ';
        $suma=0; $nr=0;
        foreach($ratings[$film->id] as $nota){
            $suma += $nota;
            $nr++;
        }
        echo round($suma / $nr , 2);
?>
    <div class="stea"></div>
    </h2>
    
<?php      
    }
?>